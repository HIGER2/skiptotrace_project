<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class SkipListController extends Controller
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

       $csv_data = DB::table('skip_csv')->where('uid', $uid)->where('status', 'pending')->get();

       return view('skipList', ['total_skips' => $total_skips,'csv_data'=>$csv_data]);
     }

     public function import(Request $request)
     {
       $uid= $currentuserid = Auth::user()->id;
       $date= date('Y-m-d H:i:s');

       $csv_data = DB::table('skip_csv')->where('uid', $uid)->where('status', 'pending')->get();

       //$data = DB::table('users')->where('id', $uid)->first();
       //$total_skips=$data->skips;
       //$fileStream = fopen(storage_path('app/public/' . $file), 'r');

       $total_skips = $request->total_skips;
       $type = $request->type;

       if($total_skips<1){
         return view('skipList', ['total_skips' => $total_skips,'csv_data'=>$csv_data,'custom_error'=>'Your account balance is low, Recharge to use Skips.']);
       }
      else if($type=="upload"){
        if ($request->hasFile('csvfile')) {

          $file = $request->file('csvfile');
          $fileContents = file($file->getPathname());
          $total_csv_record= count($fileContents)-1;

           $csv = $request->file('csvfile');
           $csv_name = preg_replace('/\.\w+$/', '', $csv->getClientOriginalName());

           $name = $csv_name.'_'.time() .'.'.$csv->getClientOriginalExtension();
           $destinationPath = public_path('/uploads');
           $csvPath = $destinationPath. "/".  $name;
           $csv->move($destinationPath, $name);
           $skip_csv = $name;

           $data=array( 'uid'=>$uid, 'file_name'=>$skip_csv, 'total_records'=>$total_csv_record, 'status'=>'pending', 'date'=>$date);
           DB::table('skip_csv')->insert($data);

           if($total_skips < $total_csv_record){
             // CSV Record is more than Skips
            $custom_msg="CSV File Uploaded Successfully but you have ".$total_skips." Skip left and CSV record is more than skips.";
           }
           else{
             $custom_msg="CSV File Uploaded Successfully.";
           }

           return redirect()->back()->with('success', $custom_msg);
        }
      }
      else if($type=="delete"){
        $csv_id = $request->id;
        $csv_filename = $request->filename;
        if(file_exists(public_path('uploads/'.$csv_filename))){
          unlink(public_path('uploads/'.$csv_filename));
        }
        DB::table('skip_csv')->where('id', $csv_id)->delete();
        $status=1;
        $custom_msg="Record Deleted successfully";
        return \Response::json(['status' => $status,'msg' => $custom_msg]);
     }
     else if($type=="import"){
       $total_csv_record=$request->total_records;

       /* check skip and csv records */
       if($total_skips < $total_csv_record){
        // CSV Record is more than Skips
        //return redirect()->back()->with('error', "CSV Record is more than Skips");
        return view('skipList', ['total_skips' => $total_skips,'csv_data'=>$csv_data,'custom_error'=>"CSV Record is more than Skips"]);
      }
      /* run csv files for skip */
      else{
        // csv_id
        $csv_id=$request->id;
        $csv_filename=$request->filename;

        $file = public_path('uploads/'.$csv_filename);
        $fileContents = file($file);

        foreach ($fileContents as $key=>$line) {
          $curl_param="";
          $error_msg=array();
          $error_curl=array();

          if($key == 0){ continue; }
          $line_arr = str_getcsv($line);
          $data= explode(";",$line_arr[0]);

          $first_name = $data[0];
          $last_name = $data[1];
          $address = $data[2];
          $city = $data[3];
          $state = $data[4];
          $zipcode = $data[5];
          //dd($request->all());
          $variable=array();
        if ( $data[0] != '') {
            $variable['first']= $data[0];
         }
         if ( $data[1] != '') {
           $variable['last']=$data[1];
         }
        if ( $data[2] != '') {
           $variable['address']= $data[2];
         }
         if ( $data[3] != '') {
           $variable['city']= $data[3];
         }
         if ( $data[4] != '') {
           $variable['state']= $data[4];
         }
         if ( $data[5] != '') {
           $variable['zip']= $data[5];
         }

         $param_arr = array_filter($variable);


         DB::table('skip_csv')->where('id', $csv_id)->update(['status' => 'success']);
         foreach($param_arr as $key=>$value){
           $param_string = $key."=".$value."&";
           $curl_param .= $param_string;
         }

         $curl_param.="country=US&match_type=hhld&cfg_maxrecs=1&output[]=phone_multiple&output[]=email";
        // echo $curl_param;
        // print_r($param_arr);

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
                     $error_curl[]=$api_result->versium;
                     //$error_msg[]= $api_result->versium->errors[0];
                     //return view('skipList')->withErrors(["custom_error"=>$error_msg]);
                   }
                   else
                   {
                     if(empty($api_result->versium->results)) {
                       $alt_email='';
                       $email="";
                       $phone=$alt_phone_1=$alt_phone_2=$alt_phone_3=$alt_phone_4=$alt_phone_5="";
                       $line_type=$alt_line_type_1=$alt_line_type_2=$alt_line_type_3=$alt_line_type_4=$alt_line_type_5="";


                       $data1=array('uid'=>$uid,'type'=>'csv','csv_id'=>$csv_id,'fname'=>$first_name,"lname"=>$last_name,"address"=>$address,"email"=>$email,"email_multiple"=>$alt_email,"phone"=>$phone,"line_type"=>$line_type, "alt_phone_1"=>$alt_phone_1, "alt_line_type_1"=>$alt_line_type_1, "alt_phone_2"=>$alt_phone_2, "alt_line_type_2"=>$alt_line_type_2, "alt_phone_3"=>$alt_phone_3, "alt_line_type_3"=>$alt_line_type_3, "alt_phone_4"=>$alt_phone_4, "alt_line_type_4"=>$alt_line_type_4, "alt_phone_5"=>$alt_phone_5, "alt_line_type_5"=>$alt_line_type_5,"zipcode"=>$zipcode,"city"=>$city,"state"=>$state,"country"=>'US',"status"=>'Not found');
                       //echo "<pre>"; print_r($data1); echo "</pre>";
                       // record not found in API
                       DB::table('skip_records')->insertOrIgnore($data1);
                      $api_res[]=$data1;
                     }
                     else{
                       foreach($api_result->versium->results as $results){

                         $alt_email_arr=array();
                         $email="";
                         $phone=$alt_phone_1=$alt_phone_2=$alt_phone_3=$alt_phone_4=$alt_phone_5="";
                         $line_type=$alt_line_type_1=$alt_line_type_2=$alt_line_type_3=$alt_line_type_4=$alt_line_type_5="";


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

                         $data1=array('uid'=>$uid,'type'=>'csv','csv_id'=>$csv_id,'fname'=>$first_name,"lname"=>$last_name,"address"=>$address,"email"=>$email,"email_multiple"=>$alt_email,"phone"=>$phone,"line_type"=>$line_type, "alt_phone_1"=>$alt_phone_1, "alt_line_type_1"=>$alt_line_type_1, "alt_phone_2"=>$alt_phone_2, "alt_line_type_2"=>$alt_line_type_2, "alt_phone_3"=>$alt_phone_3, "alt_line_type_3"=>$alt_line_type_3, "alt_phone_4"=>$alt_phone_4, "alt_line_type_4"=>$alt_line_type_4, "alt_phone_5"=>$alt_phone_5, "alt_line_type_5"=>$alt_line_type_5,"zipcode"=>$zipcode,"city"=>$city,"state"=>$state,"country"=>'US',"status"=>'Found');
                        //echo "<pre>"; print_r($data1); echo "</pre>";
                         // record found in API
                         DB::table('skip_records')->insertOrIgnore($data1);
                         DB::table('users')->where('id', $uid)->update(array('skips' => DB::raw('skips -1')));
                         $total_skips=$total_skips-1;
                         $api_res[]=$data1;
                       }  // foreach

                     }  // else record found

                   }  // else error not occured

            } // foreach
            //echo "<pre>"; print_r($api_res); echo "</pre>"; die;
          //  echo "<pre>";print_r($error_curl);echo "</pre>";
          //  echo "<pre>";print_r($error_msg);echo "</pre>";
          //$csv_data = DB::table('skip_csv')->where('uid', $uid)->where('status', 'pending')->get();
          $skips = DB::table('skip_records')->where('uid', $uid)->where('csv_id', $csv_id)->get();

            return view('myList', ['skips' => $skips]);
          //return view('skipList', ['data' => $api_res,'csv_data'=>$csv_data,'error'=>$error_msg,'total_skips'=>$total_skips]);
        } // total skip is equal and greater than csv records

       }
    }


}
