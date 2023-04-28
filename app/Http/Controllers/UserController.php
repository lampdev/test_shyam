<?php

namespace App\Http\Controllers;

use App\Http\Requests\TenantUsersRequest;
use App\Models\Tenant;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function index(TenantUsersRequest $request)
    {
        return view('users.index', [
            'users' => $this->userRepository->getUsersForTenant($request->input('tenant_id')),
            'tenants' => Tenant::all(),
            'tenant_id' => $request->input('tenant_id'),
        ]);
    }
}
