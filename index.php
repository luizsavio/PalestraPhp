<?php include("cabecalho.php");

// impormamos o arquivo de conexão para nossa pagina
include "conexao.php";
// instanciamos a variavel para o campo de busca de palestras
$palestrafilter = "";
//verificamos se existe o parametro na url;
if(isset($_GET['palestra'])){
  //caso tenha atribuimos o valor do parametro para a variavel que foi instanciada logo acima.
  $palestrafilter = $_GET['palestra'];
}

// bloco de verificação de execução
try{

    // pegamos a conexão do banco de dados jogamos para a varivel
    $Conexao    = Conexao::getConnection();
    // preparamos a query
    $query      = $Conexao->query("SELECT id, nome, data, palestrante FROM palestra where (del = b'0' and nome like \"%$palestrafilter%\") or (del = b'0' and palestrante like \"%$palestrafilter%\") or (del = b'0' and data like \"%$palestrafilter%\") or (del = b'0' and id like \"%$palestrafilter%\"); ");
    //jogamos os dados do select para dentro da varivel que é um array
    $palestras   = $query->fetchAll();
// caso ocorra algum erro sera o catch que ira tratar
}catch(Exception $e){
    echo $e->getMessage();
    exit;
}
finally{

}
?>
    <main role="main">
      <div class="jumbotron" style="padding: 1rem 1rem;">
        <h1>Palestras</h1>
        <p class="lead">Crie uma nova palestra no botão abaixo.</p>
        
        <a class="btn btn-lg btn-primary" href="palestra-formulario.php?tipo=incluir" role="button" name="tipo" value="incluir">Criar Palestra &raquo;</a>
        
        <h2></h2>
      </div>
    </main>
    <div class="table-responsive">
    <table class="table table-hover table-active ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Palestra</th>
      <th scope="col">Data</th>
      <th scope="col">Palestrante</th>
      <th scope="col">Editar</th>
      <th scope="col">Excluir</th>
    </tr>
  </thead>
  <tbody>
  <?php
  // a tag php pode ser aberto em qualquer parte do arquivo php. Doidera kk permite altas gambi
  // Verifico se o array retornar maior que 0 caso retorne maior que 0 fazemos uma varredura no array para popular a tabela
  if(count($palestras) > 0){
      foreach($palestras as $palestra) {
        $date = date_create($palestra['data']);
        // detalhe importante todos os dados abaixo relacionado ao link de detalhe da palestra e ao botão de editar todos os dados são passados via url no 'href' dessa forma consigo recuperar os dados na outra pagina
   ?>
      <tr>
           <td><?php echo $palestra['id']; ?></td>
           <td><a href="<?php echo "palestra-detalhe.php?id=".$palestra['id']."&palestra=".$palestra['nome']. "&data=".date_format($date, 'd/m/y')."&palestrante=".$palestra['palestrante'] ?>"><?php echo $palestra['nome']; ?></a></td>
           <td><?php echo date_format($date, 'd/m/Y'); ?></td>
           <td><?php echo $palestra['palestrante']; ?></td>
           <td><a class="btn btn-warning btn-sm" style="width: 100%" href="<?php echo "palestra-formulario.php?tipo=editar&id=".$palestra['id']."&palestra=".$palestra['nome']. "&data=".date_format($date, 'Y-m-d')."&palestrante=".$palestra['palestrante'] ?>">Editar</a></td>
           <td><button class="btn btn-danger btn-sm" style="width: 100%" onClick="abrirModal(<?php echo $palestra['id']; ?>)">Excluir</button></td>
           </tr>
   <?php
       }
      }
      // caso a verificação do array seja 0 ele ira mostra essa mensagem dentro da tabela
       else{
        echo "<tr><td colspan=\"6\">Nenhuma palestra encontrada!</td></tr>";
      }
   ?>
    
  </tbody>
</table>
</div>
<!-- Modal para exibir a caixinha de se deseja excluir o registro -->
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
  ide = 0;
  // pegando o click do botão sim da caixinha
$('#btnSim').click(function(){
  // montando uma string de formato de dados para ser enviado via ajax no metodo post
  var dados = "idpalestra="+ide;
  // exibe o log no console do navegador
  console.log(dados);
  // fazendo a requisição ajax solicitando a pagina para fazer a exclusão do registro
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

// função para abrir a caixinha de exclusão chamada via onclick do botão de excluir virifica la que passo o id do registro;
function abrirModal(id){
  $('#myModal').modal('show');
  ide = id;
  console.log(ide);
}
</script>