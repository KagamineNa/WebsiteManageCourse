<?php

namespace Modules\Courses\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Courses\src\Http\Requests\CoursesRequest;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class CoursesController extends Controller
{
    protected $coursesRepository;
    protected $categoriesRepository;
    protected $teacherRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository, CategoriesRepositoryInterface $categoriesRepository, TeacherRepositoryInterface $teacherRepository)
    {
        $this->coursesRepository = $coursesRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->teacherRepository = $teacherRepository;
    }
    public function index()
    {
        $pageTitle = "Quản lý khóa học";
        $courses = $this->coursesRepository->getAll();
        return view('courses::lists', compact('pageTitle', 'courses'));
    }

    public function data()
    {
        $courses = $this->coursesRepository->getAllCourses();
        return DataTables::of($courses)
            ->addColumn('lessons', function ($course) {
                return '<a href="' . route('admin.lessons.index', $course) . '" class="btn btn-primary btn-sm">Bài giảng</a>';
            })
            ->addColumn('edit', function ($course) {
                return '<a href="' . route('admin.courses.edit', $course->id) . '" class="btn btn-warning">Sửa</a>';

            })
            ->addColumn('delete', function ($course) {
                return '<a href="' . route('admin.courses.delete', $course->id) . '" class="btn btn-danger delete-action">Xóa</a>';
            })
            ->editColumn('created_at', function ($course) {
                return Carbon::parse($course->created_at)->format('d/m/Y H:i:s');
            })
            ->editColumn('status', function ($course) {
                return $course->status == 1 ? '<button class="btn btn-success">Đã ra mắt</button>' : '<button class="btn btn-warning">Chưa ra mắt</button>';
            })
            ->editColumn('price', function ($course) {
                if ($course->price != 0) {
                    if ($course->sale_price != 0) {
                        $price = '<del>' . number_format($course->price) . ' VNĐ</del> <br> ' . number_format($course->sale_price) . ' VNĐ';
                    } else {
                        $price = number_format($course->price) . ' VNĐ';
                    }
                } else {
                    $price = 'Miễn phí';
                }
                return $price;
            })
            ->rawColumns(['edit', 'delete', 'status', 'price', 'lessons'])
            ->toJson();
    }

    public function create()
    {
        $pageTitle = "Thêm khóa học";

        $categories = $this->categoriesRepository->getAllCategories();
        $teacher = $this->teacherRepository->getAllTeacher()->get();
        return view('courses::add', compact('pageTitle', 'categories', 'teacher'));
    }

    public function store(CoursesRequest $request)
    {
        $courses = $request->except(['_token']);

        if (!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }

        if (!$courses['price']) {
            $courses['price'] = 0;
        }

        $course = $this->coursesRepository->create($courses);

        $categories = $this->getCategories($courses);

        $this->coursesRepository->createCourseCategories($course, $categories);

        return redirect()->route('admin.courses.index')->with('msg', 'Thêm khóa học thành công');
    }

    public function edit($id)
    {
        $course = $this->coursesRepository->getCourse($id);

        $categoryIds = $this->coursesRepository->getRelatedCategories($course);

        $categories = $this->categoriesRepository->getAllCategories();

        $teacher = $this->teacherRepository->getAllTeacher()->get();

        $pageTitle = "Cập nhật khóa học";
        if (!$course) {
            abort(404);
        }
        return view('courses::edit', compact('pageTitle', 'course', 'categories', 'categoryIds', 'teacher'));
    }

    public function update(CoursesRequest $coursesRequest, $id)
    {
        $courses = $coursesRequest->except(['_token', '_method']);
        if (!$courses['sale_price']) {
            $courses['sale_price'] = 0;
        }

        if (!$courses['price']) {
            $courses['price'] = 0;
        }

        $this->coursesRepository->updateCourse($id, $courses);

        $categories = $this->getCategories($courses);

        $course = $this->coursesRepository->getCourse($id);

        $this->coursesRepository->updateCourseCategories($course, $categories);

        return back()->with('msg', 'Cập nhật khóa học thành công');

    }

    public function delete($id)
    {
        $course = $this->coursesRepository->getCourse($id);
        // $this->coursesRepository->deleteCourseCategories($course); // Không cần nữa
        $status = $this->coursesRepository->deleteCourse($id);

        if ($status) {
            deleteFileStorage($course->thumbnail);
        }
        return back()->with('msgSuccess', 'Xóa khóa học thành công');
    }

    public function getCategories($courses)
    {
        $categories = [];
        foreach ($courses['categories'] as $category) {
            $categories[$category] = ['created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')];
        }

        return $categories;
    }
}