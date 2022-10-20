<?php

namespace App\Wallet;

class Msegat
{
    public static function sendSMS($numbers, $msg)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        curl_setopt($ch, CURLOPT_POST, true);

        //userName (required, string, username for the account in Msegat.com)
        //userSender (required, string, sender name, should be activated from Msegat.com)
        //apiKey (required, string, apiKey associated with the account)
        //numbers (required, string, international format without zeros separated by comma, example: "966xxxxxxxxx" or "966xxxxxxxxx,966xxxxxxxxx,966xxxxxxxxx")
        //userSender (required, string, sender name, should be activated from Msegat.com)

        $fields = [
            "userName"   => config('msegat.user_name'),
            "userSender" => config('msegat.user_sender'),
            "apiKey"     => config('msegat.api_key'),
            "numbers"    => $numbers,
            "msg"        => $msg
        ];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json"
        ));

        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);

//        dd($info["http_code"]);
//        dd(json_decode($response));
    }
}