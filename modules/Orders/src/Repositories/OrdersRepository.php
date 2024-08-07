<?php
namespace Modules\Orders\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Orders\src\Repositories\OrdersRepositoryInterface;
use Modules\Orders\src\Models\Order;
use Modules\Orders\src\Models\OrderStatus;

class OrdersRepository extends BaseRepository implements OrdersRepositoryInterface
{
    public function getModel()
    {
        return Order::class;
    }
    public function getOrdersByStudent($studentId, $filters = [], $limit)
    {
        @['status_id' => $statusId, 'start_date' => $startDate, 'end_date' => $endDate, 'total' => $total] = $filters;
        $query = $this->model->where('student_id', $studentId)->latest();
        if ($statusId) {
            $query->where('status_id', $statusId);
        }
        if ($startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        }
        if ($total && $total >= 0) {
            $query->where('total', '>=', $total);
        }
        return $query->paginate($limit)->withQueryString();
    }

    public function getAllOrderStatus()
    {
        return OrderStatus::all();
    }

}