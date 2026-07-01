<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function index()
    {
        // If already logged in, skip the login form and go straight to directory
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/employees');
        }
        return view('login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Hardcoded secure Admin Credentials for our rapid deployment sprint
        // (In production, you'd match these against hashed database records)
        if ($username === 'admin' && $password === 'supersecret123') {
            
            // Set session variables to remember this user
            session()->set([
                'username'   => $username,
                'isLoggedIn' => true,
            ]);

            return redirect()->to('/employees')->with('success', 'Access Granted. Welcome back, Admin.');
        }

        return redirect()->back()->with('error', 'Invalid Security Credentials.');
    }

    public function logout()
    {
        // Destroy session to log out
        session()->destroy();
        return redirect()->to('/auth')->with('success', 'Logged out successfully.');
    }
}