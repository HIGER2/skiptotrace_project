<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class MyListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
     {
       $result=array();
       $uid= $currentuserid = Auth::user()->id;
       $csv_skips = DB::table('skip_csv')->where('uid', $uid)->where('status', 'success')->get();
       foreach($csv_skips as $row){
         $csv_id=$row->id;
         $total_records=$row->total_records;
         $skip_count = DB::table('skip_records')->where('csv_id', $csv_id)->count();
         $pending=$total_records-$skip_count;
         $success=$skip_count;
         $skip_found = DB::table('skip_records')->where('csv_id', $csv_id)->where('status', 'Found')->count();
         $skip_not_found= $success-$skip_found;

         $result[]=array('id'=>$csv_id,'file_name'=>$row->file_name,'total_records'=>$total_records,'pending'=>$pending,'success'=>$success,'found'=>$skip_found,'not_found'=>$skip_not_found,);
         //echo $pending."= ".$success;
         //die;

       }
       $db_data = json_decode(json_encode($result));

      return view('csvList', ['skips' => $db_data]);
     }

     /**
      * Display a listing of the resource.
      */
      public function mylist_csv($id)
      {
        $uid= $currentuserid = Auth::user()->id;
        $skips = DB::table('skip_records')->where('uid', $uid)->where('csv_id', $id)->get();

          return view('myList', ['skips' => $skips]);
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
     */
    public function store(Request $request)
    {
        //
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
