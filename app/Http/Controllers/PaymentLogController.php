<?php

namespace App\Http\Controllers;

use App\Mail\PaymentSuccess;
use App\Order;
use App\PaymentLogs;
use App\PricePlan;
use App\Mail\PlaceOrder;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Session;

class PaymentLogController extends Controller
{
    public function DocRegistration(Request $request)
    {
        /**

         * @post('/order-confirm')
         * @name('frontend.order.payment.form')
         * @middlewares(web, globalVariable)
         */
        $environment = App::environment();
        $client = new Client();
        if (App::environment('local')){
            $url = "https://clinic.devumdaa.in/WebApi/V1";
        }
        if (App::environment('production')){
            $url = "https://clinic.umdaa.co/WebApi/V1";
        }
        $response = $client->post($url, [
            'headers' => ['Accept' => 'application/json', 'Content-type' => 'application/json',],
            'json' => [
                'requestname' => 'doctor_registration',
                'requestparameters' => [
                    'first_name' => $request->firstname,
                    'last_name' => $request->lastname,
                    'mobile' => $request->phonenumber,
                    'email' => $request->email,
                    'qualification' => $request->qualification,
                    'registration_code' => $request->regnumber,
                    'password' => $request->password,
                    'clinic_id' => $request->clinichospital,
                    'clinic_name' => $request->clinicname,
                    'location' => $request->location,
                    'department_id' => $request->department
                ],
            ],
        ]);
        $response = $response->getBody();
        $response = json_decode($response);
        if($response->code == '201') {
            $msg = $response->message;
            return redirect()->back()->with('message', $msg);
        } elseif($response->code == '200') {
            return $this->order_payment_form($request);
        }
    }
    public function order_payment_form(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'order_id' => 'required|string',
            'payment_gateway' => 'required|string',
        ]);
        $order_details = Order::find($request->order_id);
        $payment_log_id = PaymentLogs::create([
            'email' => $request->email,
            'name' => $request->name,
            'package_name' => $order_details->package_name,
            'package_price' => $order_details->package_price,
            'package_gateway' => $request->payment_gateway,
            'order_id' => $request->order_id,
            'status' => 'pending',
            'track' => Str::random(10) . Str::random(10),
        ])->id;
        $payment_details = PaymentLogs::find($payment_log_id);
        if ($request->payment_gateway == 'paytm') {
            $payable_amount = substr($payment_details->package_price, 0);
            $payable_percent = '1.18';
            $payable_amount = $payable_amount * $payable_percent;
            // $payable_amount ='1';
            $amount = get_static_option('site_global_currency') == 'USD' ? $payable_amount * get_static_option('site_usd_to_nri_exchange_rate') : $payable_amount;

            $data_for_request = $this->handlePaytmRequest($payment_details->track, $amount);

            $paytm_txn_url = PAYTM_TXN_URL;
            $paramList = $data_for_request['paramList'];
            $checkSum = $data_for_request['checkSum'];

            return view('frontend.payment.paytm')->with([
                'paytm_txn_url' => $paytm_txn_url,
                'paramList' => $paramList,
                'checkSum' => $checkSum,
            ]);
        } elseif ($request->payment_gateway == 'manual_payment') {
            $order = Order::where('id', $request->order_id)->first();
            $order->status = 'pending';
            $order->save();
            PaymentLogs::where('order_id', $request->order_id)->update([
                'transaction_id' => $request->trasaction_id,
            ]);
            return redirect()->route(
                'frontend.order.payment.success',
                $request->order_id
            );
        }
        return redirect()->route('homepage');
    }

    public function paytm_ipn(Request $request)
    {
        /**

         * @post('/paytm-ipn')
         * @name('frontend.paytm.ipn')
         * @middlewares(web, globalVariable)
         */
        $payment_track = $request['ORDERID'];
        $payment_logs = PaymentLogs::where( 'track', $payment_track )->first();
        $order_id = $payment_logs->order_id;

        if ( 'TXN_SUCCESS' === $request['STATUS'] ) {
            Order::where('id',$order_id)->update(['payment_status' => 'complete']);

            $transaction_id = $request['TXNID'];
            PaymentLogs::where('track',$payment_track)->update([
                'transaction_id' => $transaction_id,
                'status' => 'complete'
            ]);
            //send success mail to user and admin
            self::send_order_mail($payment_logs->order_id);
            Mail::to($payment_logs->email)->send(new PaymentSuccess($payment_logs));

            return redirect()->route('frontend.order.payment.success',$order_id);

        } else if( 'TXN_FAILURE' === $request['STATUS'] ){
            return redirect()->route('frontend.order.payment.cancel',$order_id);
        }
    }

    public function handlePaytmRequest($order_id, $amount)
    {
        // Load all functions of encdec_paytm.php and config-paytm.php
        $this->getAllEncdecFunc();
        $this->getConfigPaytmSettings();

        $checkSum = '';
        $paramList = [];

        // Create an array having all required parameters for creating checksum.
        $paramList['MID'] = get_static_option('paytm_merchant_mid');
        $paramList['ORDER_ID'] = $order_id;
        $paramList['CUST_ID'] = $order_id;
        $paramList['INDUSTRY_TYPE_ID'] = 'Retail';
        $paramList['CHANNEL_ID'] = 'WEB';
        $paramList['TXN_AMOUNT'] = $amount;
        $paramList['WEBSITE'] = get_static_option('paytm_merchant_website');
        $paramList['CALLBACK_URL'] = route('frontend.paytm.ipn');
        $paytm_merchant_key = get_static_option('paytm_merchant_key');

        //Here checksum string will return by getChecksumFromArray() function.
        $checkSum = getChecksumFromArray($paramList, $paytm_merchant_key);

        return [
            'checkSum' => $checkSum,
            'paramList' => $paramList,
        ];
    }

    public function send_order_mail($order_id){

        $order_details = Order::find($order_id);
        $package_details = PricePlan::where('id',$order_details->package_id)->first();
        $all_fields = unserialize($order_details->custom_fields);
        unset($all_fields['package']);

        $all_attachment = unserialize($order_details->attachment);
        $order_mail = get_static_option('order_page_form_mail') ? get_static_option('order_page_form_mail') : get_static_option('site_global_email');

        Mail::to($order_mail)->send(new PlaceOrder($all_fields, $all_attachment, $package_details));
    }
    /**
     * Get all the functions from encdec_paytm.php
     */
    function getAllEncdecFunc()
    {
        function encrypt_e($input, $ky)
        {
            $key = html_entity_decode($ky);
            $iv = '@@@@&&&&####$$$$';
            $data = openssl_encrypt($input, 'AES-128-CBC', $key, 0, $iv);
            return $data;
        }

        function decrypt_e($crypt, $ky)
        {
            $key = html_entity_decode($ky);
            $iv = '@@@@&&&&####$$$$';
            $data = openssl_decrypt($crypt, 'AES-128-CBC', $key, 0, $iv);
            return $data;
        }

        function pkcs5_pad_e($text, $blocksize)
        {
            $pad = $blocksize - (strlen($text) % $blocksize);
            return $text . str_repeat(chr($pad), $pad);
        }

        function pkcs5_unpad_e($text)
        {
            $pad = ord($text[strlen($text) - 1]);
            if ($pad > strlen($text)) {
                return false;
            }
            return substr($text, 0, -1 * $pad);
        }

        function generateSalt_e($length)
        {
            $random = '';
            srand((float) microtime() * 1000000);

            $data = 'AbcDE123IJKLMN67QRSTUVWXYZ';
            $data .= 'aBCdefghijklmn123opq45rs67tuv89wxyz';
            $data .= '0FGH45OP89';

            for ($i = 0; $i < $length; $i++) {
                $random .= substr($data, rand() % strlen($data), 1);
            }

            return $random;
        }

        function checkString_e($value)
        {
            if ($value == 'null') {
                $value = '';
            }
            return $value;
        }

        function getChecksumFromArray($arrayList, $key, $sort = 1)
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . '|' . $salt;
            $hash = hash('sha256', $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getChecksumFromString($str, $key)
        {
            $salt = generateSalt_e(4);
            $finalString = $str . '|' . $salt;
            $hash = hash('sha256', $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }

        function verifychecksum_e($arrayList, $key, $checksumvalue)
        {
            $arrayList = removeCheckSumParam($arrayList);
            ksort($arrayList);
            $str = getArray2StrForVerify($arrayList);
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);

            $finalString = $str . '|' . $salt;

            $website_hash = hash('sha256', $finalString);
            $website_hash .= $salt;

            $validFlag = 'FALSE';
            if ($website_hash == $paytm_hash) {
                $validFlag = 'TRUE';
            } else {
                $validFlag = 'FALSE';
            }
            return $validFlag;
        }

        function verifychecksum_eFromStr($str, $key, $checksumvalue)
        {
            $paytm_hash = decrypt_e($checksumvalue, $key);
            $salt = substr($paytm_hash, -4);

            $finalString = $str . '|' . $salt;

            $website_hash = hash('sha256', $finalString);
            $website_hash .= $salt;

            $validFlag = 'FALSE';
            if ($website_hash == $paytm_hash) {
                $validFlag = 'TRUE';
            } else {
                $validFlag = 'FALSE';
            }
            return $validFlag;
        }

        function getArray2Str($arrayList)
        {
            $findme = 'REFUND';
            $findmepipe = '|';
            $paramStr = '';
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pos = strpos($value, $findme);
                $pospipe = strpos($value, $findmepipe);
                if ($pos !== false || $pospipe !== false) {
                    continue;
                }

                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= '|' . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function getArray2StrForVerify($arrayList)
        {
            $paramStr = '';
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= '|' . checkString_e($value);
                }
            }
            return $paramStr;
        }

        function redirect2PG($paramList, $key)
        {
            $hashString = getchecksumFromArray($paramList, $key);
            $checksum = encrypt_e($hashString, $key);
        }

        function removeCheckSumParam($arrayList)
        {
            if (isset($arrayList['CHECKSUMHASH'])) {
                unset($arrayList['CHECKSUMHASH']);
            }
            return $arrayList;
        }

        function getTxnStatus($requestParamList)
        {
            return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
        }

        function getTxnStatusNew($requestParamList)
        {
            return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
        }

        function initiateTxnRefund($requestParamList)
        {
            $CHECKSUM = getRefundChecksumFromArray(
                $requestParamList,
                PAYTM_MERCHANT_KEY,
                0
            );
            $requestParamList['CHECKSUM'] = $CHECKSUM;
            return callAPI(PAYTM_REFUND_URL, $requestParamList);
        }

        function callAPI($apiURL, $requestParamList)
        {
            $jsonResponse = '';
            $responseParamList = [];
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData),
            ]);
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }

        function callNewAPI($apiURL, $requestParamList)
        {
            $jsonResponse = '';
            $responseParamList = [];
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($apiURL);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($postData),
            ]);
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
        function getRefundChecksumFromArray($arrayList, $key, $sort = 1)
        {
            if ($sort != 0) {
                ksort($arrayList);
            }
            $str = getRefundArray2Str($arrayList);
            $salt = generateSalt_e(4);
            $finalString = $str . '|' . $salt;
            $hash = hash('sha256', $finalString);
            $hashString = $hash . $salt;
            $checksum = encrypt_e($hashString, $key);
            return $checksum;
        }
        function getRefundArray2Str($arrayList)
        {
            $findmepipe = '|';
            $paramStr = '';
            $flag = 1;
            foreach ($arrayList as $key => $value) {
                $pospipe = strpos($value, $findmepipe);
                if ($pospipe !== false) {
                    continue;
                }

                if ($flag) {
                    $paramStr .= checkString_e($value);
                    $flag = 0;
                } else {
                    $paramStr .= '|' . checkString_e($value);
                }
            }
            return $paramStr;
        }
        function callRefundAPI($refundApiURL, $requestParamList)
        {
            $jsonResponse = '';
            $responseParamList = [];
            $JsonData = json_encode($requestParamList);
            $postData = 'JsonData=' . urlencode($JsonData);
            $ch = curl_init($refundApiURL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL, $refundApiURL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = [];
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $jsonResponse = curl_exec($ch);
            $responseParamList = json_decode($jsonResponse, true);
            return $responseParamList;
        }
    }

    /**
     * Config Paytm Settings from config_paytm.php file of paytm kit
     */
    function getConfigPaytmSettings()
    {
        define('PAYTM_ENVIRONMENT', 'PROD'); // PROD //TEST
        define('PAYTM_MERCHANT_KEY', get_static_option('paytm_merchant_key')); //Change this constant's value with Merchant key downloaded from portal
        define('PAYTM_MERCHANT_MID', get_static_option('paytm_merchant_mid')); //Change this constant's value with MID (Merchant ID) received from Paytm
        define('PAYTM_MERCHANT_WEBSITE',get_static_option('paytm_merchant_website')); //Change this constant's value with Website name received from Paytm

        $PAYTM_STATUS_QUERY_NEW_URL =
            'https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
        $PAYTM_TXN_URL =
            'https://securegw-stage.paytm.in/theia/processTransaction';
        if (PAYTM_ENVIRONMENT == 'PROD') {
            $PAYTM_STATUS_QUERY_NEW_URL =
                'https://securegw.paytm.in/merchant-status/getTxnStatus';
            $PAYTM_TXN_URL =
                'https://securegw.paytm.in/theia/processTransaction';
        }
        define('PAYTM_REFUND_URL', '');
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
    }
}
