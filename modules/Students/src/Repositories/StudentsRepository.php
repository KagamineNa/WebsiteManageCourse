<?php
namespace Modules\Students\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;
use Modules\Students\src\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentsRepository extends BaseRepository implements StudentsRepositoryInterface
{
    public function getModel()
    {
        return Student::class;
    }

    public function getStudents($limit)
    {
        return $this->model->paginate($limit);
    }

    public function getAllStudents()
    {
        return $this->model->select(['id', 'name', 'email', 'status', 'created_at'])->latest();
    }

    public function setPassword($password, $id)
    {
        return $this->update($id, ['password' => Hash::make($password)]);
    }

    public function checkPassword($password, $id)
    {
        $user = $this->find($id);
        if ($user) {
            $hashPassword = $user->password;
            return Hash::check($password, $hashPassword);
        }
        return false;
    }

    public function getStudentCourses($id, $filters = [], $limit)
    {
        extract($filters);
        $query = $this->model->find($id)->courses();
        if (!empty($teacher_id)) {
            $query->where('teacher_id', $teacher_id);
        }
        if (!empty($keyword)) {
            $query->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('detail', 'like', '%' . $keyword . '%');
            });
        }
        return $query->paginate($limit)->withQueryString();
    }
}