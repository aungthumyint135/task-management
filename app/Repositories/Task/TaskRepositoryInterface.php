<?php

namespace App\Repositories\Task;

//use App\Common\BaseRepositoryInterface;

interface TaskRepositoryInterface
{

    public function all(array $options = []);

    public function insert(array $data);

    public function update(array $data, int $id);

    public function destroy(int $id);

    public function getDataById(int $id);

    public function destroyWithIds(array $ids);

    public function totalCount(array $options = []);
}
