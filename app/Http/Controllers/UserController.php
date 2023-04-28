<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();

        return view('users.index', [
            'users' => User::all(),
            'tenants' => Tenant::all(),
            'tenant_id' => $request->input('tenant_id'),
        ]);
    }
}
