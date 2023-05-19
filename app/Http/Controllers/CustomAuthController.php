<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\PaymentMethod;
use Stripe\Charge;
use Exception;


class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }



    
    // Stripe::setApiKey('sk_test_51MaKZQSAfjlRljntSLCrs6AyQ2IZjQZEthleJSPhE7sRxADDwzIf7LH1lkgEKicDCICo2eXhHpbwWa4FWhGjMI3h00hlVX06wW');
    
    // public function customRegistration(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6',
    //         'card_number' => 'required',
    //         'expiry_month' => 'required',
    //         'expiry_year' => 'required',
    //         'cvv' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }


    //     // Set your Stripe secret key
    //     Stripe::setApiKey('sk_test_51MaKZQSAfjlRljntSLCrs6AyQ2IZjQZEthleJSPhE7sRxADDwzIf7LH1lkgEKicDCICo2eXhHpbwWa4FWhGjMI3h00hlVX06wW');

    //     // Create a PaymentMethod from the card details
    //     $paymentMethod = PaymentMethod::create([
    //         'type' => 'card',
    //         'card' => [
    //             'number' => $request->card_number,
    //             'exp_month' => $request->expiry_month,
    //             'exp_year' => $request->expiry_year,
    //             'cvc' => $request->cvv,
    //         ],
    //     ]);

    //     // Create the customer and attach the payment method
    //     $customer = Customer::create([
    //         'email' => $request->email,
    //         'payment_method' => $paymentMethod->id,
    //     ]);

    //     // Charge the payment source
    //     $charge = Charge::create([
    //         'amount' => 1000, // Example: $10.00
    //         'currency' => 'usd',
    //         'customer' => $customer->id,
    //     ]);

    //     // Check if the payment was successful
    //     if ($charge->status === 'succeeded') {
    //         // Payment was successful, proceed with user creation
    //         $user = $this->create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => bcrypt($request->password),
    //             // Include any other user fields you have
    //         ]);

    //         if ($user) {
    //             // User creation was successful
    //             return redirect("dashboard")->withSuccess('You have signed in');
    //         } else {
    //             // Failed to create the user
    //             return redirect()->back()->withError('Failed to create user');
    //         }
    //     } else {
    //         // Payment was not successful
    //         return redirect()->back()->withError('Payment failed');
    //     }
    // }





    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
