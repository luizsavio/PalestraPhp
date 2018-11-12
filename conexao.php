<?php
  
class Conexao
{
   private static $connection;
  
   private function __construct(){}
  
   public static function getConnection() {
  
       $pdoConfig  = "mysql:host=localhost:3306;dbname=faculdadepalestra";
       
       try {
           if(!isset($connection)){
               $connection =  new PDO($pdoConfig, "root", "123456");
               $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           }
           return $connection;
       } catch (PDOException $e) {
           $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
           $mensagem .= "\nErro: " . $e->getMessage();
           throw new Exception($mensagem);
       }
       finally{
           
       }
   }
}