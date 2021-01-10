<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\CreditPackageMst;
use App\PaymentWithSubscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SellerPackageController extends Controller
{
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request)
    {        
        //
        try {
            $credit_packages = CreditPackageMst::orderBy('created_at' , 'desc')->get()->toArray();
            return view('sellerpackage.add', compact('credit_packages'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
       
    }

    public function store(Request $request) {

        $data                 = $request->all();
        $data['user_id']      = Auth::id();
        $data['package_id']   = $request->package_id;
        $data['package_cost'] = $request->package_cost;
        //dd($data);

        $provider             = new ExpressCheckout;
        $paypal_data          = [];
        $paypal_data['items'] = [];

        //foreach ($data['package_id'] as $key => $product_id) {
        if(!empty($data['package_id'])) {
            //$lims_product_data = CreditPackageMst::find($product_id);
            $lims_product_data = CreditPackageMst::find($data['package_id']);
            //dd($lims_product_data);
            $paypal_data['items'][] = [
                'name'  => $lims_product_data->name,
                //'price' => $lims_product_data->name->cost,
                'price' => $lims_product_data->cost,
                'qty'   => 1
            ];
        }

        $paypal_data['items'][] = [
            'name'  => 'Order Tax',
            'price' => 0,
            'qty'   => 1
        ];

        $paypal_data['items'][] = [
            'name'  => 'Order Discount',
            'price' => 0,
            'qty'   => 1
        ];

        $paypal_data['items'][] = [
            'name'  => 'Shipping Cost',
            'price' => 0,
            'qty'   => 1
        ];
        //dd($paypal_data);

        $paypal_data['invoice_id']          = 'sub'.strtotime(date('Y-m-d H:i:s')).rand();
        $paypal_data['invoice_description'] = "Reference # {$paypal_data['invoice_id']} Invoice";
        $paypal_data['return_url']          = url('/sellerpackage/paypalSuccess');
        //$paypal_data['cancel_url']          = url('/sellerpackage/create');
        $paypal_data['cancel_url']          = url('/sellerpackage/paypalCancel');

        $total = 0;
        foreach($paypal_data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $paypal_data['total'] = $total;
        $response = $provider->setExpressCheckout($paypal_data);

        //This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }

    public function paypalSuccess(Request $request) {

        dd($request->all());
    }

    public function paypalCancel(Request $request) {

        dd($request->all());
    }

    ///////////////////// Newly Modified /////////////////////////
    public function payment_save(Request $request) {

        $data                 = $request->all();
        $data['user_id']      = Auth::id();
        $data['package_id']   = $request->package_id;
        $data['package_cost'] = $request->package_cost;
        $data['current_Date'] = Carbon::now()->format('Y-m-d h:i:s');
        $data['expire_Date']  = Carbon::now()->addMonths(1);
        //dd($data);

        //////// Storing Data ////////
        DB::table('subscriptions')->insert([
            'user_id'     => $data['user_id'],
            'package_id'  => $data['package_id'],
            'expire_date' => $data['expire_Date'],
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
        //////// End ////////

        $paypal_data = [];
        $paypal_data['invoice_id']          = 'sub'.strtotime(date('Y-m-d H:i:s')).rand();
        $paypal_data['invoice_description'] = "Reference # {$paypal_data['invoice_id']} Invoice";
        $paypal_data['return_url']          = route('paypal');
        $paypal_data['cancel_url']          = route('cancel_return');

        return view('sellerpackage.payment', compact('data', 'paypal_data'));
    }

    public function paypal_save(Request $request) {
        //dd($request->all());
        if($request->st == 'Completed') {

            //////// Storing Data ////////
            $fetch = new PaymentWithSubscribe;
            $fetch->user_id           = Auth::id();
            $fetch->payment_reference = $request->item_number;
            $fetch->transaction_id    = $request->tx;
            $fetch->payment_status    = $request->st;
            $fetch->payment_date      = date('Y-m-d h:i:s');
            $fetch->save();
            //////// End ////////

            return redirect(route('home'))->with('succes_paid', 'Payment successfull..');
        }
    }

    public function paypal_cancel(){

        return redirect(route('cancel_return'))->with('error_cancel', 'Payment Cancel..');
    }
    //////////////////////////////////////////////////////////////

    /*public function storeBkp(Request $request) {

        $data = $request->all();
       
        $data['user_id'] = Auth::id();

        $provider = new ExpressCheckout;
        $paypal_data = [];
        $paypal_data['items'] = [];
        foreach ($data['package_id'] as $key => $product_id) {
            $lims_product_data = CreditPackageMst::find($product_id);
            $paypal_data['items'][] = [
                'name' => $lims_product_data->name,
                'price' => $lims_product_data->name->cost,
                'qty' => 1
            ];
        }
        $paypal_data['items'][] = [
            'name' => 'Order Tax',
            'price' => 0,
            'qty' => 1
        ];
        $paypal_data['items'][] = [
            'name' => 'Order Discount',
            'price' => 0,
            'qty' => 1
        ];
        $paypal_data['items'][] = [
            'name' => 'Shipping Cost',
            'price' => 0,
            'qty' => 1
        ];

        //return $paypal_data;
        $paypal_data['invoice_id'] = 'sub'.strtotime(date('Y-m-d H:i:s')).rand();
        $paypal_data['invoice_description'] = "Reference # {$paypal_data['invoice_id']} Invoice";
        $paypal_data['return_url'] = url('/sellerpackage/paypalSuccess');
        $paypal_data['cancel_url'] = url('/sellerpackage/create');

        $total = 0;
        foreach($paypal_data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $paypal_data['total'] = $total;
        $response = $provider->setExpressCheckout($paypal_data);
        //This will redirect user to PayPal
        return redirect($response['paypal_link']);
    }*/

    public function buy(Request $request, $id){
        //
        try {
            $credit_packages = CreditPackageMst::where('credit_package_id' , $id)->get()->toArray();
            return view('sellerpackage.add',compact('credit_packages'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

  
}
