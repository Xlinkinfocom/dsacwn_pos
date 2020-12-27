<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerGroup;
use App\Customer;
use App\Deposit;
use App\User;
use App\State;
use App\District;
use Illuminate\Validation\Rule;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Roles;
use App\Biller;
use App\Warehouse;
use Hash;
use Keygen;


class SellerController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        //dd($role); exit;
        if($role->hasPermissionTo('users-index')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            $lims_user_list = User::where('is_deleted', false)->where('is_supersdmin', 0)->where('role_id', 7)->get();
            return view('seller.index', compact('lims_user_list', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
     }

    public function create()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-add')){
            $lims_role_list = Roles::where('is_active', true)->where('id', 7)->get();
            //$lims_biller_list = Biller::where('is_active', true)->get();
            //$lims_warehouse_list = Warehouse::where('is_active', true)->get();

            $states = State::select('id', 'name')->orderBy('name')->get();

            return view('seller.create', compact('lims_role_list', 'states'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function getDistricts(Request $request)
    {
        $state_id = $request->state_id;

        $districts = District::select('id', 'name')
                    ->where('state_id', $state_id)
                    ->orderBy('name')
                    ->get();
        return response()->json($districts);
    }

    public function store(Request $request)
    {        
        /* $lims_seller_data = $request->all();
        if($lims_seller_data['phone']){
            $this->validate($request, [
                'phone' => [
                    'max:255',
                        Rule::unique('user')->where(function ($query) {
                        return $query->where('is_active', 1);
                    }),
                ],
            ]);
        } */

        $panno_image = "";
        $citizenship_document = "";
        $passportsizephoto = "";
        $gst_document = "";
        $check_image = "";
        $extn = "";

        if($request->file('panno_image'))
        {
            dd($request->file('panno_image'));
            
            $extn = $request->file('panno_image')->getClientOriginalExtension();
            $panno_image = "panno_".rand().".".$extn;
            $tempfile = File::get($request->panno_image);
            Storage::disk('local')->put('public/images/seller/panno_img/'.$panno_image, $tempfile);
        }

        if($request->file('citizenship_document'))
        {
            $extn = $request->file('citizenship_document')->getClientOriginalExtension();
            $citizenship_document = "citizenship_".".".$extn;
            $tempfile = File::get($request->citizenship_document);
            Storage::disk('local')->put('public/images/seller/citizen_doc/'.$citizenship_document, $tempfile);
        }

        if($request->file('passportsizephoto'))
        {
            $extn = $request->file('passportsizephoto')->getClientOriginalExtension();
            $passportsizephoto = "passportsize_".".".$extn;
            $tempfile = File::get($request->passportsizephoto);
            Storage::disk('local')->put('public/images/seller/passport_photo/'.$passportsizephoto, $tempfile);
        }

        if($request->file('check_image'))
        {
            $extn = $request->file('check_image')->getClientOriginalExtension();
            $check_image = "check_".rand().".".$extn;
            $tempfile = File::get($request->check_image);
            Storage::disk('local')->put('public/images/seller/cancel_chq/'.$check_image, $tempfile);
        }

        /* $lims_customer_data['is_active'] = true;
        $message = 'Customer created successfully';
        if($lims_customer_data['email']){
            try{
                Mail::send( 'mail.customer_create', $lims_customer_data, function( $message ) use ($lims_customer_data)
                {
                    $message->to( $lims_customer_data['email'] )->subject( 'New Customer' );
                });
            }
            catch(\Exception $e){
                $message = 'Customer created successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            }   
        }
        
        Customer::create($lims_customer_data);
        if($lims_customer_data['pos'])
            return redirect('pos')->with('message', $message);
        else
            return redirect('customer')->with('create_message', $message); */
    }


    public function generatePassword()
    {
        $id = Keygen::numeric(6)->generate();
        return $id;
    }

    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-edit')){
            $lims_user_data = User::find($id);
            $lims_role_list = Roles::where('is_active', true)->where('id', 7)->get();
        //    $lims_biller_list = Biller::where('is_active', true)->get();
          //  $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            //return view('seller.edit', compact('lims_user_data', 'lims_role_list', 'lims_biller_list', 'lims_warehouse_list'));
            return view('seller.edit', compact('lims_user_data', 'lims_role_list', 'lims_biller_list', 'lims_warehouse_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $this->validate($request, [
            'name' => [
                'max:255',
                Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'email' => [
                'email',
                'max:255',
                    Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
        ]);

        $input = $request->except('password');
        if(!isset($input['is_active']))
            $input['is_active'] = false;
        if(!empty($request['password']))
            $input['password'] = bcrypt($request['password']);
        $lims_user_data = User::find($id);
        $lims_user_data->update($input);
        return redirect('seller')->with('message2', 'Data updated successfullly');
    }
    public function importCustomer(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('customers-add')){
            $upload=$request->file('file');
            $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
            if($ext != 'csv')
                return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
            $filename =  $upload->getClientOriginalName();
            $filePath=$upload->getRealPath();
            //open and read
            $file=fopen($filePath, 'r');
            $header= fgetcsv($file);
            $escapedHeader=[];
            //validate
            foreach ($header as $key => $value) {
                $lheader=strtolower($value);
                $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
                array_push($escapedHeader, $escapedItem);
            }
            //looping through othe columns
            while($columns=fgetcsv($file))
            {
                if($columns[0]=="")
                    continue;
                foreach ($columns as $key => $value) {
                    $value=preg_replace('/\D/','',$value);
                }
               $data= array_combine($escapedHeader, $columns);
               $lims_customer_group_data = CustomerGroup::where('name', $data['customergroup'])->first();
               $customer = Customer::firstOrNew(['name'=>$data['name']]);
               $customer->customer_group_id = $lims_customer_group_data->id;
               $customer->name = $data['name'];
               $customer->company_name = $data['companyname'];
               $customer->email = $data['email'];
               $customer->phone_number = $data['phonenumber'];
               $customer->address = $data['address'];
               $customer->city = $data['city'];
               $customer->state = $data['state'];
               $customer->postal_code = $data['postalcode'];
               $customer->country = $data['country'];
               $customer->is_active = true;
               $customer->save();
               $message = 'Customer Imported Successfully';
               if($data['email']){
                    try{
                        Mail::send( 'mail.customer_create', $data, function( $message ) use ($data)
                        {
                            $message->to( $data['email'] )->subject( 'New Customer' );
                        });
                    }
                    catch(\Exception $e){
                        $message = 'Customer imported successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                    }
                }
            }
            return redirect('customer')->with('import_message', $message);
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function getDeposit($id)
    {
        $lims_deposit_list = Deposit::where('customer_id', $id)->get();
        $deposit_id = [];
        $deposits = [];
        foreach ($lims_deposit_list as $deposit) {
            $deposit_id[] = $deposit->id;
            $date[] = $deposit->created_at->toDateString() . ' '. $deposit->created_at->toTimeString();
            $amount[] = $deposit->amount;
            $note[] = $deposit->note;
            $lims_user_data = User::find($deposit->user_id);
            $name[] = $lims_user_data->name;
            $email[] = $lims_user_data->email;
        }
        if(!empty($deposit_id)){
            $deposits[] = $deposit_id;
            $deposits[] = $date;
            $deposits[] = $amount;
            $deposits[] = $note;
            $deposits[] = $name;
            $deposits[] = $email;
        }
        return $deposits;
    }

    public function addDeposit(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $lims_customer_data = Customer::find($data['customer_id']);
        $lims_customer_data->deposit += $data['amount'];
        $lims_customer_data->save();
        Deposit::create($data);
        $message = 'Data inserted successfully';
        if($lims_customer_data->email){
            $data['name'] = $lims_customer_data->name;
            $data['email'] = $lims_customer_data->email;
            $data['balance'] = $lims_customer_data->deposit - $lims_customer_data->expense;
            try{
                Mail::send( 'mail.customer_deposit', $data, function( $message ) use ($data)
                {
                    $message->to( $data['email'] )->subject( 'Recharge Info' );
                });
            }
            catch(\Exception $e){
                $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            }
        }
        return redirect('customer')->with('create_message', $message);
    }

    public function updateDeposit(Request $request)
    {
        $data = $request->all();
        $lims_deposit_data = Deposit::find($data['deposit_id']);
        $lims_customer_data = Customer::find($lims_deposit_data->customer_id);
        $amount_dif = $data['amount'] - $lims_deposit_data->amount;
        $lims_customer_data->deposit += $amount_dif;
        $lims_customer_data->save();
        $lims_deposit_data->update($data);
        return redirect('customer')->with('create_message', 'Data updated successfully');
    }

    public function deleteDeposit(Request $request)
    {
        $data = $request->all();
        $lims_deposit_data = Deposit::find($data['id']);
        $lims_customer_data = Customer::find($lims_deposit_data->customer_id);
        $lims_customer_data->deposit -= $lims_deposit_data->amount;
        $lims_customer_data->save();
        $lims_deposit_data->delete();
        return redirect('customer')->with('not_permitted', 'Data deleted successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $customer_id = $request['customerIdArray'];
        foreach ($customer_id as $id) {
            $lims_customer_data = Customer::find($id);
            $lims_customer_data->is_active = false;
            $lims_customer_data->save();
        }
        return 'Customer deleted successfully!';
    }

    public function destroy($id)
    {
        $lims_customer_data = Customer::find($id);
        $lims_customer_data->is_active = false;
        $lims_customer_data->save();
        return redirect('customer')->with('not_permitted','Data deleted Successfully');
    }
}
