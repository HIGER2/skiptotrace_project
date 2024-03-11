<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use Auth;
use DB;

class StripePaymentController extends Controller
{
  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function addCard()
  {
      return view('addCard');
  }

  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function addCardPost(Request $request)
  {
    $uid= $currentuserid = Auth::user()->id;
    $charge = null;
    $customer_id='';

    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    /* check customer is exist or not in stripe */
    $search_customer=$stripe->customers->search([
       'query' => 'email:\''. Auth::user()->email .'\''
      /* 'query' =>'email:\'test10@gmail.com\'' */
    ]);

    //echo "<pre>";print_r($search_customer->data);echo "</pre>";

    /* if not exist create customer in stripe and if exist get customer id */
    if(empty($search_customer->data)) {
      try{
        $customer =$stripe->customers->create([
          'name' => Auth::user()->name,
          'email' => Auth::user()->email,
        ]);
        $customer_id=$customer->id;
      }
      catch (Exception $e) {
          Session::flash('danger', $e->getMessage());
       }
    }
    else{
      $customer_id=$search_customer->data[0]->id;
    }

  if($customer_id != ''){
    try {
       $card=$stripe->customers->createSource(
         $customer_id,
         ['source' => $request->stripeToken]
       );
       //echo "<pre>";print_r($card); echo "</pre>";
       $date = date('Y-m-d H:i:s');


       $data=array("uid"=>$uid,"card_id"=>$card->id,"cus_id"=>$card->customer,"name"=>$card->name,"card_number"=>$card->last4,"brand"=>$card->brand, "exp_month"=>$card->exp_month,"exp_year"=>$card->exp_year,"type"=>$card->funding,"default_method"=>1,"timestamps"=>$date);
       /*print_r($data);*/
       DB::table('payment_methods')->insert($data);
       Session::flash('success', 'card added into stripe successful!');

     } catch (Exception $e) {
         Session::flash('danger', $e->getMessage());
      }

      return view('addCard');
  }


  }

  public function buy_skips()
  {
    $uid= $currentuserid = Auth::user()->id;
    $payment = DB::table('payment_methods')->where('uid', $uid)->get();

    return view('buy_skips', ['payment' => $payment]);
  }

  public function buy_skips_Post(Request $request){
    $card_id=$request->choose_card;
    $amount=$request->amount;
    $uid= $currentuserid = Auth::user()->id;

    $get_customer = DB::table('payment_methods')->where('uid', $uid)->first();
    $customer_id=$get_customer->cus_id;
    //echo "card_id = ".$card_id." Amount=".$amount.' customer_id='.$customer_id;

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    try {
        $charge =Stripe\Charge::create ([
                "amount" => $amount * 100,
                "currency" => "usd",
                "source" => $card_id,
                "customer" => $customer_id,
                "description" => "Recharge to buy more skips"
        ]);
        $last4= $charge->payment_method_details->card->last4;
        $date = date('Y-m-d H:i:s');

        $data=array('uid'=>$uid,'transaction_id'=>$charge->id,"balance_transaction"=>$charge->balance_transaction,"payment_method"=>$charge->payment_method,"last4"=>$last4, "amount"=>$amount,"payment_status"=>$charge->status,"created_at"=>$date);
        DB::table('payment')->insert($data);

        // add skips to users table after successfuuly payment
        $uid_skips_data = DB::table('skip_records')->where('uid', $uid)->get();
        $uid_skips_count = $uid_skips_data->count();
        //$uid_skips_count =22000;
        $amount_data = DB::table('get_amount')->get();
        $count = 0;
        $total_skips=0;
        $amount_cent=$amount * 100;
        foreach($amount_data as $a_data){
          $count = $count+1;
          $limit_from=$a_data->limit_from;
          $limit_to=$a_data->limit_to;
          $price_cent=preg_replace("/[^0-9.]/", "", $a_data->price) * 100;
          if ($uid_skips_count>=$limit_from && $uid_skips_count<$limit_to) {
             $total_skips= $amount_cent/$price_cent;
          }
        }
        $total_skips=round($total_skips);
        DB::table('users')->where('id', $uid)->update(array('skips' => DB::raw('skips +'.$total_skips)));

        //print_r($data);
        //echo "<pre>";print_r($charge); echo "</pre>"; die;
        Session::flash('success', 'Recharge done Successfully. You can check dashboard to know about skips.');
     } catch (Exception $e) {
         Session::flash('danger', $e->getMessage());
      }
      return back();
 }

  public function billing_history()
  {
    $uid= $currentuserid = Auth::user()->id;
    $payment = DB::table('payment')->where('uid', $uid)->get();

      return view('billing_history', ['payment' => $payment]);
  }

  public function manage_cards()
  {
    $uid= $currentuserid = Auth::user()->id;
    //$card = DB::table('payment_methods')->where('uid', $uid)->get();

    $get_customer = DB::table('payment_methods')->where('uid', $uid)->first();
    if($get_customer != ""){
      $customer_id=$get_customer->cus_id;

      $ch = curl_init();
      $url='https://api.stripe.com/v1/customers/'.$customer_id.'/cards';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_USERPWD, env('STRIPE_SECRET'));

      $lists = curl_exec($ch);
      $card = json_decode($lists);
      curl_close($ch);
      //echo "<pre>";print_r($card); echo "</pre>";
      //die;
      return view('manage_cards', ['cards' => $card->data]);
    }
    else{
      $error_msg="No Card Added";
      return view('manage_cards')->withErrors(["custom_error"=>$error_msg]);
    }
  }

  public function editCard(Request $request)
  {
    $card_id= $request->card_id;
    $expiry_month= $request->expiry_month;
    $expiry_year= $request->expiry_year;
    $uid= $currentuserid = Auth::user()->id;

    $get_customer = DB::table('payment_methods')->where('uid', $uid)->first();
    $customer_id=$get_customer->cus_id;

    try{
      $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
      $res=$stripe->customers->updateSource(
        $customer_id,
        $card_id,
        ['exp_month' => $expiry_month,'exp_year'=>$expiry_year]
      );
      //echo "<pre>";print_r($res); echo "</pre>";
      DB::table('payment_methods')->where('card_id', $card_id)->update(['exp_month' => $expiry_month,'exp_year'=>$expiry_year]);
      $status=1;
      $message="Card updated successfully";
    }
    catch (Exception $e) {
       $status=0;
       $message= $e->getMessage();
     }

   return \Response::json(['status' => $status,'msg' => $message, 'info' => 'Expires '.$expiry_month.'/'.$expiry_year ]);
  }


  public function deleteCard(Request $request)
  {
    $card_id= $request->card_id;
    $uid= $currentuserid = Auth::user()->id;

    $get_customer = DB::table('payment_methods')->where('uid', $uid)->first();
    $customer_id=$get_customer->cus_id;
    try{
      $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

      $res=$stripe->customers->deleteSource(
        $customer_id,
        $card_id
      );
      //echo "<pre>";print_r($res); echo "</pre>";
      DB::table('payment_methods')->where('card_id', $card_id)->delete();
      $status=1;
      $message="Card Deleted successfully";
    }
    catch (Exception $e) {
       $status=0;
       $message= $e->getMessage();
     }

     return \Response::json(['status' => $status,'msg' => $message]);
  }

}
