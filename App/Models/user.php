<?php

class User
{
    private static $table = 'users';

    public static function select($name, $password){
        $connPDO = new \PDO('mysql:host=localhost;dbname=node_login', 'root', '');

        $sql = 'SELECT * FROM '.self::$table.' WHERE usuario = :usuario and senha = :senha'; 
        $stmt = $connPDO->prepare($sql);
        $stmt->bindValue(':usuario', $name);
        $stmt->bindValue(':senha', $password);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $results = $stmt->fetch(\PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        }else{
            throw new \Exception('{"error":"Nenhum usário encontrado!"}');
        }
     }
}