<?php
namespace App\Http\Controllers\API;
//use RobinCSamuel\LaravelMsg91;
use RobinCSamuel\LaravelMsg91\Facades\LaravelMsg91;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    

    public function message(Request $request){
        // $result = LaravelMsg91::message($mobile, 'This is a test message');
        $curl = curl_init();
    curl_setopt_array($curl, array(
            CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?otp_length=4&authkey=189060AXjlEHpzX5a3b51db&sender=MSGIND&mobile=".$request->mobile,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
                 
    }
    public function verifyotp(Request $request){
       
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://control.msg91.com/api/verifyRequestOTP.php?authkey=189060AXjlEHpzX5a3b51db&mobile=".$request->mobile."&otp=".$request->otp,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
         if ($err) {
            return $err;
        } else {
            return $response;
        }

    }

}
