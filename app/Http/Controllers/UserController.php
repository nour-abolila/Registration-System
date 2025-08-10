<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
  // عرض صفحة تسجيل الدخول
  public function showsignin()
  {
    return view('signin');
  }


  public function signin(Request $request)
  {
    $request->validate([
      'username' => 'required|string|max:255',
      'password' => 'required|string|min:6',

    ]);

    $user = User::where('username', $request->username)->first();

    if ($user && Hash::check($request->password, $user->password)) {

      Auth::login($user);

      // 👇 بناءً على role نوجهه على الصفحة المناسبة
      if ($user->role === 'admin') {

        return redirect()->route('admin.dash');
      } else {

        return redirect()->route('user.dash');
      }
    } else {

      return redirect('/')->with('error', 'No Data');
    }
  }


  public function signup()
  {
    return view('signup');
  }


  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|min:6|confirmed',
      'phone' => 'required|phone:EG|unique:users,phone',
      'city' => 'required|string|max:255',
      'date_of_birth' => 'required|date',
    ]);


    $user = new user();
    $user->username = $request->username;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->phone = $request->phone;
    $user->city = $request->city;
    $user->date_of_birth = $request->date_of_birth;
    $user->role = 'user';
    $user->save();

    return redirect()->route('showsignin');
  }


  public function userdash()
  {
    $user = Auth::user(); // ← خد اليوزر الحالي
    return view('user_dash', ['data' => $user]); // ← ابعته للواجهة
  }


  public function useredit($id)
  {
    $user = user::find($id);
    return view('user_edit', ['user' => $user]);
  }


  public function userupdate(Request $request, $id)
  {
    $user = user::find($id);
    $user->username = $request->username;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->city = $request->city;
    $user->date_of_birth = $request->date_of_birth;
    $user->save();
    return redirect('user_dash');
  }


  public function admindash()

  {
    $user = User::where('id', '!=', 1)->paginate(1);
    return view('admin.admin_dash', ['data' => $user]);
  }


  public function adminlogout()

  {

    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('showsignin');
  }


  public function userlogout()

  {

    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('showsignin')->with('logout', true);;
  }

  public function adminedit($id)
  {
    $user = user::find($id);
    return view('admin.admin_edit', ['admin' => $user]);
  }

  public function adminupdate(Request $request, $id)
  {
    $user = user::find($id);
    $user->username = $request->username;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->city = $request->city;
    $user->date_of_birth = $request->date_of_birth;
    $user->save();
    return redirect()->route('admin.dash');
  }
}
