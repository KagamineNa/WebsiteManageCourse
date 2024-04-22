<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $pageTitle = "Quản lý người dùng";
        $users = $this->userRepository->getUsers(5);
        return view('user::lists', compact('pageTitle', 'users'));
    }

    public function create()
    {
        $pageTitle = "Thêm người dùng";
        return view('user::add', compact('pageTitle'));
    }

    public function store(UserRequest $userRequest)
    {

    }
}