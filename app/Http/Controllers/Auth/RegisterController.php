<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            
            
        ]);
    }

    protected function create(array $data)
    {
        $filename = null;
        if (isset($data['avatar'])) {
            $file = $data['avatar'];
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename, 'public');
        }

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'pseudo' => $data['pseudo'],
            'city' => $data['city'],
            'avatar' => $filename,
            'adresse' => $data['adresse'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
