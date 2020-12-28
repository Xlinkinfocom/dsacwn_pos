<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255|unique:users',
            'email' => [
                'email',
                'max:255',
                    Rule::unique('users')->where(function ($query) {
                    return $query->where('is_deleted', false);
                }),
            ],
            'password' => 'required|string|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //return $data;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'company_name' => $data['company_name'],
            'role_id' => $data['role_id'],
            'biller_id' => $data['biller_id'],
            'warehouse_id' => $data['warehouse_id'],
            'is_active' => false,
            'is_deleted' => false,
            'password' => bcrypt($data['password']),
        ]);
    }
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createSeller(array $data)
    {
        //return $data;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'company_name' => $data['company_name'],
            'role_id' => $data['role_id'],
           // 'biller_id' => $data['biller_id'],
            //'warehouse_id' => $data['warehouse_id'],
            'is_active' => true,
            'is_deleted' => false,
            'seller_url'=>strtolower(preg_replace('/\s+/', '', $data['name'])),
            'password' => bcrypt($data['password']),
        ]);
    }
     /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function sellerRegistrationForm()
    {
        $lims_role_list = \App\Roles::where('is_active',true)->get();
        $lims_biller_list = \App\Biller::where('is_active',true)->get();
        $lims_warehouse_list = \App\Warehouse::where('is_active',true)->get();
        return view('register_seller', compact('lims_role_list', 'lims_biller_list', 'lims_warehouse_list'));
    }

     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerSeller(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->createSeller($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
      /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSuperLoginForm()
    {
        return view('auth.supperAdminLogin');
    }
}
