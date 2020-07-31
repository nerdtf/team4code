<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

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
    return view('index');
})->middleware('isadmin');
Route::get('/contacts', function (){
    return view('contacts');
})->middleware('auth');
Route::get('/notAuth', 'UserController@notAuthenticate');
Route::get('/registration' , function () {
    return view('users.register');
});
Route::get('/login' , function () {
    return view('users.login');
});

Route::get('/users', function () {
    if(Auth::user()->is_admin == 1 ) {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }
    else return redirect('/');
});
Route::get('/users/{user_id?}',function($user_id){
    $user = User::find($user_id);
    return response()->json($user);
});
Route::post('/users',function(Request $request){

    $user = User::create([
        'name' => $request->post('name'),
        'email' => $request->post('email'),
        'password' => bcrypt($request->post('password')),
    ]);

    return response()->json($user);
});
Route::put('/users/{user_id?}',function(Request $request,$user_id){



    $user = App\User::find($user_id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password =Hash::make($request->password);
    $user->update();
    return response()->json($user);
});
Route::delete('/users/{user_id?}',function($user_id){
    $user = App\User::destroy($user_id);
    return response()->json($user);
});

Route::get('/admin/index' ,'AdminController@index') ;
Route::get('/admin/setting', function (){
    return view('admin.setting');
});
Route::post('/admin/setting' ,'AdminController@update');


Route::post('login', 'UserController@authenticate');
Route::post('register', 'UserController@register');
Route::get('/user/destroy', 'UserController@destroy');
