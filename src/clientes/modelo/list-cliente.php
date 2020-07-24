<?php

    include('../../banco/conexao.php');
    require_once('../../class/Crud.class.php');
    if($conexao){

        $requestData = $_REQUEST;
        $crud = Crud::getInstance($conexao, 'clientes');
        $colunas = $requestData['columns'];

        $cod = "SELECT idcliente, nome, email, ativo, telefone, datamodificacao FROM clientes WHERE 1=1 ";
        $resultado = $crud->getSQLGeneric($cod);
        $qtdeLinhas = count($resultado);
        
        if(!empty($requestData['search']['value'])){
            $cod .= " AND (idcliente LIKE '$requestData[search][value]' OR nome LIKE '$requestData[search][value]')";
        }

        $resultado = $crud->getSQLGeneric($cod);
        $totalFiltrados =  count($resultado);

        $colunaOrdem = $requestData['order'][0]['column'];
        $ordem = $colunas[$colunaOrdem]['data'];
        $direcao = $requestData['order'][0]['dir'];

        $cod .= " ORDER BY $ordem $direcao LIMIT $requestData[start], $requestData[length] ";
        $resultado = $crud->getSQLGeneric($cod);
        
        $dados = $resultado;
        $json_data = array(
            "draw" => intval($requestData['draw']),
            "recordsTotal" => intval($qtdeLinhas),
            "recordsFiltered" => intval($totalFiltrados),
            "data" => $dados
        );


    } else{
        $json_data = array(
            "draw" => 0,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => array()
        );
    }

    echo json_encode($json_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);