<?php

namespace Modules\Auth\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Modules\Auth\src\Http\Requests\RegisterRequest;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;

class RegisterController extends Controller
{

    private $studentRepository;
    public function __construct(StudentsRepositoryInterface $studentRepository)
    {
        $this->middleware('guest');
        $this->studentRepository = $studentRepository;
    }

    public function showRegistrationForm()
    {
        $pageTitle = 'Đăng ký';
        return view('auth::clients.register', compact('pageTitle'));
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->studentRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => 1,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
        ]);

        if (!$user) {
            return back()->with('msg', 'Bạn không thể đăng ký vào lúc này');
        }
        event(new Registered($user));
        Auth::guard('students')->login($user);
        return redirect()->route('verification.notice');
    }
}