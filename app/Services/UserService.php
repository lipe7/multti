<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\FormatPhone;
use App\Repositories\UserRepository;

class UserService
{
    use FormatPhone;
    protected UserRepository $user_repository;

    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function getAllUsers()
    {
        $all = $this->user_repository->getAllUsers();
        if (count($all) == 0) {
            return response()->json(['error' => 'No registered users.'], 404);
        }
        return response()->json($all);
    }

    public function store($request)
    {
        $request->phone = $this->phoneToInt($request->phone);
        $newUser = $this->user_repository->newUser($request);

        return $newUser;
    }

    public function getUser($id)
    {
        $user = $this->user_repository->getUser($id);

        if (!$user) {
            return response()->json(['error' => 'User not registered.'], 404);
        }

        return $user;
    }


    public function update($request, $id)
    {
        $user = $this->user_repository->getUser($id);
        if (!$user) {
            return response()->json(['error' => 'User not registered.'], 500);
        }
        $userUpdate = $this->user_repository->update($request, $id);
        return response()->json($userUpdate);
    }

    public function destroy($id)
    {
        $user = $this->user_repository->getUser($id);
        if (!$user) {
            return response()->json(['error' => 'User not registered.'], 500);
        }

        $userDelete = $this->user_repository->destroy($id);
        return response()->json(['message' => 'User deleted.'], 200);
    }
}
