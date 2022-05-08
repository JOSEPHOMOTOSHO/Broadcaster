<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function getFaculty()
    {
      
            $institute = DB::table('ref_faculty')->paginate(15);
            if($institute){
                return response()->json(["results" => $institute],200);
            }
            else {
                return response()->json($institute,401);
            } 
                 
    }
    
    public function getFacultyOne($id){
        $results = DB::select (
            'select * from ref_faculty
            where id =:id',
            ['id' => $id]
        );
        return response()->json($results);

    }


    public function createFaculty(Request $request){

        $this->validate($request, [
             'name' => 'required'
         ]);
         
         $name= $request->input('name');
         $description = $request->input('description');
         $institution_id = $request->input('institution_id');
         
 
         $results = DB::insert(
             'insert into ref_faculty 
             (
                 name,
                 description,
                 institution_id
             ) 
             values (?,?,?)', 
             [
                 $name,
                 $description,
                 $institution_id
             ] );
         if($results == 'true'){
             return response()->json($results,201);
         }
         else {
             return response()->json($results,401);
         }
         
     }
}
