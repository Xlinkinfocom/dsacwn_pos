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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credit_packages = CreditPackageMst::orderBy('created_at' , 'desc')->get();
        return view('package.index', compact('credit_packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {
            $credit_packages = CreditPackageMst::orderBy('created_at' , 'desc')->get();
            return view('sellerpackage.add',compact('credit_packages'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'no_of_credit' => 'required|numeric',
           // 'price'        => 'required|numeric'
        ]);

        try {
           
           
            $credit_package_log = new CreditPackageLog;
            $credit_package_log->name = $request->name;
            $credit_package_log->description = $request->description;
            $credit_package_log->face_value = $request->no_of_credit;
            $credit_package_log->cost = $request->no_of_credit;
            $credit_package_log->expiry_inDays = 0;
            $credit_package_log->save();
            $is_active=0;
            if(isset($request->is_active)){
                $is_active=(int)$request->is_active;
            }
          
            $credit_package=new CreditPackageMst;
            $credit_package->name= $request->name;
            $credit_package->description= $request->description;
            $credit_package->face_value= $request->no_of_credit;
            $credit_package->cost= $request->no_of_credit;
            $credit_package->credit_package_log_id= $credit_package_log->credit_package_log_id;
            $credit_package->is_active=$is_active;
            $credit_package->save();
            return redirect()->route('package.index')->with('flash_success', 'Subscription Plan Create Successfully');    
        } 

        catch (Exception $e) {
            return back()->with('flash_error', 'Subscription Plan Not Found');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $credit_package = CreditPackageMst::findOrFail($id);
            return view('package.edit',compact('credit_package'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'no_of_credit' => 'required|numeric',
           // 'price'        => 'required|numeric'
        ]);

        try {
            $credit_package_log = new CreditPackageLog;
            $credit_package_log->name = $request->name;
            $credit_package_log->description = $request->description;
            $credit_package_log->face_value = $request->no_of_credit;
            $credit_package_log->cost = $request->no_of_credit;
            $credit_package_log->expiry_inDays = 0;
            $credit_package_log->save();
            $is_active=0;
            if(isset($request->is_active)){
                $is_active=(int)$request->is_active;
            }
            CreditPackageMst::where('credit_package_id',$id)->update([
                    'credit_package_log_id' =>  (int)$credit_package_log->credit_package_log_id,
                    'face_value'            => $request->no_of_credit,
                    'description'            => $request->description,
                    'cost'                  => $request->no_of_credit,
                    'is_active'=>$is_active,
                ]);
            return redirect()->route('package.index')->with('flash_success', 'Subscription Plan Updated Successfully');    
        } 

        catch (Exception $e) {
            return back()->with('flash_error', 'Credit Package Not Found');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        CreditPackageMst::where('credit_package_id',(int)$id)->delete();
        return redirect()->route('package.index')->with('flash_success', 'Subscription Plan Deleted Successfully');    
        echo $id; exit;
    }
}
