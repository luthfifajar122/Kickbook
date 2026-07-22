<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\UserModel;

class AuthController extends Controller
{
    // LOGIN
    public function login(){
        return view('auth.login');
    }

    public function cekLogin(Request $request) {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ],[
            'login.required' => 'Username/Email harus diisi',
            'password.required' => 'Password harus diisi',
        ]);

        $user = UserModel::where('username', $request->login)
            ->orWhere('email', $request->login)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->with('error', 'Username/Email atau password salah.')
                ->withInput();
        }

        Session::put([
            'login'    => true,
            'id_user'  => $user->id_user,
            'name'     => $user->name,
            'username' => $user->username,
            'email'    => $user->email,
            'role'     => $user->role,
            'alamat'   => $user->alamat,
            'no_hp'    => $user->no_hp,
        ]);

        if ($request->has('remember')) {
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->save();

            Cookie::queue(
                'remember_token',
                $token,
                60 * 24 * 30
            );
        } else {
            Cookie::queue(Cookie::forget('remember_token'));
        }

        if ($user->role === 'admin') {
            return redirect('/admin');
        }

        return redirect('/');
    }

    // REGISTER
    public function register() {
        return view('auth.register');
    }

    public function saveRegister(Request $request){
        $request->validate([
            'username' => 'required|min:3',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'persetujuan' => 'accepted',
        ],[
            'email.unique' => 'Email sudah digunakan',
            'email.required' => 'Email harus diisi',
            'persetujuan.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
            'username.required' => 'Username harus diisi',
            'username.min' => 'Username minimal 3 karakter',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        $user = UserModel::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'customer',
        ]);

        Session::put([
            'login'    => true,
            'id_user'  => $user->id_user,
            'username' => $user->username,
            'email'    => $user->email,
            'role'     => $user->role,
        ]);

        $token = Str::random(60);
        $user->remember_token = $token;
        $user->save();

        Cookie::queue(
            'remember_token',
            $token,
            60 * 24 * 30
        );

        return redirect('/')
            ->with('success', 'Registrasi berhasil');
    }

    // LOGOUT
    public function logout()
    {
        $user = UserModel::find(Session::get('id_user'));

        if ($user) {
            $user->remember_token = null;
            $user->save();
        }

        Cookie::queue(Cookie::forget('remember_token'));
        Session::flush();

        return redirect('/login');
    }

    // RESET PASSWORD
    public function resetPassword(Request $request)
    {
        $rules = [
            'password_new' => 'required|min:8',
            'password_confirm' => 'required|same:password_new',
        ];

        if (!session('login')) {
            $rules['email'] = 'required|email';
        }

        $request->validate($rules, [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',

            'password_new.required' => 'Password baru harus diisi',
            'password_new.min' => 'Password baru minimal 8 karakter',

            'password_confirm.required' => 'Konfirmasi password harus diisi',
            'password_confirm.same' => 'Konfirmasi password tidak sama',
        ]);

        if (session('login')) {
            $user = UserModel::find(session('id_user'));
        } else {
            $user = UserModel::where('email', $request->email)->first();

            if (!$user) {
                return back()->withErrors([
                    'email' => 'Email tidak ditemukan.',
                ]);
            }
        }

        if (Hash::check($request->password_new, $user->password)) {
            return back()->withErrors([
                'password_new' => 'Password baru tidak boleh sama dengan password lama.',
            ]);
        }

        $user->password = Hash::make($request->password_new);
        $user->save();

        return redirect(session()->pull('redirect_after_reset'))
            ->with('success', 'Password berhasil diubah.');
    }

    // RESET PASSWORD ADMIN
    public function resetPasswordAdmin(Request $request)
    {
        $request->validate([
            'password_old'     => 'required',
            'password_new'     => 'required|min:8',
            'password_confirm' => 'required|same:password_new',
        ], [
            'password_old.required' => 'Password lama harus diisi.',

            'password_new.required' => 'Password baru harus diisi.',
            'password_new.min' => 'Password baru minimal 8 karakter.',

            'password_confirm.required' => 'Konfirmasi password harus diisi.',
            'password_confirm.same' => 'Konfirmasi password tidak sama.',
        ]);

        $admin = UserModel::find(session('id_user'));

        if (!$admin) {
            return back()->withErrors([
                'password_old' => 'Data admin tidak ditemukan.',
            ]);
        }

        if (!Hash::check($request->password_old, $admin->password)) {
            return back()->withErrors([
                'password_old' => 'Password lama salah.',
            ]);
        }

        if (Hash::check($request->password_new, $admin->password)) {
            return back()->withErrors([
                'password_new' => 'Password baru tidak boleh sama dengan password lama.',
            ]);
        }

        $admin->password = Hash::make($request->password_new);
        $admin->save();

        return back()->with('success', 'Password admin berhasil diperbarui.');
    }
}
