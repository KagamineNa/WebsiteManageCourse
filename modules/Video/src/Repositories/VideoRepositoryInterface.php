<?php
namespace Modules\Video\src\Repositories;

use App\Repositories\RepositoryInterface;


interface VideoRepositoryInterface extends RepositoryInterface
{
    public function getModel();
    public function createVideo($data, $url);
}