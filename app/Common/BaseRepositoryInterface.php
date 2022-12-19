<?php

namespace App\Common;

interface BaseRepositoryInterface
{

    public function all(array $options = []);

    public function insert(array $data);

    public function update(array $data, int $id);

    public function destroy(int $id);

    public function destroyWithIds(array $ids);

    public function totalCount(array $options = []);
}
