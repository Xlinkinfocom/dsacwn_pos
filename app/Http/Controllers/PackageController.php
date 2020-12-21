<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CreditPackageMst;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\CreditPackageLog;

class PackageController extends Controller
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
    public function create()
    {
        //
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
            return view('admin.package.edit',compact('credit_package'));
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
            'no_of_credit' => 'required|integer',
            'price'        => 'required|numeric'
        ]);

        try {
            $credit_package_log = new CreditPackageLog;
            $credit_package_log->name = $request->name;
            $credit_package_log->face_value = $request->no_of_credit;
            $credit_package_log->cost = $request->price;
            $credit_package_log->expiry_inDays = 0;
            $credit_package_log->save();

            CreditPackageMst::where('credit_package_id',$id)->update([
                    'credit_package_log_id' =>  $credit_package_log->credit_package_log_id,
                    'face_value'            => $request->no_of_credit,
                    'cost'                  => $request->price,
                ]);
            return redirect()->route('admin.credit.index')->with('flash_success', 'Credit Package Updated Successfully');    
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
    public function destroy($id)
    {
        //
    }
}
