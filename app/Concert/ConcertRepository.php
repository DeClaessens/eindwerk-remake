<?php
namespace App\Concert;


interface ConcertRepository
{
    /**
     * @return Concert
     */
    public function make();

    /**
     * @param $concert
     */
    public function save($concert);

    /**
     * @return Concert[]
     */
    public function getAll();

    public function find($id);

    /**
     * @param $id
     * @return Concert
     */
    public function findById($id);


    public function getAllConcerts();

    public function getUpcomingConcerts($amount);

    public function getAllUpcomingConcerts();
}