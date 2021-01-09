<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Stransaction;
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
    public function index()
    {  
            
    }
}