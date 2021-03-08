<?php

use Illuminate\Support\Facades\Route;
use App\Models\Student;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return "Just do it";
});
Route::get('hello', function () {
    return redirect('/');
});
Route::get('/post/{id}/{name}', function ($id,$name) {
    return "Your ID is: ". $id . " " . $name;
});
Route::get('/user/{name?}', function ($name=null) {
    return $name;
})->where('name','[a-zA-Z]+');
Route::get('/user/{name}/{id}', function ($name,$id) {
    return "Your name: " . $name . " " . $id;
})->where('name' ,'[a-zA-Z]+');
Route::get('/post/{id}','PostController@index');

Route::resource('/posts2','PostController');


Route::get('/contact', function () {
    return view('Contact')->with("name","sdfghj");
});

Route::get('/insert',function(){
    DB::insert('insert into students (name, date_of_birth, gpa, adviser) values ("Aizhan", "2001-10-15", 2.0, "Ainur")');
});

Route::get('/select',function(){
    $list = DB::select('select * from students');
    foreach($list as $student){
        echo "name is: ".$student->name.", GPA: ".$student->gpa."<br>";
    }
});
Route::get('/update',function(){
    $updated = DB::update('Update students set gpa="3.5" where id=2');
    return $updated;
});
Route::get('/delete',function(){
    $deleted = DB::delete('delete from students where id=4');
    return $deleted;
});

Route::get('/basicInsert',function(){
    $student = new Student;
    $student->name = "Nazerke";
    $student->date_of_birth = "2001-01-19";
    $student->gpa = "2.5";
    $student->adviser = "Ualikhan";
    $student->save();
    
});
Route::get('/read',function(){
    $list = Student::all();
    foreach($list as $student){
        echo "name is: ".$student->name.", GPA: ".$student->gpa."<br>";
    }
});
Route::get('/basicUpdate',function(){
    $student = Student::find(3);
    $student-> adviser = 'Zhangir';
    $student->save();
    
});
Route::get('/basicDelete',function(){
    $student = Student::find(2);
    $student->delete();
    
});