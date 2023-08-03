<?php

namespace App\Http\Controllers;

use App\Mail\PromoMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{

    function CustomerPage() {
        return view('pages.dashboard.customer-page');
    }
    

    function CustomerCreate (Request $request) {
        $user_id=$request->header('id');
        return Customer::create([
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'phone' =>$request->input('phone'),
            'address' =>$request->input('address'),
            'preference' =>$request->input('preference'),
            'user_id' => $user_id
        ]);
    }

    function CustomerDelete (Request $request) {
        $customer_id = $request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id', $customer_id)
        ->where('user_id', $user_id)
        ->delete();
    }

    function CustomerList (Request $request) {
        $user_id=$request->header('id');
        return Customer::where('user_id',$user_id)->get();
    }

    function CustomerUpdate (Request $request) {
        $customer_id = $request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id', $customer_id)
        ->where('user_id', $user_id)
        ->update([
            'name' => $request->input('name'),
            'email' =>$request->input('email'),
            'phone' =>$request->input('phone'),
            'address' =>$request->input('address'),
            'preference' =>$request->input('preference')
        ]);
    }

    function CustomerById (Request $request) {
        $customer_id = $request->input('id');
        $user_id=$request->header('id');
        return Customer::where('id', $customer_id)
        ->where('user_id', $user_id)
        ->first();

    }

    function SendPromoMail(Request $request) {
        $email = $request->input('email');
        $mySubject = $request->input('subject');
        $message = $request->input('message');
        if($message){
            Mail::to($email)->send(new PromoMail($mySubject, $message));
            return response()->json([
                'status' => 'success',
                'message' => 'Mail Send',
            ]);
        }else {
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorised',
            ]);
        }
    }
}
