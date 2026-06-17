<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([

    'name' => [

        'required',

        'string',

        'min:3',

        'max:255'

    ],

    'email' => [

        'required',

        'email',

        'max:255',

        'unique:users,email'

    ],

    'nomor_telepon' => [

        'required',

        'numeric',

        'digits_between:10,15',

        'unique:users,nomor_telepon'

    ],

    'password' => [

        'required',

        'min:8',

        'confirmed'

    ]

], [

    'name.required' =>
        'Nama wajib diisi',

    'name.min' =>
        'Nama minimal 3 karakter',

    'email.required' =>
        'Email wajib diisi',

    'email.email' =>
        'Format email tidak valid',

    'email.unique' =>
        'Email sudah terdaftar',

    'nomor_telepon.required' =>
        'Nomor telepon wajib diisi',

    'nomor_telepon.numeric' =>
        'Nomor telepon hanya boleh angka',

    'nomor_telepon.digits_between' =>
        'Nomor telepon harus 10 - 15 digit',

    'nomor_telepon.unique' =>
        'Nomor telepon sudah digunakan',

    'password.required' =>
        'Password wajib diisi',

    'password.min' =>
        'Password minimal 8 karakter',

    'password.confirmed' =>
        'Konfirmasi password tidak cocok',

]);

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'nomor_telepon' => $request->nomor_telepon,
        'password' => Hash::make($request->password),
        'role' => 'user',
        ]);

        event(new Registered($user));

        //Auth::login($user);

        return redirect('/login')
    ->with('success', 'Register berhasil, silahkan login');
    }
}
