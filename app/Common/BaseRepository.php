<?php

namespace App\Common;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    public function all(array $options = [])
    {
        return $this->optionsQuery($options)->get();    }

    public function insert(array $data)
    {
        return $this->connection()->query()->create($data);
    }

    public function update(array $data, int $id)
    {
        return $this->connection()->query()->where('id', $id)->update($data);
    }

    public function destroy(int $id)
    {
        return $this->connection()->query()->find($id)->delete();
    }

    public function destroyWithIds(array $ids)
    {
        return $this->connection()->query()->whereIn('id', $ids)->delete();
    }

    public function totalCount(array $options = [])
    {
        return $this->optionsQuery($options)->count();
    }

    public function getDataById(int $id, array $relations = [])
    {
        return $this->connection()->query()->with($relations)->where('id', $id)->first();
    }

    abstract public function connection(): Model;

    protected function optionsQuery(array $options)
    {
        $query = $this->connection()->query();

        if (isset($options['order_by'])) {
            if (is_array($options['order_by'])) {
                foreach ($options['order_by'] as $column => $orderBy) {
                    $query = $query->orderBy($column, $orderBy);
                }
            } else {
                $query = $query->orderBy('created_at', $options['order_by']);
            }
        } else {
            $query = $query->orderBy('created_at', 'desc');
        }

        return $query;
    }

}
