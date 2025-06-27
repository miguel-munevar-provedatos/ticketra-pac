<?php

namespace App\Contracts;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function login(Request $request);
    public function logout(Request $request);
    public function register(Request $request);
    public function getUser(Request $request);
    
}