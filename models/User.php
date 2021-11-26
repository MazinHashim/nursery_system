<?php
class User
{
    private $id;
    private $username;
    private $phone;
    private $email;
    private $password;
    private $rule;
    private $isVerified;
    private $address;
    private $work_hours;
    private $price;
    private $certificate;
    private $img;
    private $accepted;
    private $parent_phone;
    private $nur_id;
    
    public function __construct($username, $phone, $email, $password, $rule, $isVerified){

        $this->username = $username;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->rule = $rule;
        $this->isVerified = $isVerified;
    }


    public function __set($key, $value){
        switch ($key) {
            case 'id':
                $this->id = $value;
            break;
            case 'username':
                $this->username = $value;
            break;
            case 'phone':
                $this->phone = $value;
            break;
            case 'email':
                $this->email = $value;
            break;
            case 'password':
                $this->password = $value;
            break;
            case 'rule':
                $this->rule = $value;
            break;
            case 'isVerified':
                $this->isVerified = $value;
            break;
            case 'address':
                $this->address = $value;
            break;
            case 'work_hours':
                $this->work_hours = $value;
            break;
            case 'price':
                $this->price = $value;
            break;
            case 'certificate':
                $this->certificate = $value;
            break;
            case 'img':
                $this->img = $value;
            break;
            case 'accepted':
                $this->accepted = $value;
            break;
            case 'parent_phone':
                $this->parent_phone = $value;
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
            case 'username':
                return $this->username;
            case 'phone':
                return $this->phone;
            case 'email':
                return $this->email;
            case 'password':
                return $this->password;
            case 'rule':
                return $this->rule;
            case 'address':
                return $this->address;
            case 'work_hours':
                return $this->work_hours;
            case 'price':
                return $this->price;
            case 'certificate':
                return $this->certificate;
            case 'img':
                return $this->img;
            case 'accepted':
                return $this->accepted;
            case 'parent_phone':
                return $this->parent_phone;
            case 'nur_id':
                return $this->nur_id;    
        }
    }   
}