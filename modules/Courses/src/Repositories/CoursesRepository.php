<?php
namespace Modules\Courses\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Courses\src\Models\Course;

class CoursesRepository extends BaseRepository implements CoursesRepositoryInterface
{
    public function getModel()
    {
        return Course::class;
    }

    public function getAllCourses()
    {
        return $this->model->select('id', 'name', 'price', 'sale_price', 'status', 'created_at')->latest();
    }

    public function getCourse($id)
    {
        // return $this->model->withoutGlobalScope(ActiveScope::class)->find($id);
        return $this->model->find($id);
    }

    public function createCourseCategories($course, $data = [])
    {
        return $course->categories()->attach($data);
    }

    public function updateCourseCategories($course, $data = [])
    {
        return $course->categories()->sync($data);
    }

    public function deleteCourseCategories($course)
    {
        return $course->categories()->detach();
    }

    public function getRelatedCategories($course)
    {
        $categoryIds = $course->categories()->allRelatedIds()->toArray();
        return $categoryIds;
    }

    public function getCourses($limit)
    {
        return $this->model->limit($limit)->latest()->paginate($limit);
    }
    public function getCourseActive($slug)
    {
        return $this->model->whereSlug($slug)->first();
    }

    public function deleteCourse($id)
    {
        // return $this->model->withoutGlobalScope(ActiveScope::class)->where('id', $id)->delete();
        return $this->model->where('id', $id)->delete();
    }

    public function updateCourse($id, $data = [])
    {
        $result = $this->getCourse($id);
        if ($result) {
            return $result->update($data);
        }
        return false;
    }
}