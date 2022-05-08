<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InstitutionController extends Controller
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

    public function getInstitution()
    {
      
            $institute = DB::table('ref_institution')->paginate(15);
            if($institute){
                return response()->json(["results" => $institute],200);
            }
            else {
                return response()->json($institute,401);
            } 
                 
    }
    
    public function getInstitutionOne($id){
        $results = DB::select (
            'select * from ref_institution
            where id =:id',
            ['id' => $id]
        );
        return response()->json($results);

    }


    public function createInstitution(Request $request){

        $this->validate($request, [
             'name' => 'required',
             'founded'=>'required'
         ]);
         
         $name= $request->input('name');
         $founded = $request->input('founded');
         $location = $request->input('location');
         $about = $request->input('about');
 
         $results = DB::insert(
             'insert into ref_institution 
             (
                 name,
                 founded,
                 location,
                 about
             ) 
             values (?,?,?,?)', 
             [
                 $name,
                 $founded,
                 $location,
                 $about
             ] );
         if($results == 'true'){
             return response()->json($results,201);
         }
         else {
             return response()->json($results,401);
         }
         
     }
}
