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
        $data = file_get_contents('php://input');
        $response = json_decode($data, true);
        if($passageiro){
            return $Passag->insert($response["passageiro"], $response["cep"]);
        }
    }

    public function update(){
        $Passag = new Passag;
        $data = file_get_contents('php://input');
        $response = json_decode($data, true);
        return $Passag->update($response["nome"], $response["cep"], $response["id"]);
    }

    public function delete($id = null){
        $Passag = new Passag;
        $data = file_get_contents('php://input');;
        $response = json_decode($data, true);
        $arrayId = $response['id'];
        
        return $Passag->delete($arrayId);
        
    }
}