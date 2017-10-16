<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('themes.laracus.home');
    }

    /**
     * Api test
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        $client = new Client();
        $res = $client->get('http://213.149.116.38/Donator/DonatorB2BJson.svc/getallcategories', ['auth' =>  ['SmartWeb', 'D0n@46!t0r2$73']]);
        echo $res->getBody();
    }
}
