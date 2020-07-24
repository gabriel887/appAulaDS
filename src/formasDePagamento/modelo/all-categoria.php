<?php

    include('../../banco/conexao.php');
    require_once('../../class/Crud.class.php');
    if($conexao){
        $crud = Crud::getInstance($conexao, "categorias");
        $cod = "SELECT idcategoria, nome FROM categorias WHERE 1=1 AND ativo like 'S' ";
        $resultado = $crud->getSQLGeneric($cod);

        if($resultado){
            $dados = array(
                "tipo" => TYPE_MSG_SUCCESS,
                "mensagem" => '',
                "dados" => $resultado
            );
        }else{
            $dados = array(
                "tipo" => TYPE_MSG_ERROR,
                "mensagem" => "Não foi possível localizar nenhuma categoria",
                "dados" => array()
            );
        }
         mysqli_close($conexao);

    } else {
        $dados = array(
            "tipo" => TYPE_MSG_INFO,
            "mensagem" => "Não foi possível conectar ao banco de dados",
            "dados" => array()
        );
    }

    echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);