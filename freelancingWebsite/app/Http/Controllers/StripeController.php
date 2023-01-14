<?php
namespace App\Http\Controllers;

use App\Models\Financial_transaction;
use App\Models\Freelancer;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as Session;
use Stripe;
class StripeController extends Controller
{
    /**
     * payment view
     */
    public function handleGet()
    {
        return view('client.checkout');
    }

    /**
     * handling payment with POST
     */
    public function handlePost(Request $request)
    {

        DB::beginTransaction();
        try{

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => intval($request->amount * 100),
            "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Making test payment."
        ]);

        $id=Auth::id();
        $user = User::where('id',$id)->first();

        $user->wallet = $user->wallet + $request->amount;

        $user->save();


        Financial_transaction::create([
            'user_id'=>$id,
            "amount" => $request->amount,

        ]);


        DB::commit();
    }catch(Exception $e) {
        DB::rollBack();
        throw new Exception($e->getMessage());
    }
        Session::flash('message', 'Payment has been successfully processed.');

        return back();
    }



    public function payout(Request $request)
    {

        DB::beginTransaction();
        try{
            $id=Auth::guard('freelancer')->id();
            $freelancer = Freelancer::where('id',$id)->first();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Payout::create ([
            "amount" => intval($freelancer->wallet * 100),
            "currency" => "usd",
        ]);


        $freelancer->wallet = $freelancer->wallet - $request->amount;

        $freelancer->save();


        Financial_transaction::create([
            'user_id'=>$id,
            "amount" =>-$request->amount,

        ]);


        DB::commit();
    }catch(Exception $e) {
        DB::rollBack();
        throw new Exception($e->getMessage());
    }
        Session::flash('message', 'Payment has been successfully processed.');

        return back();
    }

}
