<?php

class Pessoa{

private $nome;
private $idade;

    function pessoa(){

    }

    function setNome($_nome){
        $this->nome = $_nome;
    }
    function setIdade($_idade){
        $this->idade = $_idade;
    }
    function getNome(){
        return $this->nome;
    }
    function getIdade(){
        return $this->idade;
    }
}
?>
