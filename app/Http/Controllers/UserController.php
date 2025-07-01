<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Contracts\UserServiceInterface;

class UserController extends Controller
{
    private UserServiceInterface $userService;
 
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }

    public function logout(Request $request)
    {
        return $this->userService->logout($request);
    }

    public function register(Request $request)
    {
        return $this->userService->register($request);
    }

    public function getUser(Request $request)
    {
        return $this->userService->getUser($request);
    }   

}
