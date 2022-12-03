<?php
namespace App\Http\Services;

use App\Constants\RolesConstant;
use App\Http\Repositories\MemberRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthApiService {
  protected $userRepository;
  protected $memberRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
    $this->memberRepository = new MemberRepository();
  }

  public function user(Request $request) {
    try {
      $user = $this->userRepository->findOne(['id' => $request->user()->id]);

      return $user;
    } catch (\Exception $e) {
      throw $e;
    }
  }
  public function login(LoginRequest $request) {
    try {
      $user = $this->userRepository->findOne(['email' => $request->email]);

      if(!$user) {
        throw new AuthenticationException('User does not exist');
      }

      $checkHash = Hash::check($request->password, $user->password);
      if(!$checkHash) {
        throw new AuthenticationException('Password mismatch');
      }

      $token = $user->createToken('Access Token')->plainTextToken;
      $response = [
        'user' => $user,
        'access_token' => $token
      ];

      return $response;
    } catch (\Exception $e) {
      throw $e;
    }
  }

  public function register(RegisterRequest $request) {
    try {
      $request['password'] = Hash::make($request['password']);
      $request['roles'] = RolesConstant::MEMBER;

      DB::beginTransaction();

      $user = $this->userRepository->create($request->toArray());
      $this->memberRepository->create([
        'user_id' => $user->id,
        'division_id' => $request->division_id,
        'name' => $request->name,
        'gender' => $request->gender,
        'address' => $request->address,
        'nip' => $request->nip,
      ]);
      $token = $user->createToken('Access Token')->plainTextToken;
      
      DB::commit();

      $user = $this->userRepository->findOne(['id' => $request->id]);

      $response = [
        'user' => $user,
        'access_token' => $token
      ];

      return $response;
    } catch (\Exception $e) {
      DB::rollBack();

      throw $e;
    }
  }

  public function logout(Request $request) {
    try {
      $user = $request->user();
      $user->currentAccessToken()->delete();

      return true;
    } catch (\Exception $e) {
      throw $e;
    }
  }
}