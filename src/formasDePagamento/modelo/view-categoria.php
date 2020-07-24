<?php

    include('../../banco/conexao.php');
    require_once('../../class/Crud.class.php');
    if($conexao){

        $requestData = $_REQUEST;
        $crud = Crud::getInstance($conexao, "categorias");
        $id = isset($requestData['idcategoria']) ? $requestData['idcategoria'] : '';

        $cod = "SELECT idcategoria, nome, ativo, DATE_FORMAT(datacriacao, '%d/%m/%Y %H:%i:%s') as datacriacao, DATE_FORMAT(datamodificacao, '%d/%m/%Y %H:%i:%s') as datamodificacao FROM CATEGORIAS WHERE IDCATEGORIA = $id";

        $resultado = $crud->getSQLGeneric($cod, null,false);
        if($resultado){

            $dados = array(
                "tipo" => TYPE_MSG_SUCCESS,
                "mensagem" => '',
                "dados" => $resultado
            );

        } else{
            $dados = array(
                "tipo" => TYPE_MSG_ERROR,
                "mensagem" => "Não foi possível localizar a categoria",
                "dados" => array()
            );
        }


    } else {
        $dados = array(
            "tipo" => TYPE_MSG_INFO,
            "mensagem" => "Não foi possível conectar ao banco de dados",
            "dados" => array()
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);