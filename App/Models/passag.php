<?php

class Passag
{

    private $connPDO;

    public function __construct(){
        try{
            $this->connPDO = new PDO('mysql:host=localhost;dbname=roteirizacao', 'root', '');
        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
    
    public function select(){
        $sql = 'SELECT * FROM passageiros ORDER BY name ASC;';
        $stmt = $this->connPDO->prepare($sql);
        $stmt->execute();

        $dados = [];

        if($stmt->rowCount() > 0){
            
            while($row_stmt = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $json = $row_stmt;
                array_push($dados, $json);
            }
            return $dados;
        }else{
            throw new \Exception('{"error":"Nenhum passageiro encontrado!"}');
        }
    }

     public function insert($passageiro, $cep){
        $sql = 'INSERT INTO passageiros VALUES("", :passageiro, :cep);';
        $stmt = $this->connPDO->prepare($sql);
        $stmt->bindValue(':passageiro', $passageiro);
        $stmt->bindValue(':cep', $cep);

        if($stmt->execute()){
            return array("sucess" => "Passageiro inserido com sucesso!");;
        }else{
            throw new \Exception("Não foi possível cadastrar o passageiro...");
        }
     }

     public function delete($id){
        
        $sql = "DELETE FROM passageiros WHERE id = $id;";
        $stmt = $this->connPDO->prepare($sql);

        if($stmt->execute()){
            return array("sucess" => "Passageiro deletado com sucesso!");
        }else{
            throw new \Exception("Não foi possível deletar o passageiro...");
        }
     }

     public function update($nome, $cep, $id){

        $sql = 'UPDATE passageiros SET name = :nome, cep = :cep WHERE id = :id';
        $stmt = $this->connPDO->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':cep', $cep);
        $stmt->bindValue(':id', $id);

        if($stmt->execute()){
            return array("sucess" => "Passageiro atualizado com sucesso!");
        }else{
            throw new \Exception(array("error"=>"Erro ao atualizar passageiro"));
        }
     }

}