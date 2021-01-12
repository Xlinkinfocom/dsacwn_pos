<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Seller;
use App\Sale;
use App\Payment;
use App\Stransaction;
use App\Product_Sale;
use App\Product_Warehouse;
use App\CommissionMst;
use App\Category;
use DB;
use App\GeneralSetting;
use Stripe\Stripe;
use NumberToWords\NumberToWords;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
use GeniusTS\HijriDate\Date;
use Illuminate\Support\Facades\Validator;

class StransactionController extends Controller
{
    public function index()
    {  
        $role = Role::find(Auth::user()->role_id);
        $role_id = $role->id;
        //dd($role); exit;
        if($role->hasPermissionTo('sales-index')) {
            $sellers = array();
            $transactions = array();
            $paying_methods = array(
                                '0' => 'Cash',
                                '1' => 'Mix Payment',
                                '2' => 'Credit Card', 
                                '3' => 'Debit Card'
            );
            if($role->id != '7')
            {
                $sellers = User::select('id', 'name')
                                ->where('role_id', '7')
                                ->where('is_active', '1')
                                ->orderBy('name', 'ASC')                                
                                ->get();
                
                if(!empty($sellers))
                {   
                    foreach($sellers as $seller)
                    {
                        $payments = DB::table('payments')
                                    ->join('sales', 'payments.sale_id', '=', 'sales.id')                                    
                                    ->select('sales.reference_no', 'payments.sale_id', 'payments.amount', 'payments.paying_method', 'payments.created_at')                                            
                                    ->where('payments.user_id', $seller->id)
                                            ->whereIn('payments.paying_method', $paying_methods)
                                            ->orderBy('payments.created_at', 'DESC')
                                            ->get();                       

                        if(!empty($payments))
                        {                            

                            foreach($payments as $payment)
                            {                              

                                $products = DB::table('products')
                                        ->join('product_sales', 'product_sales.product_id', '=', 'products.id')
                                        //->join('categories', 'categories.id', '=','products.category_id')                                        
                                        ->select('products.category_id')
                                        ->where('product_sales.sale_id', $payment->sale_id)                                       
                                        ->get();
                                
                                if(!empty($products))
                                {
                                    $duplicate_categories = array();
                                    $categories = array();
                                    $commission = 0;                                    
                                    $i = 0;
                                    foreach($products as $product)
                                    {
                                        $duplicate_categories[$i] = $product->category_id;
                                        $i++;                                                    
                                    }

                                    if(!empty($duplicate_categories))
                                    {
                                        $categories = array_unique($duplicate_categories);
                                        $parent_categories = array();
                                        foreach($categories as $category)
                                        {                                            
                                            $get_parent = Category::select('parent_id')
                                                        ->where('id', $category)
                                                        ->first();

                                            if(!empty($get_parent))
                                            {
                                                $get_commission = DB::table('commission_mst')
                                                            ->select('total_commission')
                                                            ->where('cat_id', $get_parent->parent_id)
                                                            ->orWhere('sub_cat_id', $get_parent->parent_id)
                                                            ->first();
                                                if(!empty($get_commission))
                                                {
                                                    /* echo '<pre>';
                                                    print_r($get_commission); */
                                                    $commission += $get_commission->total_commission;
                                                }                                                
                                            }
                                            else{
                                                $get_commission = DB::table('commission_mst')
                                                            ->select('total_commission')
                                                            ->where('cat_id', $category)
                                                            ->orWhere('sub_cat_id', $category)
                                                            ->first();
                                                if(!empty($get_commission))
                                                {
                                                    /* echo '<pre>';
                                                    print_r($get_commission); */
                                                    $commission += $get_commission->total_commission;
                                                }                                                
                                            }
                                        }
                                    
                                    }
                                    
                                }

                                $payable_amount = 0;
                                $commission_amt = 0;
                                $payable_status = "";

                                $commission_amt = ($payment->amount * $commission) / 100;
                                $payable_amount = ($payment->amount - $commission_amt);

                                $get_payment_status = DB::table('stransaction')->select('seller_pay_status')
                                                    ->where('invoice_id', $payment->sale_id)
                                                    ->first();
                                if(!empty($get_payment_status))
                                {
                                    $payable_status = "Unpaid";
                                }
                                else
                                {
                                    $payable_status = "Paid";
                                }
                                
                                $transactions[] = array(
                                    'seller_id' => $seller->id,
                                    'seller_name' => $seller->name,
                                    'sale_id'      => $payment->sale_id,
                                    'invoice_id' => $payment->reference_no,
                                    'invoice_date' => $payment->created_at,
                                    'sale_amount' => $payment->amount,
                                    'commission' => $commission,
                                    'commission_amt' => $commission_amt,
                                    'payable_amount' => $payable_amount,
                                    'paid_mode' => $payment->paying_method,
                                    'payable_status' => $payable_status
                                );                       
                            }
                            
                        }
                    }
                }

            }
            else
            {
                //dd(Auth::user()->id);
                $sellers = User::select('id', 'name')
                                ->where('role_id', '7')
                                ->where('id', Auth::user()->id)
                                ->where('is_active', '1')
                                ->orderBy('name', 'ASC')                                
                                ->get();
                
                if(!empty($sellers))
                {   
                    foreach($sellers as $seller)
                    {
                        $payments = DB::table('payments')
                                    ->join('sales', 'payments.sale_id', '=', 'sales.id')                                    
                                    ->select('sales.reference_no', 'payments.sale_id', 'payments.amount', 'payments.paying_method', 'payments.created_at')                                            
                                    ->where('payments.user_id', $seller->id)
                                            ->whereIn('payments.paying_method', $paying_methods)
                                            ->orderBy('payments.created_at', 'DESC')
                                            ->get();                       

                        if(!empty($payments))
                        {                            

                            foreach($payments as $payment)
                            {  
                                

                                $products = DB::table('products')
                                        ->join('product_sales', 'product_sales.product_id', '=', 'products.id')
                                        //->join('categories', 'categories.id', '=','products.category_id')                                        
                                        ->select('products.category_id')
                                        ->where('product_sales.sale_id', $payment->sale_id)                                       
                                        ->get();
                                
                                if(!empty($products))
                                {
                                    $duplicate_categories = array();
                                    $categories = array();
                                    $commission = 0;                                    
                                    $i = 0;
                                    foreach($products as $product)
                                    {
                                        $duplicate_categories[$i] = $product->category_id;
                                        $i++;                                                    
                                    }

                                    if(!empty($duplicate_categories))
                                    {
                                        $categories = array_unique($duplicate_categories);
                                        $parent_categories = array();
                                        foreach($categories as $category)
                                        {                                            
                                            $get_parent = Category::select('parent_id')
                                                        ->where('id', $category)
                                                        ->first();

                                            if(!empty($get_parent))
                                            {
                                                $get_commission = DB::table('commission_mst')
                                                            ->select('total_commission')
                                                            ->where('cat_id', $get_parent->parent_id)
                                                            ->orWhere('sub_cat_id', $get_parent->parent_id)
                                                            ->first();
                                                if(!empty($get_commission))
                                                {
                                                    /* echo '<pre>';
                                                    print_r($get_commission); */
                                                    $commission += $get_commission->total_commission;
                                                }                                                
                                            }
                                            else{
                                                $get_commission = DB::table('commission_mst')
                                                            ->select('total_commission')
                                                            ->where('cat_id', $category)
                                                            ->orWhere('sub_cat_id', $category)
                                                            ->first();
                                                if(!empty($get_commission))
                                                {
                                                    /* echo '<pre>';
                                                    print_r($get_commission); */
                                                    $commission += $get_commission->total_commission;
                                                }                                                
                                            }
                                        }
                                    
                                    }
                                    
                                }
                                
                                $payable_amount = 0;
                                $commission_amt = 0;
                                $payable_status = "";

                                $commission_amt = ($payment->amount * $commission) / 100;
                                $payable_amount = ($payment->amount - $commission_amt);

                                $get_payment_status = DB::table('stransaction')->select('seller_pay_status')
                                                    ->where('invoice_id', $payment->sale_id)
                                                    ->first();
                                if(!empty($get_payment_status))
                                {
                                    $payable_status = "Unpaid";
                                }
                                else
                                {
                                    $payable_status = "Paid";
                                }
                                
                                $transactions[] = array(
                                    'seller_id' => $seller->id,
                                    'seller_name' => $seller->name,
                                    'sale_id'      => $payment->sale_id,
                                    'invoice_id' => $payment->reference_no,
                                    'invoice_date' => $payment->created_at,
                                    'sale_amount' => $payment->amount,
                                    'commission' => $commission,
                                    'commission_amt' => $commission_amt,
                                    'payable_amount' => $payable_amount,
                                    'paid_mode' => $payment->paying_method,
                                    'payable_status' => $payable_status
                                );                       


                            }
                            
                        }
                    }
                }
            }
             /* echo '<pre>';
            print_r($transactions);
            die();  */
            return view('stransaction.index', compact('sellers', 'transactions', 'role_id'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');

    }

    public function store(Request $request)
    {
        //dd($request->all());

        $role = Role::find(Auth::user()->role_id);
        $role_id = $role->id;
        //dd($role); exit;
       
        $sellers = array();
        $transactions = array();
        $paying_methods = array(
                            '0' => 'Cash',
                            '1' => 'Mix Payment',
                            '2' => 'Credit Card', 
                            '3' => 'Debit Card'
        );
        if($request->seller_id == '0')
        {
            $sellers = User::select('id', 'name')
                            ->where('role_id', '7')
                            ->where('is_active', '1')
                            ->orderBy('name', 'ASC')                                
                            ->get();
            
            if(!empty($sellers))
            {   
                foreach($sellers as $seller)
                {
                    $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')                                    
                                ->select('sales.reference_no', 'payments.sale_id', 'payments.amount', 'payments.paying_method', 'payments.created_at')                                            
                                ->where('payments.user_id', $seller->id)
                                        ->whereIn('payments.paying_method', $paying_methods)
                                        ->orderBy('payments.created_at', 'DESC')
                                        ->get();                       

                    if(!empty($payments))
                    {                            

                        foreach($payments as $payment)
                        {                              

                            $products = DB::table('products')
                                    ->join('product_sales', 'product_sales.product_id', '=', 'products.id')
                                    //->join('categories', 'categories.id', '=','products.category_id')                                        
                                    ->select('products.category_id')
                                    ->where('product_sales.sale_id', $payment->sale_id)                                       
                                    ->get();
                            
                            if(!empty($products))
                            {
                                $duplicate_categories = array();
                                $categories = array();
                                $commission = 0;                                    
                                $i = 0;
                                foreach($products as $product)
                                {
                                    $duplicate_categories[$i] = $product->category_id;
                                    $i++;                                                    
                                }

                                if(!empty($duplicate_categories))
                                {
                                    $categories = array_unique($duplicate_categories);
                                    $parent_categories = array();
                                    foreach($categories as $category)
                                    {                                            
                                        $get_parent = Category::select('parent_id')
                                                    ->where('id', $category)
                                                    ->first();

                                        if(!empty($get_parent))
                                        {
                                            $get_commission = DB::table('commission_mst')
                                                        ->select('total_commission')
                                                        ->where('cat_id', $get_parent->parent_id)
                                                        ->orWhere('sub_cat_id', $get_parent->parent_id)
                                                        ->first();
                                            if(!empty($get_commission))
                                            {
                                                /* echo '<pre>';
                                                print_r($get_commission); */
                                                $commission += $get_commission->total_commission;
                                            }                                                
                                        }
                                        else{
                                            $get_commission = DB::table('commission_mst')
                                                        ->select('total_commission')
                                                        ->where('cat_id', $category)
                                                        ->orWhere('sub_cat_id', $category)
                                                        ->first();
                                            if(!empty($get_commission))
                                            {
                                                /* echo '<pre>';
                                                print_r($get_commission); */
                                                $commission += $get_commission->total_commission;
                                            }                                                
                                        }
                                    }
                                
                                }
                                
                            }

                            $payable_amount = 0;
                            $commission_amt = 0;
                            $payable_status = "";

                            $commission_amt = ($payment->amount * $commission) / 100;
                            $payable_amount = ($payment->amount - $commission_amt);

                            $get_payment_status = DB::table('stransaction')->select('seller_pay_status')
                                                ->where('invoice_id', $payment->sale_id)
                                                ->first();
                            if(!empty($get_payment_status))
                            {
                                $payable_status = "Unpaid";
                            }
                            else
                            {
                                $payable_status = "Paid";
                            }
                            
                            $transactions[] = array(
                                'seller_id' => $seller->id,
                                'seller_name' => $seller->name,
                                'sale_id'      => $payment->sale_id,
                                'invoice_id' => $payment->reference_no,
                                'invoice_date' => $payment->created_at,
                                'sale_amount' => $payment->amount,
                                'commission' => $commission,
                                'commission_amt' => $commission_amt,
                                'payable_amount' => $payable_amount,
                                'paid_mode' => $payment->paying_method,
                                'payable_status' => $payable_status
                            );                       
                        }
                        
                    }
                }
            }

        }
        else
        {
            //dd(Auth::user()->id);
            $sellers = User::select('id', 'name')
                            ->where('role_id', '7')
                            ->where('id', $request->seller_id)
                            ->where('is_active', '1')
                            ->orderBy('name', 'ASC')                                
                            ->get();
            
            if(!empty($sellers))
            {   
                foreach($sellers as $seller)
                {
                    $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')                                    
                                ->select('sales.reference_no', 'payments.sale_id', 'payments.amount', 'payments.paying_method', 'payments.created_at')                                            
                                ->where('payments.user_id', $seller->id)
                                        ->whereIn('payments.paying_method', $paying_methods)
                                        ->orderBy('payments.created_at', 'DESC')
                                        ->get();                       

                    if(!empty($payments))
                    {                            

                        foreach($payments as $payment)
                        {  
                            

                            $products = DB::table('products')
                                    ->join('product_sales', 'product_sales.product_id', '=', 'products.id')
                                    //->join('categories', 'categories.id', '=','products.category_id')                                        
                                    ->select('products.category_id')
                                    ->where('product_sales.sale_id', $payment->sale_id)                                       
                                    ->get();
                            
                            if(!empty($products))
                            {
                                $duplicate_categories = array();
                                $categories = array();
                                $commission = 0;                                    
                                $i = 0;
                                foreach($products as $product)
                                {
                                    $duplicate_categories[$i] = $product->category_id;
                                    $i++;                                                    
                                }

                                if(!empty($duplicate_categories))
                                {
                                    $categories = array_unique($duplicate_categories);
                                    $parent_categories = array();
                                    foreach($categories as $category)
                                    {                                            
                                        $get_parent = Category::select('parent_id')
                                                    ->where('id', $category)
                                                    ->first();

                                        if(!empty($get_parent))
                                        {
                                            $get_commission = DB::table('commission_mst')
                                                        ->select('total_commission')
                                                        ->where('cat_id', $get_parent->parent_id)
                                                        ->orWhere('sub_cat_id', $get_parent->parent_id)
                                                        ->first();
                                            if(!empty($get_commission))
                                            {
                                                /* echo '<pre>';
                                                print_r($get_commission); */
                                                $commission += $get_commission->total_commission;
                                            }                                                
                                        }
                                        else{
                                            $get_commission = DB::table('commission_mst')
                                                        ->select('total_commission')
                                                        ->where('cat_id', $category)
                                                        ->orWhere('sub_cat_id', $category)
                                                        ->first();
                                            if(!empty($get_commission))
                                            {
                                                /* echo '<pre>';
                                                print_r($get_commission); */
                                                $commission += $get_commission->total_commission;
                                            }                                                
                                        }
                                    }
                                
                                }
                                
                            }
                            
                            $payable_amount = 0;
                            $commission_amt = 0;
                            $payable_status = "";

                            $commission_amt = ($payment->amount * $commission) / 100;
                            $payable_amount = ($payment->amount - $commission_amt);

                            $get_payment_status = Stransaction::select('seller_pay_status')
                                                ->where('invoice_id', $payment->sale_id)
                                                ->first();
                            if(!empty($get_payment_status))
                            {
                                $payable_status = "Unpaid";
                            }
                            else
                            {
                                $payable_status = "Paid";
                            }
                            
                            $transactions[] = array(
                                'seller_id' => $seller->id,
                                'seller_name' => $seller->name,
                                'sale_id'      => $payment->sale_id,
                                'invoice_id' => $payment->reference_no,
                                'invoice_date' => $payment->created_at,
                                'sale_amount' => $payment->amount,
                                'commission' => $commission,
                                'commission_amt' => $commission_amt,
                                'payable_amount' => $payable_amount,
                                'paid_mode' => $payment->paying_method,
                                'payable_status' => $payable_status
                            );


                        }
                        
                    }
                }
            }
        }

        return view('stransaction.index', compact('sellers', 'transactions', 'role_id'));
    }
}