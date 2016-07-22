<?php
namespace App\Concert;


class EloquentConcertRepository implements ConcertRepository
{
    /**
     * @var Concert
     */
    private $model;

    /**
     * EloquentConcertRepository constructor.
     * @param Concert $model
     */
    public function __construct(Concert $model)
    {
        $this->model = $model;
    }

    public function make()
    {
        return $this->model->newInstance();
    }

    public function save($concert)
    {
        $concert->save();
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }
}