<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CreditPackageMst;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\CreditPackageLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\PaymentWithPaypal;

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
            return view('sellerpackage.add',compact('credit_packages'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
       
    }

    /* public function store(Request $request)
    {
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
                 // This will redirect user to PayPal
                return redirect($response['paypal_link']);
    } */

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
