<?php
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}

class User{
    private $id;
    private $username;
    private $name;
    private $surname;
    private $email;
    private $right;
    private $deleted;
    private $password;
    private $adress;
    private $npa;
    private $city;

    //Construction
    public function __construct(array $data) {
            $this -> hydrate($data);
    }

    //Hydrate
    public function hydrate($data) {
            foreach ($data as $key => $value) {
                    //method = function name with given attr.
                    $method = 'set' . $key;

                    //if set exists: call the set function
                    if (method_exists($this, $method)) {
                            $this -> $method($value);
                    }
            }
    }

    public function getid() {
        return $this->id;
    }

    public function getusername() {
        return $this->username;
    }
    
    function getadress() {
        return $this->adress;
    }

    function getnpa() {
        return $this->npa;
    }

    function getcity() {
        return $this->city;
    }

    public function getname() {
        return $this->name;
    }

    public function getsurname() {
        return $this->surname;
    }

    public function getemail() {
        return $this->email;
    }

    public function getright() {
        return $this->right;
    }

    public function getdeleted() {
        return $this->deleted;
    }

    public function getpassword() {
        return $this->password;
    }

    
    
    public function setid($id) {
        $this->id = $id;
    }

    public function setusername($username) {
        $this->username = $username;
    }

    public function setname($name) {
        $this->name = $name;
    }

    public function setsurname($surname) {
        $this->surname = $surname;
    }

    public function setemail($email) {
        $this->email = $email;
    }

    public function setright($right) {
        $this->right = intval($right);
    }

    public function setdeleted($deleted) {
        $this->deleted = intval($deleted);
    }

    public function setpassword($password) {
        $this->password = $password;
    }
    
    function setadress($adress) {
        $this->adress = $adress;
    }

    function setnpa($npa) {
        $this->npa = intval($npa);
    }

    function setcity($city) {
        $this->city = $city;
    }
}