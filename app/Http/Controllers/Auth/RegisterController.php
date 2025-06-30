<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'string|max:255|unique:users|required',
            'email'    => 'string|email:rfc,dns|max:255|lowercase|unique:users|required',
            'password' => 'string|min:8|required',
        ], [
            'login.unique' => 'Этот логин уже используется.',
            'email.unique' => 'Этот email уже используется.',
            'email.rfc,dns' => 'Введите корректный домен email.',
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('loginForm')->with('status', 'Регистрация прошла успешно');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
