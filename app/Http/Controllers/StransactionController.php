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
                '2' => 'Debit Card',
                '3' => 'Cash',
                '4' => 'Gift Card'
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
            $payment_type = NULL;
           

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

            $transactions   = $this->transactions($role->id, $seller_id, $start_date, $end_date, $payment_type);
            
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
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $payment_type = $request->payment_type;
           

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

            $transactions   = $this->transactions($role->id, $seller_id, $start_date, $end_date, $payment_type);

       

        return view('stransaction.index', compact('sellers', 'transactions', 'role_id'));
    }
    public function checkEmpty($start_Date, $empty)
    {
        if($start_Date != $empty)
        {
            return true;
        }

        return false;
    }

    public function statusChange($id=null, $status=null)
    {
        $role = Role::find(Auth::user()->role_id);
        $role_id = $role->id; 

        $seller_id = "";
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


        if($status == '1')
        {
            $result = DB::update('update sales set is_seller_paid = ? where id = ?', ['0', $id]);
        }
        else {
            $result = DB::update('update sales set is_seller_paid = ? where id = ?', ['1', $id]);
        }

        $transactions   = $this->transactions($role_id, $seller_id, $start_date, $end_date, $payment_type);

       

        return view('stransaction.index', compact('sellers', 'transactions', 'role_id'));
        
        
    }

    public function transactions($role_id=null, $seller_id=null, $start_date=null, $end_date=null, $payment_type=null)
    {
            $sellers        = array();
            $transactions   = array();
            $conditions = array();
            $paying_methods = array(               
                '0' => 'Mix Payment',
                '1' => 'Credit Card',
                '2' => 'Debit Card',
                '3' => 'Cash',
                '4' => 'Gift Card'
            );
           
                if($start_date != "")
                {
                    $start_date = date('Y-m-d', strtotime($start_date));     
                    //dd($start_date);               
                }

                if($end_date != "")
                {
                    $end_date = date('Y-m-d', strtotime($end_date));  
                    //dd($end_date);                  
                }               
                

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
                        if($start_date != "" && $end_date != "")
                        {
                            if($payment_type != "")
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '>=',  $start_date)
                                ->whereDate('payments.created_at', '<=',  $end_date)   
                                ->when(in_array($payment_type, $paying_methods), function ($query) use ($payment_type) {
                                    return $query->where('payments.paying_method', $payment_type);
                                })                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }
                            else
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '>=',  $start_date)
                                ->whereDate('payments.created_at', '<=',  $end_date)   
                                ->whereIn('payments.paying_method', $paying_methods)                                                                                 
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }
                            
                        }
                        else if($start_date != "" && $end_date == "")
                        {
                            if( $payment_type != "" )
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '>=',  $start_date)  
                                ->when(in_array($payment_type, $paying_methods), function ($query) use ($payment_type) {
                                    return $query->where('payments.paying_method', $payment_type);
                                })                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }
                            else
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '>=',  $start_date)  
                                ->whereIn('payments.paying_method', $paying_methods)                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }
                           
                        }
                        else if($start_date == "" && $end_date != "")
                        {
                            if( $payment_type != "" )
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '<=',  $end_date)  
                                ->when(in_array($payment_type, $paying_methods), function ($query) use ($payment_type) {
                                    return $query->where('payments.paying_method', $payment_type);
                                })                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            } else {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '<=',  $end_date)  
                                ->whereIn('payments.paying_method', $paying_methods)                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }                            

                            //dd($payments);
                        }
                        else if($start_date == "" && $end_date == "")
                        {
                            if( $payment_type != "" )
                            {
                                $payments = DB::table('payments')
                            ->join('sales', 'payments.sale_id', '=', 'sales.id')
                            ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                            ->where('payments.user_id', $seller->id)                            
                            ->when(in_array($payment_type, $paying_methods), function ($query) use ($payment_type) {
                                return $query->where('payments.paying_method', $payment_type);
                            })                                                       
                            ->orderBy('payments.created_at', 'DESC')
                            ->get();

                            } else {

                            $payments = DB::table('payments')
                            ->join('sales', 'payments.sale_id', '=', 'sales.id')
                            ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                            ->where('payments.user_id', $seller->id)                            
                            ->whereIn('payments.paying_method', $paying_methods)                                                       
                            ->orderBy('payments.created_at', 'DESC')
                            ->get();

                            //dd($payments);

                            }
                            
                        }

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
                                else if($payment->paying_method == $paying_methods[3])
                                {

                                    $commission_amt = 0;
                                    $payable_amount = ($payment->amount - $commission_amt);
                                }
                                else
                                {
                                    $commission_amt = ($payment->amount * $commission) / 100;
                                    $payable_amount = ($payment->amount - $commission_amt);
                                }                                

                                /* $get_payment_status = DB::table('sales')->select('is_seller_paid')
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
                                } */

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
                                    'payable_status' => $payment->is_seller_paid
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
                        if($start_date != "" && $end_date != "")
                        {
                            if($payment_type != "")
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '>=',  $start_date)
                                ->whereDate('payments.created_at', '<=',  $end_date)   
                                ->when(in_array($payment_type, $paying_methods), function ($query) use ($payment_type) {
                                    return $query->where('payments.paying_method', $payment_type);
                                })                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }
                            else
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '>=',  $start_date)
                                ->whereDate('payments.created_at', '<=',  $end_date)   
                                ->whereIn('payments.paying_method', $paying_methods)                                                                                 
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }
                            
                        }
                        else if($start_date != "" && $end_date == "")
                        {
                            if( $payment_type != "" )
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '>=',  $start_date)  
                                ->when(in_array($payment_type, $paying_methods), function ($query) use ($payment_type) {
                                    return $query->where('payments.paying_method', $payment_type);
                                })                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }
                            else
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '>=',  $start_date)  
                                ->whereIn('payments.paying_method', $paying_methods)                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }
                           
                        }
                        else if($start_date == "" && $end_date != "")
                        {
                            if( $payment_type != "" )
                            {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '<=',  $end_date)  
                                ->when(in_array($payment_type, $paying_methods), function ($query) use ($payment_type) {
                                    return $query->where('payments.paying_method', $payment_type);
                                })                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            } else {
                                $payments = DB::table('payments')
                                ->join('sales', 'payments.sale_id', '=', 'sales.id')
                                ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                                ->where('payments.user_id', $seller->id)
                                ->whereDate('payments.created_at', '<=',  $end_date)  
                                ->whereIn('payments.paying_method', $paying_methods)                                                       
                                ->orderBy('payments.created_at', 'DESC')
                                ->get();
                            }                            

                            //dd($payments);
                        }
                        else if($start_date == "" && $end_date == "")
                        {
                            if( $payment_type != "" )
                            {
                                $payments = DB::table('payments')
                            ->join('sales', 'payments.sale_id', '=', 'sales.id')
                            ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                            ->where('payments.user_id', $seller->id)                            
                            ->when(in_array($payment_type, $paying_methods), function ($query) use ($payment_type) {
                                return $query->where('payments.paying_method', $payment_type);
                            })                                                       
                            ->orderBy('payments.created_at', 'DESC')
                            ->get();

                            } else {

                                $payments = DB::table('payments')
                            ->join('sales', 'payments.sale_id', '=', 'sales.id')
                            ->select('sales.reference_no', 'sales.is_seller_paid', 'payments.sale_id', 'payments.amount', 'payments.by_cash', 'payments.by_card', 'payments.paying_method', 'payments.created_at')
                            ->where('payments.user_id', $seller->id)                            
                            ->whereIn('payments.paying_method', $paying_methods)                                                       
                            ->orderBy('payments.created_at', 'DESC')
                            ->get();

                            }
                            
                        }

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
                                else if($payment->paying_method == $paying_methods[3])
                                {

                                    $commission_amt = 0;
                                    $payable_amount = ($payment->amount - $commission_amt);
                                }
                                else
                                {
                                    $commission_amt = ($payment->amount * $commission) / 100;
                                    $payable_amount = ($payment->amount - $commission_amt);
                                }                                  

                                /* $get_payment_status = DB::table('sales')->select('is_seller_paid')
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
                                } */

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
                                    'payable_status' => $payment->is_seller_paid
                                );

                            }
                        }
                    }
                }
            }

            return $transactions;
    }
}