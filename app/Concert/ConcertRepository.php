<?php
namespace App\Concert;


interface ConcertRepository
{
    public function make();
    public function save($concert);
    public function getAll();
    public function findById($id);
}