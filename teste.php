<?php include("Pessoa.php") ?>
<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$celular = $_POST['celular'];

echo "nome: " .$nome. " email: ".$email. " celular: " .$celular;

$arrayteste = array("savio", "bruno", "teste");

for ($i=0; $i < count($arrayteste) ; $i++) { 
    echo "<br/>".$arrayteste[$i];
}

$p = new Pessoa();
$p->setNome("Savio");
$p->setIdade(26);

echo ($p->getNome(). " " .$p->getIdade());
?>