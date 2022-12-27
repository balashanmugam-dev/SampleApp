<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BigcommerceController extends Controller
{
    public function callBigcommerceApi(){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => env('BC_BASE_API').env('BC_V3_PRODUCT_URL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $this->getRequiredHeaders(),
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

    public function getRequiredHeaders(){
        return [
            "Content-Type: application/json",
            "X-Auth-Token: ".env('BC_ACCESS_TOKEN')
        ];
    }
}
