<?php

namespace App\Http\Controllers\SellOnline\facebook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebHookController extends Controller
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            try {
                session_start();
            } catch (\ErrorException $e) {

            }
        }
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        $this->verifyAccessToken();
        $input = file_get_contents('php://input');
        $input = json_decode($input, true);
        $message = $input['entry'][0]['messaging'][0]['message']['text'];
        $id = $input['entry'][0]['messaging'][0]['sender']['id'];
        $response = '{
            "messaging_type": "RESPONSE",
            "recipient":{
                "id": "'.$id.'"
            },
            "message":{
                "text":"Chào bạn tôi có thể giúp gì cho bạn"
            }';
        $this->sendResponse($response);
    }

    public function sendResponse($response)
    {
        $access_token = "EAAbZAbhdOyhsBAMwYntpX8uPE6knoGukBEbziHdGHvfMEvSxJfkiigizzL7RJGtsrf4JWjK6ctze0bVYZB6e06P0ytWsA31p9xZClw4ZBLwi81QKmosYsfSquxyFaHuBZCvGb83upMgCDV9goiElWZB5amklyTmBFJlBD7fIC6iXHzZBsokrQg7";
        $url = 'https://graph.facebook.com/v15.0/me/messages?access_token='.$access_token;
        $ch = curl_init();
        $headers = array('Content-Type: application/json');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $st = curl_exec($ch);
        $result = json_decode($st, true);
        return $result;
    }

    public function verifyAccessToken()
    {
        $my_verify_token="7878789898HYA";
        $challenge = $_REQUEST['hub_challenge'];
        $verify_token = $_REQUEST['hub_verify_token'];
        if($my_verify_token == $verify_token) {
            echo $challenge;
            exit;
        }
    }
}
