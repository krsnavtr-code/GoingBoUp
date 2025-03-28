<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function authenticate()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.travelboutiqueonline.com/SharedAPI/SharedData.svc/rest/Authenticate",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false, // SSL verification disable
            CURLOPT_SSL_VERIFYHOST => false, // SSL host verification disable
        ]);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            return response()->json(['error' => curl_error($curl)], 500);
        }

        curl_close($curl);

        return response()->json(json_decode($response, true));
    }
}