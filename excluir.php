<?php 
include "conexao.php";
// verificamos se possui o parametro idpalestra no corpo da requisição 'post'. lembrando que a requisição POST  é feito pelo corpo da requisição e o GET pela url;
// caso possua ira fazer a query para "excluir" o registro
// caso for o idparticipante ira excluir o registro do participante
if(isset($_POST['idpalestra'])){
  $id = $_POST['idpalestra'];
  try{
    
    $Conexao    = Conexao::getConnection();
    $query2 = $Conexao->prepare("update palestra set del = b'1' where id = :id");
            $query2->execute(array(
                    ':id' => $id
                ));

                if($query2->rowCount() > 0){
                  // se a operação tiver ok retornara uma resposta de verdadeiro;
                  $response = array("success" => true);
                  // empacotando a resposta no formato de texto, lembrando que essa resposta irá retorna para a pagina que voce solicitou o ajax.
                  echo json_encode($response);
                }

  }catch(Exception $e){
    $msg = $e->getMessage();
    $response = array("success" => false);
    echo json_encode($response);

  }
}elseif(isset($_POST['idparticipante'])){
  $id = $_POST['idparticipante'];
  try{
    
    $Conexao    = Conexao::getConnection();
    $query2 = $Conexao->prepare("update participante set del = b'1' where id = :id");
            $query2->execute(array(
                    ':id' => $id
                ));

                if($query2->rowCount() > 0){
                  $response = array("success" => true);
                  echo json_encode($response);
                }

  }catch(Exception $e){
    $msg = $e->getMessage();
    $response = array("success" => false);
    echo json_encode($response);

  }
}

?>