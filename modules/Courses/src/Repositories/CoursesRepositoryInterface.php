<?php
namespace Modules\Courses\src\Repositories;

use App\Repositories\RepositoryInterface;


interface CoursesRepositoryInterface extends RepositoryInterface
{
    public function getModel();

    public function getAllCourses();

    public function getCourse($id);

    public function createCourseCategories($course, $data = []);

    public function getRelatedCategories($course);

    public function updateCourse($id, $data = []);

    public function updateCourseCategories($course, $data = []);

    public function getCourses($limit);

    public function getCourseActive($slug);

    public function deleteCourse($id);

    public function deleteCourseCategories($course);

    public function findMany($ids);


}