<?php

namespace Modules\Lessons\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;

class LessonController extends Controller
{
    protected $coursesRepository, $videoRepository, $documentRepository, $lessonRepository;
    public function __construct(CoursesRepositoryInterface $coursesRepository, LessonsRepositoryInterface $lessonRepository)
    {
        $this->coursesRepository = $coursesRepository;
        // $this->videoRepository = $videoRepository;
        // $this->documentRepository = $documentRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index($courseId)
    {
        $course = $this->coursesRepository->getCourse($courseId);

        $pageTitle = "Bài giảng: " . $course->name;
        return view('lessons::lists', compact('pageTitle', 'course'));
    }

    // public function data($courseId)
    // {
    //     $lessons = $this->lessonRepository->getLessons($courseId);

    //     $lessons = DataTables::of($lessons)->toArray();

    //     $lessons['data'] = $this->getLessionsTable($lessons['data']);
    //     return $lessons;
    // }
}