<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{

    public function getAllUsers()
    {
        $users = User::select()->get();
        return $users;
    }

    public function newUser($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return $user;
    }

    public function getUser($id)
    {
        $user = User::select()
            ->where('id', $id)
            ->first();

        return $user;
    }

    public function update($request, $id)
    {

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        $user = User::find($id);

        return $user;
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return $user;
    }
}
