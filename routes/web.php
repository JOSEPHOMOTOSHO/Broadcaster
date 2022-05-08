<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' =>'auth'], function () use ($router){
    $router->post('register', 'AuthController@register');
    // Matches "/api/login
   $router->post('login', 'AuthController@login');
});
// API route group
$router->group(['middleware' => 'auth','prefix' => 'api'], function () use ($router) {

   // Matches "/api/profile
   $router->get('profile', 'UserController@profile');

   // Matches "/api/users/1 
   //get one user by id
   $router->get('users/{id}', 'UserController@singleUser');

   // Matches "/api/users
   $router->get('users', 'UserController@allUsers');
   //Ref Institutions
   $router->get('institution', 'InstitutionController@getInstitution');
   $router->get('institution/{id}', 'InstitutionController@getInstitutionOne');
   $router->post('institution', 'InstitutionController@createInstitution');

   // Ref Faculty
   $router->get('faculty', 'FacultyController@getFaculty');
   $router->get('faculty/{id}', 'FacultyController@getFacultyOne');
   $router->post('faculty', 'FacultyController@createFaculty');

    // Ref Department
    $router->get('department', 'DepartmentController@getDepartment');
    $router->get('department/{id}', 'DepartmentController@getDepartmentOne');
    $router->post('department', 'DepartmentController@createDepartment');

     // Ref Levels
     $router->get('levels', 'LevelsController@getLevels');
     $router->get('levels/{id}', 'LevelsController@getLevelsOne');
     $router->post('levels', 'LevelsController@createLevels');

});