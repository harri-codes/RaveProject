<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use the Rave Facade
use Rave;

class RaveController extends Controller
{

    /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize(Request $request)
    {
        //This initializes payment and redirects to the payment gateway
        //The initialize method takes the parameter of the redirect URL
        switch ($request->method()) {
            case 'POST':
                Rave::initialize(route('callback'));
                break;

            case 'GET':
                return redirect()->route('/');
                break;
        }
    }


    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback(Request $request)
    {
        //now in your callback, to access the response body you can do request()->resp
        $body = $request->resp;

        //viola there you have it, but you might have issue accessing
        // the txRef from this body as it is purely a string so all you have to do is
        // to convert the $body back to json object like:
        $obj = json_decode($body,true);

        //now lets get the txRef using $obj
        $txRef = $obj['data']['data']['txRef'];

        //now you have your txRef you can pass it into verification endpoint as a param like so:
        $data = Rave::verifyTransaction($txRef); // thats all you are good to go

        $chargeResponsecode = $data->data->chargecode;
        $chargeAmount = $data->data->chargedamount;
        $chargeCurrency = $data->data->currency;

        $amount = $data->data->amount;
        $currency = "KES";
        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency)) {
            //if success
            //do your thing here
        } else {
            // else take you to the error page
        }

    }
}
