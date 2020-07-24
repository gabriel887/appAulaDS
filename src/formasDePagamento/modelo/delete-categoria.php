<?php

include("../../banco/conexao.php");
require_once('../../class/Crud.class.php');
if($conexao){
    $requestData = $_REQUEST;
    $crud = Crud::getInstance($conexao, "categorias");
    $id = isset($requestData['idcategoria']) ? $requestData['idcategoria']: '';
    $cond = ['idcategoria='=>$id];

    $resultado = $crud->delete($cond);

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

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);