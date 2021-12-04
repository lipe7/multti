<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Services\UserService;
use Exception;

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
        try {
            $user = $this->user_service->store($request);
        } catch (Exception $e) {
            $user = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($user);
    }

    public function show($id)
    {
        $users = $this->user_service->getUser($id);
        return $users;
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $update = $this->user_service->update($request, $id);
        return $update;
    }

    public function destroy($id)
    {
        $delete = $this->user_service->destroy($id);

        return $delete;
    }
}
