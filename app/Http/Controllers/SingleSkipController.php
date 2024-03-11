<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class SingleSkipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
     {
       $total_skips=0;
       $uid= $currentuserid = Auth::user()->id;
       $data = DB::table('users')->where('id', $uid)->first();
       $total_skips=$data->skips;

       return view('singleSkip', ['total_skips' => $total_skips]);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $uid= $currentuserid = Auth::user()->id;
      //$data = DB::table('users')->where('id', $uid)->first();
      //  $total_skips=$data->skips;
      $total_skips = $request->total_skips;
      if($total_skips>=1){
        $alt_phone='';
        $alt_email='';
        $phone_types='';
        $line_type='';
        $email= "";
        $phone=$alt_phone_1=$alt_phone_2=$alt_phone_3=$alt_phone_4=$alt_phone_5="";
        $line_type=$line_type_1=$line_type_2=$line_type_3=$line_type_4=$line_type_5="";


         $first_name = $request->first_name;
         $last_name = $request->last_name;
         $address = $request->address;
         $city = $request->city;
         $state = $request->state;
         $zipcode = $request->zipcode;


          //dd($request->all());
          $variable=array();
        if ( $request->has( 'first_name' ) ) {
            $variable['first']= $request->first_name;
         }
         if ( $request->has( 'last_name' ) ) {
           $variable['last']= $request->last_name;
         }
         if ( $request->has( 'address' ) ) {
           $variable['address']= $request->address;
         }
         if ( $request->has( 'email' ) ) {
           $variable['email']= $request->email;
         }
         if ( $request->has( 'phone' ) ) {
           $variable['phone']= $request->phone;
         }
         if ( $request->has( 'zipcode' ) ) {
           $variable['zip']= $request->zipcode;
         }
         if ( $request->has( 'city' ) ) {
           $variable['city']= $request->city;
         }
         if ( $request->has( 'state' ) ) {
           $variable['state']= $request->state;
         }
         $param_arr = array_filter($variable);
         $curl_param="";
         foreach($param_arr as $key=>$value){
           $param_string = $key."=".$value."&";
           $curl_param .= $param_string;
         }
         $curl_param.="country=US&match_type=hhld&cfg_maxrecs=1&output[]=phone_multiple&output[]=email";
         //echo $curl_param;
        //print_r($param_arr);
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://api.versium.com/v2/contact?');
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $curl_param);
          $headers = array();
          $headers[] = 'X-Versium-Api-Key: '.env('versium_key');
          $headers[] = 'Content-Type: application/x-www-form-urlencoded';
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
          $result = curl_exec($ch);
          if (curl_errno($ch)) {
              echo 'Error:' . curl_error($ch);
          }
          curl_close($ch);
          $api_result = json_decode($result);

            if (isset($api_result->versium->errors))
            {
              // add your error messages:
              $error_msg= $api_result->versium->errors[0];
              return view('singleSkip', ['total_skips' => $total_skips,'custom_error'=>$error_msg]);
            }
            else
            {
              if(empty($api_result->versium->results)) {
                $data=array('uid'=>$uid,'type'=>'single','fname'=>$first_name,"lname"=>$last_name,"address"=>$address,"email"=>$email,"email_multiple"=>$alt_email,"phone"=>$phone,"line_type"=>$line_type, "alt_phone_1"=>$alt_phone_1, "alt_line_type_1"=>$alt_line_type_1, "alt_phone_2"=>$alt_phone_2, "alt_line_type_2"=>$alt_line_type_2, "alt_phone_3"=>$alt_phone_3, "alt_line_type_3"=>$alt_line_type_3, "alt_phone_4"=>$alt_phone_4, "alt_line_type_4"=>$alt_line_type_4, "alt_phone_5"=>$alt_phone_5, "alt_line_type_5"=>$alt_line_type_5,"zipcode"=>$zipcode,"city"=>$city,"state"=>$state,"country"=>'US',"status"=>'Not found');
                  //print_r($data);
                // record not found in API
                DB::table('skip_records')->insertOrIgnore($data);
                return view('singleSkip', ['data' => $data,'status'=>"Successfully saved data",'total_skips'=>$total_skips]);

              }
              else{
                $phone_types_arr=array();
                $alt_phone_arr=array();
                $alt_email_arr=array();
                $email= "";
                $phone=$alt_phone_1=$alt_phone_2=$alt_phone_3=$alt_phone_4=$alt_phone_5="";
                $line_type=$alt_line_type_1=$alt_line_type_2=$alt_line_type_3=$alt_line_type_4=$alt_line_type_5="";

                foreach($api_result->versium->results as $results){


                  if (isset($results->Phone)){
                    $phone= $results->Phone;
                  }
                  if (isset($results->{'Alt Phone 1'})){
                    $alt_phone_1= $results->{'Alt Phone 1'};
                  }
                  if (isset($results->{'Alt Phone 2'})){
                    $alt_phone_2= $results->{'Alt Phone 2'};
                  }
                  if (isset($results->{'Alt Phone 3'})){
                    $alt_phone_3= $results->{'Alt Phone 3'};
                  }
                  if (isset($results->{'Alt Phone 4'})){
                    $alt_phone_4= $results->{'Alt Phone 4'};
                  }
                  if (isset($results->{'Alt Phone 5'})){
                    $alt_phone_5= $results->{'Alt Phone 5'};
                  }
                  if (isset($results->Email)){
                    $email= $results->Email;
                  }
                  if (isset($results->{'Alt Email 1'})){
                    $alt_email_arr[]= $results->{'Alt Email 1'};
                  }
                  if (isset($results->{'Alt Email 2'})){
                    $alt_email_arr[]= $results->{'Alt Email 2'};
                  }
                  if (isset($results->{'Alt Email 3'})){
                    $alt_email_arr[]= $results->{'Alt Email 3'};
                  }
                  if (isset($results->{'Alt Email 4'})){
                    $alt_email_arr[]= $results->{'Alt Email 4'};
                  }
                  if (isset($results->{'Alt Email 5'})){
                    $alt_email_arr[]= $results->{'Alt Email 5'};
                  }
                  if (isset($results->{'Line Type'})){
                    $line_type= $results->{'Line Type'};
                  }
                  if (isset($results->{'Alt Line Type 1'})){
                    $alt_line_type_1= $results->{'Alt Line Type 1'};
                  }
                  if (isset($results->{'Alt Line Type 2'})){
                    $alt_line_type_2= $results->{'Alt Line Type 2'};
                  }
                  if (isset($results->{'Alt Line Type 3'})){
                    $alt_line_type_3= $results->{'Alt Line Type 3'};
                  }
                  if (isset($results->{'Alt Line Type 4'})){
                    $alt_line_type_4= $results->{'Alt Line Type 4'};
                  }
                  if (isset($results->{'Alt Line Type 5'})){
                    $alt_line_type_5= $results->{'Alt Line Type 5'};
                  }
                  //$alt_phone=implode(",", $alt_phone_arr);
                  //$phone_types=implode(",", $phone_types_arr);
                  $alt_email=implode(",", $alt_email_arr);

                  $data=array('uid'=>$uid,'type'=>'single','fname'=>$first_name,"lname"=>$last_name,"address"=>$address,"email"=>$email,"email_multiple"=>$alt_email,"phone"=>$phone,"line_type"=>$line_type, "alt_phone_1"=>$alt_phone_1, "alt_line_type_1"=>$alt_line_type_1, "alt_phone_2"=>$alt_phone_2, "alt_line_type_2"=>$alt_line_type_2, "alt_phone_3"=>$alt_phone_3, "alt_line_type_3"=>$alt_line_type_3, "alt_phone_4"=>$alt_phone_4, "alt_line_type_4"=>$alt_line_type_4, "alt_phone_5"=>$alt_phone_5, "alt_line_type_5"=>$alt_line_type_5,"zipcode"=>$zipcode,"city"=>$city,"state"=>$state,"country"=>'US',"status"=>'Found');

                  //print_r($data);
                  // record found in API
                  DB::table('skip_records')->insertOrIgnore($data);
                  DB::table('users')->where('id', $uid)->update(array('skips' => DB::raw('skips -1')));
                  $total_skips=$total_skips-1;
                  return view('singleSkip', ['data' => $data,'status'=>"Successfully saved data",'total_skips'=>$total_skips]);

                }

              }
            //  echo'<pre>';      print_r($api_result); echo'</pre>';
            //  die;
            }
      }
      else{

        return view('singleSkip', ['total_skips'=>$total_skips]);
      }

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
