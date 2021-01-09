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
                                    ->join('product_sales', 'sales.id', '=', 'product_sales.sale_id')
                                    ->select('product_sales.product_id','sales.reference_no', 'payments.sale_id', 'payments.amount', 'payments.paying_method', 'payments.created_at')                                            
                                    ->where('payments.user_id', $seller->id)
                                            ->whereIn('payments.paying_method', $paying_methods)
                                            ->orderBy('payments.created_at', 'DESC')
                                            ->get();
                        echo '<pre>';
                        print_r($payments);
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