<?php

namespace App\Services;

use App\Traits\FormatPhone;
use App\Repositories\UserRepository;
use Error;
use Exception;
use Illuminate\Validation\ValidationException;

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
        try {
            $request->phone = $this->phoneToInt($request->phone);
            $newUser = $this->user_repository->newUser($request);

            return response()->json($newUser);
        } catch (Exception $e) {
            $newUser = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return $newUser;
    }

    public function getUser($id)
    {
        try {
            $user = $this->user_repository->getUser($id);
            if (!$user) {
                throw new Error("User not registered.", 422);
            }
            return response()->json($user);
        } catch (\Throwable $th) {
            throw ValidationException::withMessages([
                "message" => $th->getMessage(),
                "code" => $th->getCode(),
            ]);
        }
    }

    public function update($request, $id)
    {
        try {
            $user = $this->user_repository->getUser($id);

            if ($user) {
                $userUpdate = $this->user_repository->update($request, $id);
            } else {
                throw new Error("User not registered.", 422);
            }

            return response()->json($userUpdate);
        } catch (\Throwable $th) {
            throw ValidationException::withMessages([
                "message" => $th->getMessage(),
                "code" => $th->getCode()
            ]);
        }
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
