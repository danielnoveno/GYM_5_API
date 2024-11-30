<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    /**
     * Register a new pelanggan.
     */
    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'umur' => 'required|integer',
                'alamat' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:15',
                'email' => 'required|email|unique:pelanggans,email',
                'password' => 'required|string|min:8',
            ]);

            // Hash the password
            $validated['password'] = bcrypt($validated['password']);

            $pelanggan = Pelanggan::create($validated);

            return response()->json([
                'status' => true,
                'message' => 'Registration successful',
                'data' => $pelanggan,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error during registration',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Login pelanggan.
     */
    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $pelanggan = Pelanggan::where('email', $validated['email'])->first();

            if ($pelanggan && Hash::check($validated['password'], $pelanggan->password)) {
                $token = $pelanggan->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    'data' => [
                        'pelanggan' => $pelanggan,
                        'token' => $token,
                    ],
                ], 200);
            }

            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password',
            ], 401);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error during login',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
