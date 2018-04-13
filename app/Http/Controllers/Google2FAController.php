<?php

namespace App\Http\Controllers;

use Crypt;
use Google2FA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use \ParagonIE\ConstantTime\Base32;

class Google2FAController extends Controller
{
    //
    use ValidatesRequests;


    /** 
    *   creates a new authentication controller instance.
    *   
    *
    *   @return void
    */

    public function __construct(){
        $this->middleware('web');
    }

    /**
    *   @param \Illuminate\Http\Request $request
    *   @return \Illuminate\Http\Response
    *
    */

    public function enableTwoFactor(Request $request){
        // generate a new a secret
        $secret = $this->generateSecret();

        //get current user
        $user = $request->user();

        //encrypt and then save the secret
        $user->google2fa_secret = Crypt::encrypt($secret);
        $user->save();

        //generate image for QR barcode
        $imageDataUri = Google2FA::getQRCodeInLine(
            $request->getHttpHost(),
            $user->email,
            $secret,
            200
        );

        return view('2fa/enableTwoFactor',['image'=> $imageDataUri, 'secret'=>$secret]);

    }

    /**
    *
    *   @param \Illuminate\Http\Request $request
    *   @return \Illuminate\Http\Response
    */

    public function disableTwoFactor(Request $request){

        //get user
        $user = $request->user();

        // make the secret column blank
        $user->google2fa_secret = null;
        $user->save();
        
        return view('2fa/disableTwoFactor');
    }

    /**
    *   Generate a secret key in Base32 format
    *
    *   @return string
    */

    private function generateSecret(){
        $randomBytes = random_bytes(10);
        return Base32::encodeUpper($randomBytes);
    }
}
