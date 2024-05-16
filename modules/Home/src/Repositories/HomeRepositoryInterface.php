<?php
namespace Modules\Home\src\Repositories;

use App\Repositories\RepositoryInterface;


interface HomeRepositoryInterface extends RepositoryInterface
{
    public function getModel();
}