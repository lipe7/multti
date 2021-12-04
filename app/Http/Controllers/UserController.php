<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{

    protected UserService $user_service;

    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function index()
    {
        $allUsers = $this->user_service->getAllUsers();

        return $allUsers;
    }

    public function store(StoreUserRequest $request)
    {

        return $this->user_service->store($request);
    }

    public function show($id)
    {
        return $this->user_service->getUser($id);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        return $this->user_service->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->user_service->destroy($id);
    }
}
