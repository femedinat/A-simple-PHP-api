<?php

class Passag
{
    
    public static function select(){
        $connPDO = new \PDO('mysql:host=localhost;dbname=roteirizacao', 'root', '');

        $sql = 'SELECT * FROM passageiros2 ORDER BY passageiro ASC;';
        $stmt = $connPDO->prepare($sql);
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

     public static function insert($passageiro, $cep){
        $connPDO = new \PDO('mysql:host=localhost;dbname=roteirizacao', 'root', '');

        $sql = 'INSERT INTO passageiros2 VALUES("", "1", :passageiro, :cep);';
        $stmt = $connPDO->prepare($sql);
        $stmt->bindValue(':passageiro', $passageiro);
        $stmt->bindValue(':cep', $cep);

        if($stmt->execute()){
            return array("sucess" => "Passageiro inserido com sucesso!");;
        }else{
            throw new \Exception("Não foi possível cadastrar o passageiro...");
        }
     }

     public static function delete($id){
        $ids = '';

        for($i = 0; $i < count($id); $i++){
            $ids .= $id[$i] . ',';
        }
        $ids = rtrim($ids, ",");
        $connPDO = new \PDO('mysql:host=localhost;dbname=roteirizacao', 'root', '');
        $sql = "DELETE FROM passageiros2 WHERE id_passag in ($ids);";
        $stmt = $connPDO->prepare($sql);

        if($stmt->execute()){
            return array("sucess" => "Passageiro deletado com sucesso!");
        }else{
            throw new \Exception("Não foi possível deletar o passageiro...");
        }
     }

     public static function update($nome, $cep, $id){
        $connPDO = new \PDO('mysql:host=localhost;dbname=roteirizacao', 'root', '');

        $sql = 'UPDATE passageiros2 SET passageiro = :nome, cep = :cep WHERE id_passag = :id';
        $stmt = $connPDO->prepare($sql);
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