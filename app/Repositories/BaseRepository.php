<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function get(array $query = [], array $columns = ['*'], array $relations = [], array $options = ['paging' => [], 'sort' => []]): Collection|LengthAwarePaginator
    {
        $queryBuilder = $this->model->query();

        if (count($query) > 0) {
            foreach ($query as $value) {
                $queryBuilder->where($value['field'], $value['operator'], $value['value']);
            }
        }

        if (count($relations) > 0) {
            $queryBuilder->with($relations);
        }

        if (count($options['sort']) > 0) {
            $queryBuilder->orderBy($options['sort']['field'], $options['sort']['direction']);
        }

        if (count($options['paging']) > 0) {
            return $queryBuilder->paginate(perPage: $options['paging']['limit'], columns: $columns, page: $options['paging']['page']);
        }

        return $queryBuilder->get($columns);
    }
}
