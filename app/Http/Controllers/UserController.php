<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request)
    {
        $this->userRepository->create($request->Users);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
