<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use URL;

class MainController extends Controller
{
    public function index( )
    {
        $ip=\Request::ip();
        $loc = file_get_contents('http://api.ipapi.com/'.$ip.'?access_key=ec9ad2d8ecf097bb5720e17b17e82aff&format=1');
        $obj = json_decode($loc);
        $cd=$obj->country_code;
        $cd=strtolower($cd);
        $domain_url=\config::get('app.domain_url');
        $url=URL::to('/');
        if($cd=='in'|| $cd=='sa'|| $cd=='om'|| $cd=='ae')
        {
            return Redirect::to($url."/".$cd);
        }
        else{
            return Redirect::to('in');
        }
    } 
}
