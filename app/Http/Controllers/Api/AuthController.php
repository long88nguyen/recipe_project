<?php

namespace App\Http\Controllers\Api;

use App\Enums\ErrorType;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Validator;

class AuthController extends Controller
{
    protected function getGuard($guard = 'api')
    {
        return Auth::guard($guard);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try{
            DB::beginTransaction();
            // $data = $request->all();
            // $validator = Validator::make($request->all(), [
            //     'email' => 'required|string|email|unique:users',
            //     'password' => 'required|string|confirmed' // password_confimation
            // ]);
            // if ($validator->fails()) {
            //     return response()->json([
            //         'status' => 'fails',
            //         'message' => $validator->errors()->first(),
            //         'errors' => $validator->errors()->toArray(),
            //     ]);
            // }

            $user = new User([
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'is_admin' => 0
            ]);

            $user->save();

            
            $dataMember = [
                'user_id' => $user->id,
                'name' => 'ID'.random_int(1000000,9999999),
            ];
            Member::create( $dataMember);

            DB::commit();
            return response()->json([
                'status' => 'success',
            ]);
        }
        catch(Exception $e)
        {
            DB::rollBack();
            throw $e;
            return [
                'success' => false,
                'code' => ErrorType::CODE_5000,
                'status_code' => ErrorType::STATUS_500,
                'message' => $e->getMessage()
            ];
        }
    }


    public function login(AuthRequest $request): JsonResponse
    {
        // $validator = Validator::make($request->all(), [
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        //     'remember_me' => 'boolean'
        // ]);
        // if ($validator->fails()) {
        //     return response()->json([
        //         'status' => 'fails',
        //         'message' => $validator->errors()->first(),
        //         'errors' => $validator->errors()->toArray(),
        //     ]);
        // }
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'fails',
                'message' => 'Unauthorized',
                'code' => 401
            ], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->input('remember_me')) {
            $token->expires_at = Carbon::now()->addHours(1);
        }
        $token->save();
        return response()->json([
            'status' => 'success',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_in' => 3600,
            'is_admin' => Auth::user()->is_admin
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return response()->json([
            'status' => 'success',
        ]);
    }

}
