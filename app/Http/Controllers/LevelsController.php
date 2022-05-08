<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LevelsController extends Controller
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

    public function getLevels()
    {
      
            $institute = DB::table('ref_levels')->paginate(15);
            if($institute){
                return response()->json(["results" => $institute],200);
            }
            else {
                return response()->json($institute,401);
            } 
                 
    }
    
    public function getLevelsOne($id){
        $results = DB::select (
            'select * from ref_levels
            where id =:id',
            ['id' => $id]
        );
        return response()->json($results);

    }


    public function createLevels(Request $request){

        $this->validate($request, [
             'level' => 'required'
         ]);
         
         $level= $request->input('level');
         $description = $request->input('description');
         $department_id = $request->input('department_id');
         
 
         $results = DB::insert(
             'insert into ref_levels
             (
                 level,
                 description,
                 department_id
             ) 
             values (?,?,?)', 
             [
                 $level,
                 $description,
                 $department_id
             ] );
         if($results == 'true'){
             return response()->json($results,201);
         }
         else {
             return response()->json($results,401);
         }
         
     }
}
