<?php
class Child
{
    private $id;
    private $name;
    private $age;
    private $fee;
    private $accepted;
    private $parent_id;
    private $nur_id;
    
    public function __construct($name, $age, $fee, $accepted, $nur_id, $parent_id){

        $this->name = $name;
        $this->age = $age;
        $this->fee = $fee;
        $this->accepted = $accepted;
        $this->nur_id = $nur_id;
        $this->parent_id = $parent_id;
    }


    public function __set($key, $value){
        switch ($key) {
            case 'id':
                $this->id = $value;
            break;
            case 'name':
                $this->name = $value;
            break;
            case 'age':
                $this->age = $value;
            break;
            case 'fee':
                $this->fee = $value;
            break;
            case 'accepted':
                $this->accepted = $value;
            break;
            case 'parent_id':
                $this->parent_id = $value;
            break;
            case 'nur_id':
                $this->nur_id = $value;
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
            case 'age':
                return $this->age;
            case 'accepted':
                return $this->accepted;
            case 'fee':
                return $this->fee;
            case 'nur_id':
                return $this->nur_id;
            case 'parent_id':
                return $this->parent_id;
        }
    }
}