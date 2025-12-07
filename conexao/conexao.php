<?php


function abrirBanco()
{
    $conexao = new mysqli("localhost", "root", "", "lab_eletronica");
    return $conexao;
}




### Função para redirecionar
function voltarIndex()
{
    header("location:home.php");
}
