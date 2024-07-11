<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function showForm(): Response
    {
        return response()->view('users.form-login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request): Response|RedirectResponse
    {
        $user = $request->input('user');
        $password = $request->input('password');
        if (empty($user) || empty($password)) {
            return response()->view('users.form-login', [
                'title' => 'Login',
                'error' => 'User or Password Required!'
            ]);
        }

        if ($this->userService->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect()->route('todolist');
        }

        return response()->view("users.form-login", [
            'title' => 'Login',
            'error' => 'User Or Password Wrong!'
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');
        return redirect()->route('showForm');
    }
}
