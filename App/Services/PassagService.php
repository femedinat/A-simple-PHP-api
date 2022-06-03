<?php

require_once('App/Models/passag.php');

class PassagService
{
    public function get(){
        $Passag = new Passag;
        $json_passag = $Passag->select();
        return $json_passag;
    }

    public function post($passageiro = null, $cep = null){
        $Passag = new Passag;
        if($passageiro){
            return $Passag->insert($_POST['name'], $_POST["cep"]);
        }
    }

    public function put(){
        $Passag = new Passag;
        parse_str(file_get_contents("php://input"),$data);
        return $Passag->update($data["name"], $data["cep"], $data["id"]);
    }

    public function delete($id = null){
        $Passag = new Passag;
        parse_str(file_get_contents("php://input"),$data);
        return $Passag->delete($data['id']);
        
    }
}