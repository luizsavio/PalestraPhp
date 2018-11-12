<?php include("cabecalho.php"); 

require_once "conexao.php";
// Como essa pagina depende da principal para chegar até nessa fiz uma verificação se existe o parametro id na url caso tenha ele vai setar os valores para as variaveis para que possa ser trabalhadas
if(isset($_GET['id'])){

  $id = $_GET['id'];
  $palestra = $_GET['palestra'];
  $data = $_GET['data'];
  $palestrante = $_GET['palestrante'];
}
// caso contrario com a função header será redirecionado para a tela principal caso o usuario digite diretamente a url
else{
  header("location: index.php");
}

try{

  $Conexao    = Conexao::getConnection();
  $query      = $Conexao->prepare("SELECT id, nome, email, celular FROM participante where idpalestra = :idpalestra and del = b'0';");
  $query->execute(array(
    ':idpalestra' => $id
  ));
  $participantes   = $query->fetchAll();

}catch(Exception $e){
  echo $e->getMessage();
  exit;
}

?>
<main role="main">
      <div class="jumbotron" style="padding: 1rem 1rem;">
        <h1>Detalhe: <?php echo $palestra ?></h1>
        <p class="lead">Palestra: <?php echo $palestra ?></p>
        <p class="lead">Data: <?php echo $data ?></p>
        <p class="lead">Palestrante: <?php echo $palestrante ?></p>
        <a class="btn btn-primary" onclick="gravarUrlLocalStorage()" href="participante-formulario.php?tipo=incluir&idpalestra=<?php echo $id ?>" role="button">Adicionar participante &raquo;</a>
        <a href="index.php" class="btn btn-danger">Voltar</a>
        <h2>Participantes</h2>
        <div class="table-responsive">
    <table class="table table-hover table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Email</th>
      <th scope="col">Celular</th>
      <th scope="col">Editar</th>
      <th scope="col">Excluir</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if(count($participantes) > 0){
      foreach($participantes as $participante) {
        
   ?>
      <tr>
           <td><?php echo $participante['id']; ?></td>
           <td><?php echo $participante['nome']; ?></td>
           <td><?php echo $participante['email']; ?></td>
           <td><?php echo $participante['celular']; ?></td>
           <td><a class="btn btn-warning btn-sm" style="width: 100%" onclick="gravarUrlLocalStorage()"
           href="<?php echo "participante-formulario.php?tipo=editar&id=".$participante['id']."&nome=".$participante['nome']."&email=".$participante['email']."&celular=".$participante['celular']."&idpalestra=".$id ?>">Editar</a></td>
           <td><button class="btn btn-danger btn-sm" style="width: 100%" onClick="abrirModal(<?php echo $participante['id']; ?>)">Excluir</button></td>
           </tr>
   <?php
       }
      }
       else{
         echo "<tr><td colspan=\"6\">Nenhum participante cadastrado!</td></tr>";
       }
   ?>
  </tbody>
</table>
      </div>
    </main>
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 250px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Exclusão</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="corpo">
        <p>Deseja realmente Excluir?</p>
      </div>
      <div class="modal-footer" style="justify-content: center;">
        <button type="button" class="btn btn-danger" id="btnSim">Sim</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
      </div>
    </div>
  </div>
</div>
<?php include("rodape.php") ?>
<script>
$(document).ready(function() {
  
  id = 0;
$('#btnSim').click(function(){
  //$('#myModal').modal('hide');
  var dados = "idparticipante="+id;
  console.log(dados);
  $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'excluir.php',
                async: true,
                data: dados,
                success: function(response) {
                    location.reload();
                }
            });
    });
});

function gravarUrlLocalStorage(){
  var url_atual = window.location.href;
  window.localStorage.setItem('urlpalestradetalhe', url_atual);
}

function abrirModal(id){
  $('#myModal').modal('show');
  this.id = id;
  console.log(this.id);
}
</script>