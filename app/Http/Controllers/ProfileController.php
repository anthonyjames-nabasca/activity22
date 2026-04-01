<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $req)
    {
        try {
            $user = User::select(
                'user_id',
                'username',
                'fullname',
                'email',
                'profile_image',
                'is_verified',
                'created_at',
                'updated_at'
            )->where('user_id', $req->user()->user_id)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Profile not found.'
                ], 404);
            }

            $user->profile_image = $this->publicFileUrl($req, $user->profile_image);

            return response()->json($user, 200);
        } catch (\Throwable $error) {
            return response()->json([
                'message' => 'Failed to fetch profile.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $req)
    {
        try {
            $currentUser = User::where('user_id', $req->user()->user_id)->first();

            if (!$currentUser) {
                return response()->json([
                    'message' => 'User not found.'
                ], 404);
            }

            $username = $req->username ?: $currentUser->username;
            $fullname = $req->fullname ?: $currentUser->fullname;
            $email = $req->email ?: $currentUser->email;

            $duplicate = User::where(function ($q) use ($username, $email) {
                    $q->where('username', $username)->orWhere('email', $email);
                })
                ->where('user_id', '<>', $req->user()->user_id)
                ->exists();

            if ($duplicate) {
                return response()->json([
                    'message' => 'Username or email is already in use.'
                ], 409);
            }

            $currentUser->username = $username;
            $currentUser->fullname = $fullname;
            $currentUser->email = $email;

            if ($req->password && trim($req->password) !== '') {
                $currentUser->password = Hash::make($req->password);
            }

            $currentUser->save();

            $updatedUser = User::select(
                'user_id',
                'username',
                'fullname',
                'email',
                'profile_image',
                'is_verified',
                'created_at',
                'updated_at'
            )->where('user_id', $req->user()->user_id)->first();

            $updatedUser->profile_image = $this->publicFileUrl($req, $updatedUser->profile_image);

            return response()->json([
                'message' => 'Profile updated successfully.',
                'user' => $updatedUser
            ], 200);
        } catch (\Throwable $error) {
            return response()->json([
                'message' => 'Failed to update profile.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    private function publicFileUrl(Request $req, ?string $relativePath): ?string
    {
        if (!$relativePath) return null;
        if (str_starts_with($relativePath, 'http')) return $relativePath;
        return $req->getSchemeAndHttpHost() . $relativePath;
    }
}