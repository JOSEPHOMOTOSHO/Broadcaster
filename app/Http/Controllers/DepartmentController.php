<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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

    public function getDepartment()
    {
      
            $depts = DB::table('ref_departments')->paginate(15);
            if($depts){
                return response()->json(["results" => $depts],200);
            }
            else {
                return response()->json($depts,401);
            } 
                 
    }
    
    public function getDepartmentOne($id){
        $results = DB::select (
            'select * from ref_departments
            where id =:id',
            ['id' => $id]
        );
        return response()->json($results);

    }


    public function createDepartment(Request $request){

        $this->validate($request, [
             'name' => 'required'
         ]);
         
         $name= $request->input('name');
         $description = $request->input('description');
         $faculty_id = $request->input('faculty_id');
         
 
         $results = DB::insert(
             'insert into ref_departments 
             (
                 name,
                 description,
                 faculty_id

             ) 
             values (?,?,?)', 
             [
                 $name,
                 $description,
                 $faculty_id
             ] );
         if($results == 'true'){
             return response()->json($results,201);
         }
         else {
             return response()->json($results,401);
         }
         
     }
}
