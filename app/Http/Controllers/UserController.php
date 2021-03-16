<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserInfoUpdateRequest;
use App\Http\Requests\UserPasswordUpdateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response ;

class UserController extends Controller
{
    public function index(){
      return  User::all();
    }

    public function show($id){

      return User::find($id);
    }

       public function store(UserCreateRequest $request ){

      $user = User::create(

        $request->only('first_name', 'last_name', 'email') +
        ['password' => Hash::make(12345678)

        ]);

      return response($user , Response::HTTP_CREATED);
    }


    public function update(UserUpdateRequest $request, $id){

      $user  = User::find($id);
      $user->update(

        $request->only('first_name', 'last_name', 'email')


      );

      return response ($user,Response::HTTP_ACCEPTED);
    }

    public function destroy($id){

        User::destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
      }



      public function user(){

        $user = Auth::user();
        // return ( $user);
        $user2 = User::find($user -> id);
        return response($user2, Response::HTTP_ACCEPTED);

      }


      public function updateInfo(UserInfoUpdateRequest   $request){

        $authenticated_user = Auth::user();

        $user = User::find($authenticated_user -> id);
        $user -> update ($request -> only('first_name', 'last_name', 'email'));

        return response($user, Response::HTTP_ACCEPTED);

      }


      public function updatePassword(UserPasswordUpdateRequest $request){

        $authenticated_user = Auth::user();

        $user = User::find($authenticated_user -> id);
        $user -> update (['password' => Hash::make($request->input('password'))]);

        return response($user, Response::HTTP_ACCEPTED);
      }

}








// <?php

// namespace App\Http\Controllers;

// use App\Http\Requests\UserCreateRequest;
// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Hash;
// use Symfony\Component\HttpFoundation\Response ;

// class UserController extends Controller
// {
//     public function index(){
//       return  User::all();
//     }

//     public function show($id){

//       return User::find($id);
//     }

//     public function store(UserCreateRequest $request ){

//       $user = User::create(

//         $request->only('first_name,last_name,email') +
//         ['password' => Hash::make(12345678)]);

//       return response($user , Response::HTTP_CREATED);
//     }


//     public function update(Request $request, $id){

//       $user  = User::find($id);
//       $user->update([
//         'first_name' => $request->input('first_name'),
//         'last_name' => $request->input('last_name'),
//         'email' => $request ->input('email'),
//         'password' => Hash::make($request ->input('password'))
//       ]);

//       return response ($user,Response::HTTP_ACCEPTED);
//     }

//     public function destroy($id){

//       User::destroy($id);
//       return response(null, Response::HTTP_NO_CONTENT);
//     }
// }

