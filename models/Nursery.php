<?php
class Nursery
{
    private $id;
    private $name;
    private $img;
    private $need_babysitter;
    private $time_of_work;
    private $num_of_children;
    private $price;
    private $rating;
    private $address;
    private $manager_id;
    
    public function __construct($id, $name, $img, $address, $num_of_children, $need_babysitter, $time_of_work, $manager_id){

        $this->id = $id;
        $this->name = $name;
        $this->img = $img;
        $this->address = $address;
        $this->num_of_children = $num_of_children;
        $this->need_babysitter = $need_babysitter;
        $this->time_of_work = $time_of_work;
        $this->manager_id = $manager_id;
    }


    public function __set($key, $value){
        switch ($key) {
            case 'id':
                $this->id = $value;
            break;
            case 'name':
                $this->name = $value;
            break;
            case 'img':
                $this->img = $value;
            break;
            case 'address':
                $this->address = $value;
            break;
            case 'num_of_children':
                $this->num_of_children = $value;
            break;
            case 'need_babysitter':
                $this->need_babysitter = $value;
            break;
            case 'time_of_work':
                $this->time_of_work = $value;
            break;
            case 'price':
                $this->price = $value;
            break;
            case 'rating':
                $this->rating = $value;
            break;
            case 'manager_id':
                $this->manager_id = $value;
            break;
        }
        return $value;
    }
    public function __get($key){
        switch ($key) {
            case 'id':
                return $this->id;
            case 'name':
                return $this->name;
            case 'need_babysitter':
                return $this->need_babysitter;
            case 'num_of_children':
                return $this->num_of_children;
            case 'time_of_work':
                return $this->time_of_work;
            case 'img':
                return $this->img;
            case 'address':
                return $this->address;
            case 'rating':
                return $this->rating;
            case 'price':
                return $this->price;
            case 'manager_id':
                return $this->manager_id;
        }
    }   
}