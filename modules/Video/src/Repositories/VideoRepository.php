<?php
namespace Modules\Video\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Video\src\Models\Video;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
    public function getModel()
    {
        return Video::class;
    }

    public function createVideo($data, $url)
    {
        return $this->model->firstOrCreate(['url' => $url], $data);
    }

}