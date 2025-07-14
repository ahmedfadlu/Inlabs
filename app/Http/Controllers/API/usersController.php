<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends Controller
{
    
    public function index()
    {
        return UsersResource::collection(Users::all());
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users',
            'nim' => 'required|unique:users',
            'password' => 'required|min:6',
            'nama' => 'required|string',
            'role' => 'required|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = Users::create($validated);

        return response()->json([
            'message' => 'Registrasi berhasil',
            'data' => $user
        ], 201);
    }


    public function show($id)
    {
        try {
            $user = Users::findOrFail($id);
            return new UsersResource($user);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = Users::findOrFail($id);

            $validated = $request->validate([
                'nama' => 'sometimes|required|string|max:100',
                'email' => 'sometimes|required|email|unique:users,email,' . $id . ',id_user',
                'password' => 'sometimes|nullable|string|min:6',
                'nim' => 'nullable|string|max:20',
                'role' => 'required|in:mahasiswa,kepala_lab,admin'
            ]);

            if (isset($validated['password'])) {
                $validated['password'] = bcrypt($validated['password']);
            }

            $user->update($validated);
            return new UsersResource($user);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat update user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = Users::findOrFail($id);
            $user->delete();
            return response()->json([
                'message' => 'User berhasil dihapus',
                'id' => $id
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
