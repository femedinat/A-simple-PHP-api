<?php

require_once('App/Models/user.php');

class UserService
{
    public function get($name = null, $password = null){
        $User = new User;
        if($name){
            return $User->select($name, $password);
        }
    }

    public function add($passageiro = null, $cep = null){
        
    }

    public function update(){

    }

    public function delete(){

    }
}