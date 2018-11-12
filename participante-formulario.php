<?php include("cabecalho.php");

include_once 'conexao.php';
// verifica se ta passando algum tipo na url se é do tipo incluir ou editar, caso seja nenhum dos dois é redirecionado para o index.php
if($_GET['tipo'] == 'incluir' || $_GET['tipo'] == 'editar'){
    // atribuimos o tipo para a variavel incluir ou editar
    $tipo = $_GET['tipo'];
    $idpalestra = $_GET['idpalestra'];
    // verifica se é do tipo editar para fins de preenchimento de campo
    if($tipo == 'editar' && $_GET['id'] != null && $_GET['nome'] != null && $_GET['email'] && $_GET['celular'] != null){
        $id = $_GET['id'];
        $nome = $_GET['nome'];
        $email = $_GET['email'];
        $celular = $_GET['celular'];   
    } else if($tipo != 'incluir'){
        header("location: index.php");
    }


    // essa verificação serve para quando for enviado os dados do formulario, na qual esta verificando se é do tipo incluir a mais abaixo do tipo editar
    // coloquei um isset($_POST['palestra']) na verificação para especificar que abaixo quero fazer as funções para gravação no banco de dados, caso contrario
    // teria problema no código na qual ele tentaria executar o processo de gravação de dados sem apertar o botão de enviar;
    if(isset($_POST['nome']) && $tipo == 'incluir'){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];
        $celular = preg_replace('/[ ()-]/', '' , $celular);
        echo "<script> console.log($celular)</script>";
        
        $msg = '';
        // bloco para transação de banco de dados
        try{
            // passando as configurações de conexão do banco de dados para a variavel $Conexao
            $Conexao    = Conexao::getConnection();
            
            $query = $Conexao->prepare("insert into participante (nome, email, celular, idpalestra, del) values(:nome, :email, :celular, :idpalestra, b'0')");
            $query->execute(array(
                ':nome' => $nome,
                ':email' => $email,
                ':idpalestra' => (int)$idpalestra,
                ':celular' => $celular
            ));
            // se der tudo certo montei um javascript para exibição da mensagem de sucesso
            if($query->rowCount() > 0){
                echo "<script>
                alert('Participante cadastrado com sucesso!');
                window.location.href=window.localStorage.getItem('urlpalestradetalhe');;
                </script>";
            }
        }catch(Exception $e){ // tratamento de erros 
            $msg = $e->getMessage();
        echo "<script>alert('$msg');window.location.href='javascript:window.history.go(-2)'</script>";
            exit;
        }
  } elseif(isset($_POST['nome']) && $tipo == 'editar'){ // mesma exmplicação que o de cima
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $celular = $_POST['celular'];
      $celular = preg_replace('/[ ()-]/', '' , $celular);// tirando caracteres para salvar no banco

            try{
                $Conexao    = Conexao::getConnection();
                
                $query = $Conexao->prepare("update participante set nome = :nome, email = :email, celular = :celular where id = :id");
                $query->execute(array(
                    ':id' => $id,
                    ':nome' => $nome,
                    ':email' => $email,
                    ':celular' => $celular
                ));
        
                if($query->rowCount() > 0){
                    echo "<script>
                    alert('Participante alterado com sucesso!');
                    window.location.href=window.localStorage.getItem('urlpalestradetalhe');
                    </script>";
                }
            }catch(Exception $e){
                $msg = $e->getMessage();
                    echo "<script language='javascript' type='text/javascript'>alert('$msg');window.location.href='palestra-detalhe.php'</script>";
            }
    }
}
else{ // caso nao encontre nenhum tipo retorna para o index.php
    header("location: index.php");
}
?>
<main role="main">
      <div class="jumbotron" style="padding: 1rem 1rem;">
        <h1 id="titulo">Cadastro de participante</h1>
        <p class="lead" id="subtitulo">Adicione um novo participante.</p>
        <form method="post"> 
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome da participante..." required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Digite o email do participante..." required>
        </div>
        <div class="form-group">
            <label for="celular">Celular</label>
            <input type="text" id="celular" name="celular" class="form-control" placeholder="Numero de celular..." required>
        </div>
        <button type="submit" class="btn btn-primary"><?php if($tipo == "incluir"){ echo "Criar"; } else{ echo "Alterar"; } ?> &raquo;</button>
        <a href="javascript:window.history.go(-1)" class="btn btn-danger">Voltar</a>
    </form>
      </div>
    </main>
<?php include("rodape.php");

if($tipo == "editar"){
  echo "<script>$(document).ready(function(){
      $(\"#nome\").val(\"$nome\");
      $(\"#email\").val(\"$email\");
      $(\"#celular\").val($celular);
      $(\"#celular\").mask('(00) 00000-0000');
      $(\"#titulo\").html(\"Editar Participante\");
      $(\"#subtitulo\").html(\"Participante <em><b> $nome </b></em>\");
      });</script>";
}
else{
  echo "<script>
    $(document).ready(function(){
    $(\"#celular\").mask('(00) 00000-0000');
    });
    </script>";
}
?>
