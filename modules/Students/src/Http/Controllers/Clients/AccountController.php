<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Modules\Students\src\Http\Requests\Clients\PasswordRequest;
use Modules\Students\src\Http\Requests\Clients\StudentRequest;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Carbon\Carbon;

class AccountController extends Controller
{

    protected $studentRepository;
    protected $teacherRepository;
    protected $orderRepository;

    public function __construct(StudentsRepositoryInterface $studentRepository, TeacherRepositoryInterface $teacherRepository, OrdersRepositoryInterface $orderRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->teacherRepository = $teacherRepository;
        $this->orderRepository = $orderRepository;
    }
    public function index()
    {
        $pageName = 'Tài khoản của tôi';
        $pageTitle = 'Tài khoản của tôi';
        return view('students::clients.account', compact('pageName', 'pageTitle'));
    }

    public function profile()
    {
        $pageName = 'Thông tin cá nhân';
        $pageTitle = 'Thông tin cá nhân';
        $student = Auth::guard('students')->user();
        return view('students::clients.profile', compact('pageName', 'pageTitle', 'student'));
    }

    public function updateProfile(StudentRequest $request)
    {
        $id = Auth::guard('students')->user()->id;
        $status = $this->studentRepository->update($id, [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        if ($status) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['errors' => ['Cập nhật thông tin thất bại']], 422);
        }
    }

    public function myCourses(Request $request)
    {
        $pageName = 'Khóa học của tôi';
        $pageTitle = 'Khóa học của tôi';

        $filters = [];
        if ($request->has('teacher_id')) {
            $filters['teacher_id'] = $request->teacher_id;
        }

        if ($request->has('keyword')) {
            $filters['keyword'] = $request->keyword;
        }

        $studentId = Auth::guard('students')->user()->id;
        $courses = $this->studentRepository->getStudentCourses($studentId, $filters, config('paginate.courses_limit'));
        $teachers = $this->teacherRepository->getTeachers();

        return view('students::clients.myCourses', compact('pageName', 'pageTitle', 'courses', 'teachers', ));
    }

    public function myOrders(Request $request)
    {
        $pageName = 'Đơn hàng của tôi';
        $pageTitle = 'Đơn hàng của tôi';

        $filters = [];
        if ($request->status_id) {
            $filters['status_id'] = $request->status_id;
        }
        if ($request->start_date) {
            $filters['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
        }
        if ($request->end_date) {
            $filters['end_date'] = Carbon::parse($request->end_date)->format('Y-m-d');
        }
        if ($request->total) {
            $filters['total'] = $request->total;
        }

        $studentId = Auth::guard('students')->user()->id;
        $orders = $this->orderRepository->getOrdersByStudent($studentId, $filters, config('paginate.orders_limit'));
        $allStatus = $this->orderRepository->getAllOrderStatus();
        return view('students::clients.myOrders', compact('pageName', 'pageTitle', 'orders', 'allStatus'));
    }

    public function changePassword()
    {
        $pageName = 'Đổi mật khẩu';
        $pageTitle = 'Đổi mật khẩu';
        return view('students::clients.changePassword', compact('pageName', 'pageTitle'));
    }

    public function updatePassword(PasswordRequest $request)
    {
        $id = Auth::guard('students')->user()->id;
        $status = $this->studentRepository->setPassword($request->new_password, $id);
        if ($status) {
            session()->flash('success', 'Cập nhật mật khẩu thành công.');
        } else {
            session()->flash('error', 'Cập nhật mật khẩu thất bại.');
        }
        return redirect()->back();
    }

}