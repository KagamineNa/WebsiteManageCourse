<?php
namespace Modules\Lessons\src\Repositories;

use App\Repositories\RepositoryInterface;


interface LessonsRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function getPosition($courseId);
    public function getLessons($courseId);
    public function getAllLessions($courseId);
    public function getLessonCount($course);
    public function getModuleByPosition($course);
    public function getLessonsByPosition($course, $moduleId = null, $isDocument = false);
    public function getLesssonActive($slug);

}