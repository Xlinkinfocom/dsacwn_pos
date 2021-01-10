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
    public function index(Request $request)
    {  
        $role = Role::find(Auth::user()->role_id);
        //dd($role); exit;
        if($role->hasPermissionTo('users-index')){
            $sellers = array();
            $transactions = array();
            $paying_methods = array(
                                '0' => 'Cash',
                                '1' => 'Mix Payment',
                                '2' => 'Credit Card', 
                                '3' => 'Debit Card'
            );
            if($role != '7')
            {
                $sellers = User::select('id', 'name')
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
                        echo '<pre>';
                        print_r($payments);

                        if(!empty($payments))
                        {
                            foreach($payments as $payment)
                            {                                
                                $products = DB::table('products')
                                        ->join('product_sales', 'product_sales.product_id', '=', 'products.id')
                                        //->join('categories', 'categories.id', '=','products.category_id')                                        
                                        ->select('product_sales.product_id', 'products.category_id')
                                        ->where('product_sales.sale_id', $payment->sale_id)                                       
                                        ->get();
                                echo '<pre>';
                                print_r($products);
                                if(!empty($products))
                                {
                                    $categories = array();
                                    $parent_categories = array();
                                    $i = 0;
                                    foreach($products as $product)
                                    {
                                        $categories[$i] = $product->category_id;
                                        $i++;                                                    
                                    }

                                    print_r($categories);

                                    array_unique($categories);
                                    echo 'after :';
                                    print_r($categories);

                                    /* foreach($products as $product)
                                    {
                                                                   
                                         
                                        $get_commission = array();

                                        if($product->parent_id != "")
                                        {
                                            $parent_categories[$product->parent_id][] = $product->parent_id;

                                            $get_commission = DB::table('commission_mst')
                                                            ->select('total_commission')
                                                            ->where('cat_id', $product->parent_id)
                                                            ->orWhere('sub_cat_id', $product->parent_id)
                                                            ->get();
                                            echo '<pre>';
                                            print_r($get_commission); 
                                        }
                                        else
                                        {
                                            echo 'category_id : '.$product->category_id;

                                            $get_commission = DB::table('commission_mst')
                                                            ->select('total_commission')
                                                            ->where('cat_id', $product->category_id)
                                                            ->orWhere('sub_cat_id', $product->category_id)
                                                            ->get();
                                            echo '<pre>';
                                            print_r($get_commission);
                                        } 
                                    } */
                                }

                            }
                            
                        }
                    }
                }

            }
            else
            {
                $sellers = User::select('id', 'name')                                
                                ->where('is_active', '1')                                
                                ->get();
            }


            die();
            return view('stransaction.index', compact('sellers'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');

    }
}