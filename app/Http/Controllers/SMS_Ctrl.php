<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;

class SMS_Ctrl extends Controller
{
    public function index(Request $r)
    {
        return response()->json(['message'=>'index'],200);
    }
    //
    private function auth_base64()
    {
        $uname = 'mis@bghmc.doh.gov.ph';
        $pass = 'BaguioGen1902'; 
        return  base64_encode("$uname:$pass");
    }

    public function send_test_sms(Request $r)
    {
        // $pNum = '639760359457';
        $pNum = '639216688770';
        $text = "test from guzzle third sdf asdf asdf" . now();
        $client = new GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('POST', 'https://messagingsuite.smart.com.ph/cgphttp/servlet/sendmsg', [
            'headers' => [ 'Authorization' => "Basic " . $this->auth_base64() ], 
            'query' =>  [
                            'destination' => $pNum, 
                            'text'=>   $text,
                            // 'source' => '46812446' 
                            'source' => '639191601787'  
                        ], 
        ]);

        $STATUS_CODE = $res->getStatusCode();
        
        $RESPONSE_BODY = $res->getBody()->getContents(); 

        dd($STATUS_CODE,  $RESPONSE_BODY, $res);
         
    }

    public function localtokite(){
        // $pNum = '639216688770';
        // $text = "test from guzzle third sdf asdf asdf" . now();
        $client = new GuzzleHttp\Client(['http_errors' => false]);
        $res = $client->request('GET', 'https://bghmcsms.pagekite.me/api/sms/', [
            // 'headers' => [ 'Authorization' => "Basic " . $this->auth_base64() ], 
            // 'query' =>  [
            //                 'destination' => $pNum, 
            //                 'text'=>   $text,
            //                 // 'source' => '46812446' 
            //                 'source' => '639191601787'  
            //             ], 
        ]);

        $STATUS_CODE = $res->getStatusCode();
        
        $RESPONSE_BODY = $res->getBody()->getContents(); 

        dd('localtokite' , $STATUS_CODE,  $RESPONSE_BODY, $res);
    }


}
