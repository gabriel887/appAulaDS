<?php

include("../../banco/conexao.php");

if($conexao){
    $requestData = $_REQUEST;

    $id = isset($requestData['idcategoria']) ? $requestData['idcategoria']: '';

    $sql = "DELETE FROM categorias WHERE idcategoria = $id";

    $resultado = mysqli_quer($conexao, $sql);

    if($resultado){
        $dados = array(
            "tipo" => TYPE_MSG_SUCCESS,
            "mensagem" => "Categoria deletada com sucesso."
        );
    }else {
        $dados = array(
            "tipo" => TYPE_MSG_ERROR,
            "mensagem" => "Não foi possível deletar."
        );
    }
}else{
    $dados = array(
        "tipo" => TYPE_MSG_ERROR,
        "mensagem" => "Erro na conexão ao banco."
    );
}