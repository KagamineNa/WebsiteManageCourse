<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

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
        $users = $this->userRepository->getAll();
        return view('user::lists', compact('pageTitle', 'users'));
    }

    public function data()
    {
        $users = $this->userRepository->getAllUsers();
        return DataTables::of($users)
            ->addColumn('edit', function ($user) {
                return '<a href="' . route('admin.user.edit', $user->id) . '" class="btn btn-warning">Sửa</a>';

            })
            ->addColumn('delete', function ($user) {
                return '<a href="' . route('admin.user.delete', $user->id) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/Y H:i:s');
            })
            ->rawColumns(['edit', 'delete'])
            ->toJson();
    }

    public function create()
    {
        $pageTitle = "Thêm người dùng";
        return view('user::add', compact('pageTitle'));
    }

    public function store(UserRequest $userRequest)
    {
        $this->userRepository->create([
            'name' => $userRequest->name,
            'email' => $userRequest->email,
            'password' => Hash::make($userRequest->password),
            'group_id' => $userRequest->group_id,
        ]);

        return redirect()->route('admin.user.index')->with('msgSuccess', 'Thêm người dùng thành công');
    }

    public function edit($id)
    {
        $pageTitle = "Cập nhật người dùng";
        $user = $this->userRepository->find($id);
        if (!$user) {
            abort(404);
        }
        return view('user::edit', compact('pageTitle', 'user'));

    }

    public function update(UserRequest $userRequest, $id)
    {
        $data = $userRequest->except('_token', 'password');
        if ($userRequest->password) {
            $data['password'] = Hash::make($userRequest->password);
        }
        $status = $this->userRepository->update($id, $data);
        if ($status) {
            return back()->with('msgSuccess', 'Cập nhật người dùng thành công');
        }

    }

    public function delete($id)
    {
        $status = $this->userRepository->delete($id);
        if ($status) {
            return back()->with('msgSuccess', 'Xóa người dùng thành công');
        }
    }
}