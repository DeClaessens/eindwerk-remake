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

    /**
     * @param $id
     * @return Concert
     */
    public function findById($id);
}