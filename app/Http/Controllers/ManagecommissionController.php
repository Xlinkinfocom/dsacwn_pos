<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CommissionMst;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\CommissionLog;
use App\Category;

class ManagecommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CommissionMst = CommissionMst::orderBy('created_at' , 'desc')->get()->toArray();
      
        foreach($CommissionMst as $key=>$val){
          //  print_r($key); exit;
            $CommissionMst[$key]['categoryName']="";
            if($val['cat_id']!=0){
                $categoryName=Category::where("id",$val['cat_id'])->first();
                $CommissionMst[$key]['categoryName']=$categoryName->name;
            }
            if($val['sub_cat_id']!=0){
                $categoryName=Category::where("id",$val['sub_cat_id'])->first();
                $CommissionMst[$key]['categoryName']=$CommissionMst[$key]['categoryName'].'->'.$categoryName->name;
            }
            
        }
      //  print_r($CommissionMst); exit;
        return view('managecommission.index', compact('CommissionMst'));
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
            $category = Category::where("parent_id",null)->orWhere("parent_id",0)->get();
           // print_r($credit_package);
           // exit;
            return view('managecommission.add',compact('category'));
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
            'category' => 'required|numeric',
            'commssion' => 'required|numeric',
            'payment_fee' => 'required|numeric',
            'vat' => 'required|numeric',
        ]);

        try {
           
           
            $commission_log = new CommissionLog;
            $commission_log->cat_id = (int)$request->category;
            $commission_log->sub_cat_id = (int)$request->subcat;
            $commission_log->commssion = (float)$request->commssion;
            $commission_log->payment_fee = (float)$request->payment_fee;
            $commission_log->vat = (float)$request->vat;
            $commission_log->total_commission = (float)$request->vat+(float)$request->payment_fee+(float)$request->commssion;
            $commission_log->save();
            $is_active=0;
            if(isset($request->is_active)){
                $is_active=(int)$request->is_active;
            }
          
            $commission_mst=new CommissionMst;
            $commission_mst->commission_log_id = (int)$commission_log->commission_log_id;
            $commission_mst->cat_id = (int)$request->category;            
            $commission_mst->sub_cat_id = (int)$request->subcat;
            $commission_mst->commssion = (float)$request->commssion;
            $commission_mst->payment_fee = (float)$request->payment_fee;
            $commission_mst->vat = (float)$request->vat;
            $commission_mst->total_commission = (float)$request->vat+(float)$request->payment_fee+(float)$request->commssion;
            $commission_mst->is_active=$is_active;
            $commission_mst->save();
            return redirect()->route('managecommission.index')->with('flash_success', 'Commission Create Successfully');    
        } 

        catch (Exception $e) {
            return back()->with('flash_error', 'Commission Not Found');
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
            $commission_mst = CommissionMst::findOrFail($id);
            $category = Category::where("parent_id",null)->orWhere("parent_id",0)->get();
            return view('managecommission.edit',compact('commission_mst','category'));
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
        //
        $this->validate($request, [
            'category' => 'required|numeric',
            'commssion' => 'required|numeric',
            'payment_fee' => 'required|numeric',
            'vat' => 'required|numeric',
        ]);

        try {
           
           
            $commission_log = new CommissionLog;
            $commission_log->cat_id = (int)$request->category;
            $commission_log->sub_cat_id = (int)$request->subcat;
            $commission_log->commssion = (float)$request->commssion;
            $commission_log->payment_fee = (float)$request->payment_fee;
            $commission_log->vat = (float)$request->vat;
            $commission_log->total_commission = (float)$request->vat+(float)$request->payment_fee+(float)$request->commssion;
            $commission_log->save();
            $is_active=0;
            if(isset($request->is_active)){
                $is_active=(int)$request->is_active;
            }
          
            $commission_mst=CommissionMst::where("commission_id",$id)->first();
            $commission_mst->commission_log_id = (int)$commission_log->commission_log_id;
            $commission_mst->cat_id = (int)$request->category;            
            $commission_mst->sub_cat_id = (int)$request->subcat;
            $commission_mst->commssion = (float)$request->commssion;
            $commission_mst->payment_fee = (float)$request->payment_fee;
            $commission_mst->vat = (float)$request->vat;
            $commission_mst->total_commission = (float)$request->vat+(float)$request->payment_fee+(float)$request->commssion;
            $commission_mst->is_active=$is_active;
            $commission_mst->save();
            return redirect()->route('managecommission.index')->with('flash_success', 'Commission Create Successfully');    
        } 

        catch (Exception $e) {
            return back()->with('flash_error', 'Commission Not Found');
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
        CommissionMst::where('commission_id',(int)$id)->delete();
        return redirect()->route('managecommission.index')->with('flash_success', 'Commission Deleted Successfully');    
        echo $id; exit;
    }

    public function getsubCat(Request $request,$id){
      //echo  $id = $_REQUEST['id']; exit;
     // echo $id; exit;

        $Category = Category::select('id', 'name')
                    ->where('parent_id', $id)
                    ->orderBy('name')
                    ->get();
        return response()->json($Category);

    }
}
