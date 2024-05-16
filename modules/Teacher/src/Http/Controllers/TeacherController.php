<?php

namespace Modules\Teacher\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    protected $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }
    public function index()
    {
        $pageTitle = 'Quản lý giảng viên';
        $teachers = $this->teacherRepository->getAll();
        return view('teacher::lists', compact('pageTitle', 'teachers'));
    }

    public function data()
    {
        $teachers = $this->teacherRepository->getAllTeacher();
        $data = DataTables::of($teachers)
            ->addColumn('edit', function ($teacher) {
                return '<a href="' . route('admin.teacher.edit', $teacher->id) . '" class="btn btn-warning">Sửa</a>';
            })
            ->addColumn('delete', function ($teacher) {
                return '<a href="' . route('admin.teacher.delete', $teacher->id) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($teacher) {
                return Carbon::parse($teacher->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('image', function ($teacher) {

                return $teacher->image ? '<img src="' . $teacher->image . '" style="width: 80px;"/>' : '';
            })
            ->rawColumns(['edit', 'delete', 'image'])
            ->toJson();

        return $data;
    }

    public function create()
    {
        $pageTitle = 'Thêm giảng viên';
        return view('teacher::add', compact('pageTitle'));
    }

    public function store(TeacherRequest $request)
    {
        $teacher = $request->except(['_token']);

        $this->teacherRepository->create($teacher);

        return redirect()->route('admin.teacher.index')->with('msg', 'Thêm giảng viên thành công');
    }

    public function edit($id)
    {
        $teacher = $this->teacherRepository->find($id);

        if (!$teacher) {
            abort(404);
        }

        $pageTitle = 'Cập nhật giảng viên';

        return view('teacher::edit', compact('teacher', 'pageTitle'));
    }

    public function update(TeacherRequest $request, $id)
    {
        $teacher = $request->except('_token');

        $this->teacherRepository->update($id, $teacher);

        return back()->with('msg', 'Cập nhật giảng viên thành công');
    }

    public function delete($id)
    {
        $teacher = $this->teacherRepository->find($id);

        $status = $this->teacherRepository->delete($id);
        if ($status) {
            $image = $teacher->image;
            deleteFileStorage($image);
        }
        return back()->with('msg', 'Xóa giảng viên thành công');
    }
}