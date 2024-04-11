<?php

include "conn.php";

$dados = $conn->query("SELECT * FROM produtos");

$codProduto = $_POST['codProduto'];
$nomeProduto = $_POST['nomeProduto'];
$precoProduto = $_POST['precoProduto'];
$descricaoProduto = $_POST['descricaoProduto'];
$imagemProduto = $_FILES['imagemProduto']['name'];
$pasta = "img/";


$ext = strtolower(pathinfo($imagemProduto, PATHINFO_EXTENSION));
$imagemProdutof = $codProduto . '.' . $ext;
$imagemProdutobd = $pasta . $imagemProdutof;

$dados = $conn->query("SELECT * FROM produtos");
while($linha = $dados ->fetch_assoc()){
    $codProdutobd = $linha['cod'];
}

if ($codProduto == $codProdutobd) {
    echo "Código do produto ja cadastrado, por favor tente novamente!";
}else {
    if (move_uploaded_file($_FILES['imagemProduto']['tmp_name'], $pasta . $imagemProdutof)) {
    } else {
        $result_message = "Não foi possível concluir o upload da imagem.";
    }
    
    $conn->query("INSERT INTO produtos (id, cod, nome, preco, descricao, imagem)  VALUES (NULL, '$codProduto', '$nomeProduto', '$precoProduto', '$descricaoProduto','$imagemProdutobd' )");

    echo "Cadastro feito com sucesso";
}
