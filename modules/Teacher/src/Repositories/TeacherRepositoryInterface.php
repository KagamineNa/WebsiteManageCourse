<?php
namespace Modules\Teacher\src\Repositories;

use App\Repositories\RepositoryInterface;


interface TeacherRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function getAllTeacher();
    public function getTeachers();
}