<?php
namespace Modules\Students\src\Repositories;

use App\Repositories\RepositoryInterface;


interface StudentsRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function getStudents($limit);
    public function getAllStudents();
    public function setPassword($password, $id);
    public function checkPassword($password, $id);
    public function getStudentCourses($id, $filters = [], $limit);

}