<?php

include("../../banco/conexao.php");
require_once('../../class/Crud.class.php');
if($conexao){
    $requestData = $_REQUEST;
    $crud = Crud::getInstance($conexao, "clientes");
    $id = isset($requestData['idcliente']) ? $requestData['idcliente']: '';
    $cond = ['idcliente='=>$id];

    $resultado = $crud->delete($cond);

    if($resultado){
        $dados = array(
            "tipo" => TYPE_MSG_SUCCESS,
            "mensagem" => "cliente deletada com sucesso."
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