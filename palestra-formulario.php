<?php include("cabecalho.php"); 

include_once 'conexao.php';
// verifica se ta passando algum tipo na url se é do tipo incluir ou editar, caso seja nenhum dos dois é redirecionado para o index.php
if(isset($_GET['tipo'])){
    // atribuimos o tipo para a variavel incluir ou editar
    $tipo = $_GET['tipo'];
    // verifica se é do tipo editar para fins de preenchimento de campo
    if($tipo == 'editar'){
        $id = $_GET['id'];
        $palestra = $_GET['palestra'];
        $data = $_GET['data'];
        $palestrante = $_GET['palestrante'];
    }

    // essa verificação serve para quando for enviado os dados do formulario, na qual esta verificando se é do tipo incluir a mais abaixo do tipo editar
    // coloquei um isset($_POST['palestra']) na verificação para especificar que abaixo quero fazer as funções para gravação no banco de dados, caso contrario
    // teria problema no código na qual ele tentaria executar o processo de gravação de dados sem apertar o botão de enviar;
    if(isset($_POST['palestra']) && $tipo == 'incluir'){
        $palestra = $_POST['palestra'];
        $data = $_POST['data'];
        $palestrante = $_POST['palestrante'];
        
        $msg = '';
        // bloco para transação de banco de dados
        try{
            // passando as configurações de conexão do banco de dados para a variavel $Conexao
            $Conexao    = Conexao::getConnection();
            
            $query = $Conexao->prepare("insert into palestra (nome, data, palestrante, del) values(:nome, :data, :palestrante, b'0')");
            $query->execute(array(
                ':nome' => $palestra,
                ':data' => $data,
                ':palestrante' => $palestrante
            ));
            // se der tudo certo montei um javascript para exibição da mensagem de sucesso
            if($query->rowCount() > 0){
                echo "<script language='javascript' type='text/javascript'>alert('Palestra cadastrado com sucesso!');window.location.href='index.php'</script>";
            }
        }
        catch(Exception $e){ // tratamento de erros 
            $msg = $e->getMessage();
        echo "<script language='javascript' type='text/javascript'>alert('$msg');window.location.href='index.php'</script>";
            exit;
        }
    } elseif(isset($_POST['palestra']) && $tipo == 'editar'){ // mesma exmplicação que o de cima
            $palestra = $_POST['palestra'];
            $data = $_POST['data'];
            $palestrante = $_POST['palestrante'];

            try{
                $Conexao    = Conexao::getConnection();
                
                $query = $Conexao->prepare("update palestra set nome = :nome, data = :data, palestrante = :palestrante where id = :id");
                $query->execute(array(
                    ':id' => $id,
                    ':nome' => $palestra,
                    ':data' => $data,
                    ':palestrante' => $palestrante
                ));
        
                if($query->rowCount() > 0){
                    echo "<script language='javascript' type='text/javascript'>alert('Palestra alterado com sucesso!');window.location.href='index.php'</script>";
                }
            }
            catch(Exception $e){
                $msg = $e->getMessage();
                    echo "<script language='javascript' type='text/javascript'>alert('$msg');window.location.href='index.php'</script>";
            }
    }
}
else{ // caso nao encontre nenhum tipo retorna para o index.php
    header("location: index.php");
}
?>

<main role="main">
      <div class="jumbotron" style="padding: 1rem 1rem;">
        <h1 id="titulo">Cadastro de palestra</h1>
        <p class="lead" id="subtitulo">Crie uma nova palestra.</p>
        <form method="post">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="palestra" placeholder="Digite o nome da palestra..." required>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" max="31/12/3000" id="data" min="01/01/1000" name="data" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="palestrante">Palestrante</label>
            <input type="text" class="form-control" id="palestrante" name="palestrante" placeholder="Nome do palestrante..." required>
        </div>
        <button type="submit" class="btn btn-primary"><?php if($tipo == "incluir"){ echo "Criar"; } else{ echo "Alterar"; } ?> &raquo;</button>
        <a href="index.php" class="btn btn-danger">Voltar</a>
    </form>
      </div>
    </main>

<?php include("rodape.php");
if($tipo == "editar"){
    // aqui estou preenchendo os campos via jquery caso seja do tipo editar;
    echo "<script>$(document).ready(function(){
        $(\"#nome\").val(\"$palestra\");
        $(\"#data\").val(\"$data\");
        $(\"#palestrante\").val(\"$palestrante\");
        $(\"#titulo\").html(\"Editar Palestra\");
        $(\"#subtitulo\").html(\"Palestra <em><b> $palestra </b></em>\");
        });</script>";
}

?>