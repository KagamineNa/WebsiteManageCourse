<?php

namespace Modules\Home\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;

class HomeController extends Controller
{
    protected $coursesRepository;

    public function __construct(CoursesRepositoryInterface $coursesRepository)
    {
        $this->coursesRepository = $coursesRepository;
    }
    public function index()
    {
        // $courses = $this->coursesRepository->getCourses(config('paginate.limit'));
        $courseIdsCoBan = [1, 6, 8, 9];
        $courseIdsChuyenSau = [7, 10, 12, 13];
        $courseIdsNoiBat = [4, 5, 11, 2];
        $coursesCoBan = $this->coursesRepository->findMany($courseIdsCoBan);
        $coursesChuyenSau = $this->coursesRepository->findMany($courseIdsChuyenSau);
        $coursesNoiBat = $this->coursesRepository->findMany($courseIdsNoiBat);
        $pageTitle = 'Trang chủ';
        return view('home::index', compact('pageTitle', 'coursesCoBan', 'coursesChuyenSau', 'coursesNoiBat'));
    }
}