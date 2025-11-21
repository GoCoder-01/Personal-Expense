<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\OTPData;
use App\Models\UserToken;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function getOTP(Request $request)
    {
        if(!isset($request->username) && !isset($request->password))
        {
            return response()->json([
                'error_status' => true,
                'token_status' => false,
                'message'      => 'Username or password is required',
            ]);
        }

        $username = $request->username;
        $password = $request->password;

        $user = User::checkUsername($username);
        if(is_null($user))
        {
            return $this->commonError('Mobile number is not registered');
        }

        if($user->active_status)
        {
            return $this->commonError('User is not active');
        }

        if($user->pass_max_count >= 5)
        {
            return $this->commonError('You have reached maxinum password attempts, Please try later');
        }

        if($user->otp_max_count >= 5)
        {
            return $this->commonError("OTP Can't be sent Please try after some time");
        }

        if(!Hash::check($password, $user->password))
        {
            $user->pass_max_count = $user->pass_max_count + 1;
            $user->save();
            return $this->commonError('Invalid username or password');
        }

        //$otp = $this->generateOTP(6);
        $otp = '123456';

        $OTPData['user_id'] = $user->id;
        $OTPData['otp_code'] = Hash::make($otp);
        $OTPData['expires_at'] = now()->addMinute(10);
        $OTPData['status']     = '1';
        
        $otp_id = OTPData::insertGetId($OTPData);
        $user->last_otp_sent_at = now();
        if(!$user->save())
        {
            return $this->commonError('OTP Sent Failed');
        }

        $token = Str::uuid()->toString();

        Cache::put('otp_'.$token, [
            'user_id' => $user->id,
            'otp' => $otp,
            'otp_id' => $otp_id,
            'expire_at' => now()->addMinute(10),
        ], 660);

        $token  = encrypt($token);

        return response()->json([
            'error_status' => false,
            'token_status' => false,
            'message'      => 'OTP Sent Successfully',
            'data'         => $token,
        ]);
        
    }

    public function verifyOTP(Request $request)
    {
        if(!isset($request->token) && !isset($request->otp))
        {
            return $this->commonError('Inalid Request Data');
        }

        $otp = $request->otp;
        $request_ip = $request->ip;
        $token = decrypt($request->token);

        $data = Cache::get('otp_'.$token);

        if(is_null($data))
        {
            return $this->commonError('Invlid or Expired Token data');
        }
        
        if(now()->greaterThan($data['expire_at']))
        {
            OTPData::where('id', '=', $data['otp_id'])->update(['status' => '3']);
            return $this->commonError('OTP Expired');
        }

        if($otp != $data['otp'])
        {
            return $this->commonError('Invalid OTP');
        }

        Cache::forget('otp_'.$token);
        OTPData::where('id', '=', $data['otp_id'])->update(['status' => '2', 'used_at' => now()]);

        $token = '';
        $user_id = $data['user_id'];
        if(isset($request->device_id))
        {
            $token = $this->generateToken($user_id, $request_ip, $request->device_id);
        }
        else
        {
            $token = $this->generateToken($user_id, $request_ip, null);   
        }

        $user = User::select('*')->where('id', '=', $user_id)->first();

        $tokenData['user_id'] = $user_id;
        $tokenData['token'] = $token;
        $tokenData['token_status'] = '1';

        $token_id = UserToken::insertGetId($tokenData);
        $user->token_data_id = $token_id;
        if(!$user->save())
        {
            return $this->commonError('Internal Server Error');
        }

        session()->put('user_id', $user->id);
        session()->put('name', $user->name);
        session()->put('photo_path', $user->profile);
        session()->put('token', $token);

        $DataOUT = (Object)array(
            'token' => $token,
            'user_id' => $user_id
        );

        return response()->json([
            'error_status' => false,
            'token_status' => true,
            'messege'      => 'Login Successful',
            'data'         => $DataOUT
        ]);
    }

    public function generateOTP($nod)
    {
        $otp = '';
        for($i=1; $i >= $nod; $i++)
        {
            $otp = $otp.random_int(0, 9);
        }
        
        return $otp;
    }

    private function randomString($noc)
    {
        $string_chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $length = strlen($string_chars);

        $random_string = '';
        for($i=1; $i==$noc; $i++)
        {
            $random_string .= $string_chars[random_int(0, $length-1)];
        }

        return $random_string;
    }

    private function generateToken($user_id, $request_ip, $device_id = null)
    {
        $tokenString  = $user_id.'||'.now().'||'.$request_ip.'||'.$this->randomString(15);

        if(is_null($device_id))
        {
            $tokenString  = '||'.$this->randomString(15);
        }
        else
        {
            $tokenString  = '||'.$device_id;
        }
        $token = encrypt($tokenString);
        return $token;
    }

    public function logout(Request $request)
    {
        $user_id = session('user_id');
        $token = session('token');

        UserToken::where('user_id', $user_id)
            ->where('token', $token)
            ->update(['token_status' => '0']);

        session()->flush();

        return redirect('/login');
    }

    public function commonError($messege)
    {
        return response()->json([
            'error_status' => true,
            'token_status' => false,
            'message'      => $messege,
            'data'         => null,
        ]);
    }
}
