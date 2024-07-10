<?php
namespace Modules\Courses\src\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Iman\Streamer\VideoStreamer;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\Students\src\Models\Student;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;

class CoursesController extends Controller
{
    protected $coursesRepository;
    protected $lessonsRepository;
    protected $teacherRepository;
    protected $studentsRepository;
    public function __construct(
        CoursesRepositoryInterface $coursesRepository,
        LessonsRepositoryInterface $lessonsRepository,
        TeacherRepositoryInterface $teacherRepository,
        StudentsRepositoryInterface $studentsRepository,
    ) {
        $this->coursesRepository = $coursesRepository;
        $this->lessonsRepository = $lessonsRepository;
        $this->teacherRepository = $teacherRepository;
        $this->studentsRepository = $studentsRepository;
    }
    public function index()
    {
        $pageTitle = 'Khóa học';
        $pageName = 'Khóa học';
        $courses = $this->coursesRepository->getCourses(config('paginate.limit'));
        return view('courses::clients.index', compact('pageTitle', 'pageName', 'courses'));
    }

    public function detail($slug)
    {
        $course = $this->coursesRepository->getCourseActive($slug);
        if (!$course) {
            abort(404);
        }
        $pageTitle = $course->name;
        $pageName = $course->name;
        $index = 0;
        return view('courses::clients.detail', compact('pageTitle', 'pageName', 'course', 'index'));
    }

    public function getTrialVideo($lessonId = 0)
    {
        $lesson = $this->lessonsRepository->find($lessonId);
        if (!$lesson) {
            return ['success' => false];
        }
        return ['success' => true, 'data' => $lesson];
    }

    public function streamVideo(Request $request)
    {
        $videoPath = $request->video;
        $path = public_path($videoPath);
        VideoStreamer::streamFile($path);
    }


    public function naCheckout($id)
    {
        $course = $this->coursesRepository->getCourse($id);
        if (!$course) {
            abort(404);
        }
        $teacher = $this->teacherRepository->find($course->teacher_id);
        $pageTitle = 'Thanh toán';
        $pageName = $course->name;
        $check = false;
        $address = auth('students')->user()->address;

        if (strpos($address, 'Hà Nội') !== false) {
            // "Hà Nội" được tìm thấy trong địa chỉ
            $check = true;
        } else {
            // "Hà Nội" không được tìm thấy trong địa chỉ
            $check = false;
        }
        $realPrice = $course->sale_price ? $course->sale_price : $course->price;
        return view('courses::clients.naCheckOut', compact('pageTitle', 'pageName', 'course', 'teacher', 'check', 'realPrice'));
    }

    public function naCheckoutSuccess($id)
    {
        $course = $this->coursesRepository->getCourse($id);
        $teacher = $this->teacherRepository->find($course->teacher_id);
        if (!$course) {
            abort(404);
        }
        $pageTitle = 'Thanh toán thành công';
        $pageName = $course->name;
        return view('courses::clients.naCheckOutSuccess', compact('pageTitle', 'pageName', 'course', 'teacher'));
    }

    public function naCheckoutComplete($id)
    {
    }
}