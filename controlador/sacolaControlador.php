<?php
require 'modelo/produtoModelo.php';

function index() {
        exibir("carrinho/listar");
}
function mostrar() {
    $total = 0;
    $todos = array();
    if(isset($_SESSION["carrinho"])) {  
    $cadastro_produto = $_SESSION["carrinho"];
    //print_r($cadastro_produto);
    foreach ($cadastro_produto as $produto):
    $prod =  pegarProdutoPorId($produto);
    $todos[] = $prod;
    $total += $prod["preco"];
    endforeach;
    } else {
       
    }
    $dados = array();
    $dados["produtos"] = $todos;
    $dados["total"] = $total;
    exibir('sacola/listar', $dados);
}
function limpar(){
   unset($_SESSION['carrinho']);
   redirecionar("sacola/mostrar");
}

function remover($id) {
    $cadastro_produto = $_SESSION["carrinho"];
    foreach ($cadastro_produto as $key => $produto){
        if ($produto['cod_produto'] == $id){
            unset($cadastro_produto[$key]);
        }
    }
    $_SESSION['carrinho'] = $cadastro_produto;
    redirecionar("sacola/mostrar");
}