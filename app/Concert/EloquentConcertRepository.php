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
        return $this->model->orderBy('date', 'asc')->get();
    }

    public function find($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function getAllConcerts()
    {
        return $this->model->orderBy('date', 'asc')->get();
    }

    public function getUpcomingConcerts($amount)
    {
        $query = $this->model->where('event_passed', '0')->orderBy('date', 'asc')->limit($amount)->get();
        return $query;
    }
}