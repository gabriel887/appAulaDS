<?php

    include('../../banco/conexao.php');

    if($conexao){

        $sql = "SELECT idcategoria, nome FROM categorias WHERE 1=1 AND ativo like 'S' ";
        
        $resultado = mysqli_query($conexao, $sql);

        if($resultado && mysqli_num_rows($resultado) > 0){
            while($linha = mysqli_fetch_assoc($resultado)){
                $categorias[] = array_map('utf8_encode', $linha);
            }
            $dados = array(
                "tipo" => TYPE_MSG_SUCCESS,
                "mensagem" => '',
                "dados" => $categorias
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