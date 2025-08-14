<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
  // عرض صفحة تسجيل الدخول
  public function showsignin()
  {
    return view('signin');
  }

  // تسجيل الدخول والتاكد من صحة البيانات
  public function signin(Request $request)
  {
    $request->validate([
      'username' => 'required|string|max:255',
      'password' => 'required|string|min:6',
    ]);
    // التاكد من مطابقة الباسوورد والاسم
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

  // عرض صفحة تسجيل المستخدم الجديد
  public function signup()
  {
    return view('signup');
  }

  // تخزين المستخدم الجديد 
  public function store(Request $request)
  {
    $validated = $request->validate([
      'username' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => ['required', 'min:6', 'confirmed'],
      'phone' => ['required', 'phone:EG', 'unique:users,phone'],
      'city' => ['required', 'string', 'max:255'],
      'date_of_birth' => ['required', 'date'],
      'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
    ]);


    $photoPath = $request->file('photo')->store('photos', 'public');


    // متنساش تسجل الاعمدة دى فى ال filliable 
    User::create([
      'username' => $validated['username'],
      'email' => $validated['email'],
      'password' => Hash::make($validated['password']),
      'phone' => $validated['phone'],
      'city' => $validated['city'],
      'date_of_birth' => $validated['date_of_birth'],
      'photo' => $photoPath,
      'role' => 'user',
    ]);

    return redirect()->route('showsignin')->with('success', 'Sign up successful!');
  }

  // عرض صفحة الداش بورد بتاعة اليوزر
  public function userdash()
  {
    $user = Auth::user(); // ← خد اليوزر الحالي
    return view('user_dash', compact('user')); // ← ابعته للواجهة
  }


  public function useredit($id)
  {
    $users = user::findOrFail($id);
    return view('user_edit', compact('users'));
  }


  public function userupdate(Request $request, $id)
  {
    // جلب المستخدم او عرض 404 ايرور 
    $user = user::findOrFail($id);
    $validated = $request->validate([
      'username'      => ['required', 'string', 'max:255'],
      'email'         => ['required', 'email', 'unique:users,email,' . $user->id],
      'phone'         => ['required', 'unique:users,phone,' . $user->id],
      'city'          => ['required', 'string', 'max:255'],
      'date_of_birth' => ['required', 'date'],
      'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
    ]);

    if ($request->hasFile('photo')) {
      // حذف الصورة القديمة
      if ($user->photo && Storage::disk('public')->exists($user->photo)) {
        Storage::disk('public')->delete($user->photo);
      }

      // رفع الصورة الجديدة
      $validated['photo'] = $request->file('photo')->store('photos', 'public');
    }

    // تحديث البيانات 
    $user->update($validated);
    return redirect()->route('user.dash');
  }


  // بيسجل خروج اليوزر
  public function userlogout()
  {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('showsignin')->with('logout', true);;
  }


  public function admindash()
  {  // هنا بقولة يجبلى كل اليوزرس ما عدا اللى الرول بتاعة ادمن
    $users = User::where('role', '!=', 'admin')->paginate(3);
    return view('admin.admin_dash', compact('users'));
  }

  // بيسجل خروج الادمن
  public function adminlogout()
  {
    Auth::logout(); // بتسجل خروج المستخدم من السيشن بالكامل
    request()->session()->invalidate(); //  بمسح اى بيانات موجدة للمستخدم دلوقتى من السيشن 
    request()->session()->regenerateToken(); // تمنع هجمات csrf
    return redirect()->route('showsignin');
  }


  public function adminedit($id)
  {
    $user = user::findOrFail($id);
    return view('admin.admin_edit', compact('user'));
  }


  public function adminupdate(Request $request, $id)
  {
    $user = user::findOrFail($id);
    $validated = $request->validate([
      'username'      => ['required', 'string', 'max:255'],
      'email'         => ['required', 'email', 'unique:users,email,' . $user->id],
      'phone'         => ['required', 'unique:users,phone,' . $user->id],
      'city'          => ['required', 'string', 'max:255'],
      'date_of_birth' => ['required', 'date'],
      'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']

    ]);


    if ($request->hasFile('photo')) {
      // حذف الصورة القديمة
      if ($user->photo && Storage::disk('public')->exists($user->photo)) {
        Storage::disk('public')->delete($user->photo);
      }

      // رفع الصورة الجديدة
      $validated['photo'] = $request->file('photo')->store('photos', 'public');
    }


    $user->update($validated);
    return redirect()->route('admin.dash');
  }



  public function admincreate()
  {
    return view('admin.admin_create');
  }


  public function adminstore(Request $request)
  {
    $validated = $request->validate([
      'username' => ['required', 'string', 'max:255'],
      'email' => ['required', 'email', 'unique:users,email'],
      'password' => ['required', 'min:6', 'confirmed'],
      'phone' => ['required', 'phone:EG', 'unique:users,phone'],
      'city' => ['required', 'string', 'max:255'],
      'date_of_birth' => ['required', 'date'],
      'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
    ]);


    $photoPath = $request->file('photo')->store('photos', 'public');


    User::create([
      'username' => $validated['username'],
      'email' => $validated['email'],
      'password' => Hash::make($validated['password']),
      'phone' => $validated['phone'],
      'city' => $validated['city'],
      'date_of_birth' => $validated['date_of_birth'],
      'photo' => $photoPath,
    ]);

    return redirect()->route('admin.dash');
  }


  public function admindestroy($id)
  {
    $user = user::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.dash')->with('success', 'تم حذف البوست بنجاح');
  }
}
