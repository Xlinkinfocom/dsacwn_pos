<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CreditPackageMst;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\CreditPackageLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    public function buy(Request $request, $id){
          //
          try {
            $credit_packages = CreditPackageMst::where('credit_packages_id' , $id)->get()->toArray();
            return view('sellerpackage.add',compact('credit_packages'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

  
}
