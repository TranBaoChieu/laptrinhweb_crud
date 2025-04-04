<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{

    /**
     * Login page
     */
    public function login()
    {
        return view('crud_user.login');
    }

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('list')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('crud_user.create');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'age' => 'required',
            'like' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate ảnh
        ]);

        $data = $request->all();

        // Xử lý upload ảnh
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $fileName); // Lưu ảnh vào thư mục public/img
            $data['avatar'] = 'img/' . $fileName; // Lưu đường dẫn vào DB
        }

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'age' => $data['age'],
            'like' => $data['like'],
            'avatar' => $data['avatar'] ?? null, // Lưu đường dẫn avatar
        ]);

        return redirect("login")->withSuccess('User created successfully');
    }

    /**
     * View user detail page
     */
    public function readUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.read', ['messi' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request)
    {
        $user_id = $request->get('id');
        User::destroy($user_id);

        return redirect("list")->withSuccess('User deleted successfully');
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $input['id'], // Sửa unique để kiểm tra email trừ chính user đang cập nhật
            'password' => 'required|min:6',
            'age' => 'required',
            'like' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate ảnh
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $fileName); // Lưu ảnh vào thư mục public/img
            $input['avatar'] = 'img/' . $fileName; // Lưu đường dẫn vào DB
        }

        $user = User::find($input['id']);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']); // Mã hóa password
        $user->age = $input['age'];
        $user->like = $input['like'];
        $user->avatar = $input['avatar'] ?? $user->avatar; // Giữ avatar cũ nếu không upload mới
        $user->save();

        return redirect("list")->withSuccess('User updated successfully');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        if (Auth::check()) {
            $users = User::all();
            return view('crud_user.list', ['users' => $users]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    /**
     * Sign out
     */
    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}