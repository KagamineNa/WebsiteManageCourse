<?php
namespace Modules\Document\src\Repositories;

use App\Repositories\BaseRepository;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;
use Modules\Document\src\Models\Document;

class DocumentRepository extends BaseRepository implements DocumentRepositoryInterface
{
    public function getModel()
    {
        return Document::class;
    }

    public function createDocument($data, $url)
    {
        return $this->model->firstOrCreate($data, ['url' => $url]);
    }
}