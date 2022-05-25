<?php

class ConnectClass{

    var $Connection;

    public function openConnect(){
       $serverName = 'db';
       $userName = 'root';
       $password = '1q2w3e4r5t';
       $dbName = 'pw_exemple';

       $this -> Connection = new mysqli($serverName, $userName, $password, $dbName);

        if($this -> Connection -> connect_error){
            die("Conexão com o Banco de Dados falhou -> ". $this -> conn -> connect_error);
        }
       
    }
    public function getConnection(){
        return $this -> Connection;
    }
}