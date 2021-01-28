<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Sale;
use App\User;
use App\Seller;
use App\Payment;
use App\Category;
use Stripe\Stripe;
use App\Stransaction;
use App\Product_Sale;
use App\CommissionMst;
use App\GeneralSetting;
use App\Product_Warehouse;
use GeniusTS\HijriDate\Date;
use App\Mail\UserNotification;
use NumberToWords\NumberToWords;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

class StransactionController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        $role_id = $role->id;
        //dd($role); exit;
        if($role->hasPermissionTo('sales-index')) {

            $sellers = array();
            $seller_arr = array();
            $transactions = array();
            $paying_methods = array(               
                '0' => 'Mix Payment',
                '1' => 'Credit Card',
                '2' => 'Debit Card'
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
                                    ->select('sales.reference_no', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')                                            
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
                                                    $commission += $get_commission->total_commission;
                                                }                                                
                                            }
                                        }
                                    }
                                }

                                $payable_amount = 0;
                                $commission_amt = 0;
                                $payable_status = "";

                                $commission_amt = ($payment->by_card * $commission) / 100;
                                $payable_amount = ($payment->by_card - $commission_amt);

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
                                    'seller_id'      => $seller->id,
                                    'seller_name'    => $seller->name,
                                    'sale_id'        => $payment->sale_id,
                                    'invoice_id'     => $payment->reference_no,
                                    'invoice_date'   => $payment->created_at,
                                    'sale_amount'    => $payment->amount,
                                    'commission'     => $commission,
                                    'commission_amt' => $commission_amt,
                                    'payable_amount' => $payable_amount,
                                    'paid_mode'      => $payment->paying_method,
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
                                    'seller_id'      => $seller->id,
                                    'seller_name'    => $seller->name,
                                    'sale_id'        => $payment->sale_id,
                                    'invoice_id'     => $payment->reference_no,
                                    'invoice_date'   => $payment->created_at,
                                    'sale_amount'    => $payment->amount,
                                    'commission'     => $commission,
                                    'commission_amt' => $commission_amt,
                                    'payable_amount' => $payable_amount,
                                    'paid_mode'      => $payment->paying_method,
                                    'payable_status' => $payable_status
                                );

                            }
                        }
                    }
                }
            }
            /*echo '<pre>';
            print_r($transactions);
            die();*/
            return view('stransaction.index', compact('sellers', 'transactions', 'role_id'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    ////////// Modification Started //////////
    public function sellerTransaction($seller_id = NULL, $start_date = NULL, $end_date = NULL) {

        $role = Role::find(Auth::user()->role_id);
        $role_id = $role->id;

       
            $sellers        = array();
            $transactions   = array();
           

            if($role_id != '7')
            {
                $sellers = User::select('id', 'name')
                ->where('role_id', '7')
                ->where('is_active', '1')                        
                ->orderBy('name', 'ASC')
                ->get();
            }
            else
            {
                $sellers = User::select('id', 'name')
                ->where('role_id', '7')
                ->where('id', Auth::user()->id)
                ->where('is_active', '1')                        
                ->orderBy('name', 'ASC')
                ->get();
            }           

            $transactions   = $this->transactions($role->id, $seller_id, $start_date, $end_date);
            
            return view('stransaction.index', compact('sellers', 'transactions', 'role_id', 'seller_id', 'start_date', 'end_date'));
       
    }
    ////////// Modification Ends //////////


    public function store(Request $request) {

        //dd($request->all());
        $role = Role::find(Auth::user()->role_id);
        $role_id = $role->id;       
            $sellers        = array();
            $transactions   = array();

            $seller_id = $request->seller_id;
            $start_date = "";
            $end_date = "";
            $payment_type = "";
           

            if($role_id != '7')
            {
                $sellers = User::select('id', 'name')
                ->where('role_id', '7')
                ->where('is_active', '1')                        
                ->orderBy('name', 'ASC')
                ->get();
            }
            else
            {
                $sellers = User::select('id', 'name')
                ->where('role_id', '7')
                ->where('id', Auth::user()->id)
                ->where('is_active', '1')                        
                ->orderBy('name', 'ASC')
                ->get();
            }           

            $transactions   = $this->transactions($role->id, $seller_id, $start_date, $end_date);

       

        return view('stransaction.index', compact('sellers', 'transactions', 'role_id'));
    }

    public function transactions($role_id=null, $seller_id = NULL, $start_date = NULL, $end_date = NULL, $payment_type=NULL)
    {
            $sellers        = array();
            $transactions   = array();
            $paying_methods = array(
               
                '0' => 'Mix Payment',
                '1' => 'Credit Card',
                '2' => 'Debit Card'
            );

            if($role_id != '7')
            {
                if($seller_id != "")
                {
                    $sellers = User::select('id', 'name')
                    ->where('role_id', '7')
                    ->where('id', $seller_id)
                    ->where('is_active', '1')
                    ->orderBy('name', 'ASC')
                    ->get();
                }
                else
                {
                    $sellers = User::select('id', 'name')
                    ->where('role_id', '7')                   
                    ->where('is_active', '1')
                    ->orderBy('name', 'ASC')
                    ->get();
                }
                

                if(!empty($sellers))
                {
                    foreach($sellers as $seller)
                    {
                        $payments = DB::table('payments')
                            ->join('sales', 'payments.sale_id', '=', 'sales.id')
                            ->select('sales.reference_no', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
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
                                                    $commission += $get_commission->total_commission;
                                                }
                                            }
                                        }
                                    }
                                }

                                $payable_amount = 0;
                                $commission_amt = 0;
                                $payable_status = "";

                                if($payment->paying_method == $paying_methods[0])
                                {
                                    $commission_amt = ($payment->by_card * $commission) / 100;
                                    $payable_amount = ($payment->by_card - $commission_amt);
                                }
                                else{

                                    $commission_amt = ($payment->amount * $commission) / 100;
                                    $payable_amount = ($payment->amount - $commission_amt);
                                }                                

                                $get_payment_status = DB::table('sales')->select('is_seller_paid')
                                    ->where('id', $payment->sale_id)
                                    ->first();

                                if(!empty($get_payment_status))
                                {
                                    if($get_payment_status->is_seller_paid == '1')
                                    {
                                        $payable_status = "Paid";
                                    }
                                    else
                                    {
                                        $payable_status = "Unpaid";
                                    }                                    
                                }
                                else
                                {
                                    $payable_status = "Unpaid";
                                }

                                $transactions[] = array(
                                    'seller_id'      => $seller->id,
                                    'seller_name'    => $seller->name,
                                    'sale_id'        => $payment->sale_id,
                                    'invoice_id'     => $payment->reference_no,
                                    'invoice_date'   => $payment->created_at,
                                    'sale_amount'    => $payment->amount,
                                    'by_cash'        => $payment->by_cash,
                                    'by_card'        => $payment->by_card,
                                    'commission'     => $commission,
                                    'commission_amt' => $commission_amt,
                                    'payable_amount' => $payable_amount,
                                    'paid_mode'      => $payment->paying_method,
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
                if($seller_id == "")
                {
                    $sellers = User::select('id', 'name')
                    ->where('role_id', '7')
                    ->where('id', Auth::user()->id)
                    ->where('is_active', '1')
                    ->orderBy('name', 'ASC')
                    ->get();
                }
                else
                {
                    $sellers = User::select('id', 'name')
                    ->where('role_id', '7')
                    ->where('id', $seller_id)
                    ->where('is_active', '1')
                    ->orderBy('name', 'ASC')
                    ->get();
                }
                

                if(!empty($sellers))
                {
                    foreach($sellers as $seller)
                    {
                        $payments = DB::table('payments')
                            ->join('sales', 'payments.sale_id', '=', 'sales.id')
                            ->select('sales.reference_no', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
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
                                                    $commission += $get_commission->total_commission;
                                                }
                                            }
                                        }
                                    }
                                }

                                $payable_amount = 0;
                                $commission_amt = 0;
                                $payable_status = "";

                                if($payment->paying_method == $paying_methods[0])
                                {
                                    $commission_amt = ($payment->by_card * $commission) / 100;
                                    $payable_amount = ($payment->by_card - $commission_amt);
                                }
                                else{

                                    $commission_amt = ($payment->amount * $commission) / 100;
                                    $payable_amount = ($payment->amount - $commission_amt);
                                }                                

                                $get_payment_status = DB::table('sales')->select('is_seller_paid')
                                    ->where('id', $payment->sale_id)
                                    ->first();

                                if(!empty($get_payment_status))
                                {
                                    if($get_payment_status->is_seller_paid == '1')
                                    {
                                        $payable_status = "Paid";
                                    }
                                    else
                                    {
                                        $payable_status = "Unpaid";
                                    }                                    
                                }
                                else
                                {
                                    $payable_status = "Unpaid";
                                }

                                $transactions[] = array(
                                    'seller_id'      => $seller->id,
                                    'seller_name'    => $seller->name,
                                    'sale_id'        => $payment->sale_id,
                                    'invoice_id'     => $payment->reference_no,
                                    'invoice_date'   => $payment->created_at,
                                    'sale_amount'    => $payment->amount,
                                    'by_cash'        => $payment->by_cash,
                                    'by_card'        => $payment->by_card,
                                    'commission'     => $commission,
                                    'commission_amt' => $commission_amt,
                                    'payable_amount' => $payable_amount,
                                    'paid_mode'      => $payment->paying_method,
                                    'payable_status' => $payable_status
                                );

                            }
                        }
                    }
                }
            }

            return $transactions;
    }
}