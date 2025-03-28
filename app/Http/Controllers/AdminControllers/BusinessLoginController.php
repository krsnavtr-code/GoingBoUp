<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessLogin;


class BusinessLoginController extends Controller
{
    public function sendOtp(Request $request)
    {
        $otp = rand(100000, 999999); // Generate a 6-digit OTP
        $request->session()->put('otp', $otp); // Store OTP in session

        // Send OTP email using PHP mail function
        $message = "Your OTP for verification is: $otp";
        mail($request->email, 'OTP Verification', $message);

        return response()->json(['status' => 'otp_sent']);
    }

    // Function to verify OTP
    public function verifyOtp(Request $request)
    {
        $otp = $request->otp;
        $sessionOtp = $request->session()->get('otp');

        if ($otp == $sessionOtp) {
            return response()->json(['status' => 'otp_verified']);
        }

        return response()->json(['status' => 'otp_failed'], 400);
    }

    public function web_store(Request $request)
    {
        // dd(request()->all());

        // Generate username with company name + random 5 digit number + "_goingbo"
        $randomNumber = rand(10000, 99999);
        $username = $request->companyName . '_' . $randomNumber . '_goingbo';

        // Store data in business_login table
        $businessLogin = BusinessLogin::create([
            'company_name' => $request->companyName,
            'contact_no' => $request->contactNo,
            'email' => $request->email,
            'city' => $request->city,
            'username' => $username,
            'password' => $request->password,  
            'business_type' => $request->business_type
        ]);


        $message = "Dear User,\n\nYour account has been successfully created. \nUsername: \"{$username}\"\nPassword: \"{$request->password}\"\n\nDon't share these credentials with anyone.\n\nYou can log in here: https://goingbo.com/admin/business-login";

        mail($request->email, 'Your Account Credentials', $message);

        return redirect()->back()->with('success', 'Registration successful! Check your email for login details.');
    }

    public function web_login(Request $request)
    {
        $businessLogin = BusinessLogin::where('username', $request->username)->first();

        if ($businessLogin && $request->password == $businessLogin->password) {
           // Store session and redirect based on business type
           session(['businessId' => $businessLogin->id, 'businessLogin' => $businessLogin]);
            
           return redirect('admin/business-login/dashboard');
       } else {
           return redirect('admin/business-login')->withErrors(['error' => 'Invalid login credentials.']);
       }
    }

    public function index(){
        return view('admin.business.dashboard');
    }
    
    public function logout(Request $request)
    {
        session()->flush();
        return redirect('admin/business-login');
    }

    public function business_ui_account_info()
    {
        // Get the logged-in business user's ID from the session
        $businessLoginId = session('businessId');

        // Fetch business login details from the database
        $businessLogin = BusinessLogin::find($businessLoginId);

        // Check if the business login details were retrieved successfully
        if (!$businessLogin) {
            // If not found, redirect to login page with an error message
            return redirect('admin/business-login')->withErrors(['msg' => 'User not found.']);
        }

        // Pass the business login details to the view
        return view('admin.business.account_info', ['businessLogin' => $businessLogin]);
    }

}
