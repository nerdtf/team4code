<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTGuard;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $id = DB::select('select id from users ORDER BY id ASC limit 1');

        if($id[0]->id == 1) {
            if ($request->email == "admin" && $request->password == "admin") {
                return redirect('/admin/setting');
            }
        }
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return redirect('/login');
            }
        } catch (JWTException $e) {
            return redirect('/login');
        }

        if(! auth()->attempt(request(['email' , 'password']))){
            return back();
        }

        return redirect('/');
        //return response()->json(compact('token'));
    }

    public function destroy(){
        auth()->logout();
        return redirect('/');
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        //return response()->json(compact('user','token'),201);
        return redirect('/');
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function notAuthenticate(){
        return view('notAuth');
    }




    public function store(Request $request)
    {

        User::updateOrCreate(['id' => $request->user_id],
            ['name' => $request->name, 'email' => $request->email]);

        return response()->json(['success' => 'User saved successfully.']);

        /*$request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        User::create($request->all());*/
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);

    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success','Blog updated successfully');
    }

    public function destroyUser($id)
    {

        User::find($id)->delete();

        return response()->json(['success'=>'User deleted successfully.']);

    }



}
