<?php

namespace Modules\MailChimp\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;
use Config;
use Newsletter;
use Session;
class MailChimpController extends Controller
{
    public function subscribe(Request $request)
    {
        // dd($request->email);
        if ( ! Newsletter::isSubscribed($request->email) ) {
            Newsletter::subscribe($request->email);
            $message="Thank you for subscribing us";
        }
        else{
            $message="Sorry! You have already subscribed";
        }
        return response()->json($message);
    }
}
