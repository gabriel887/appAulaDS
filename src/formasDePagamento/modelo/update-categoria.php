<?php

include('../../banco/conexao.php');
require_once('../../class/Crud.class.php');
if(!$conexao){
    $dados = array(
        'tipo' => TYPE_MSG_INFO,
        'mensagem' => 'OPS, não foi possível obter uma conexão com o banco de dados, tente mais tarde..'
    );
} else{

    $requestData = $_REQUEST;
    $crud = Crud::getInstance($conexao, "categorias");
    if(empty($requestData['nome']) || empty($requestData['ativo']) ){
        $dados = array(
            'tipo' => TYPE_MSG_INFO,
            'mensagem' => 'Existe(m) campo(s) obrigatório(s) vazio(s).'
        );
    } else {

        $idcategoria = $requestData['idcategoria'];
        $nome = $requestData['nome'];
        $ativo = $requestData['ativo'] == "on" ? "S" : "N";
        $date = new DateTime();
        $datagora = $requestData['dataagora'] = $date->format('Y-m-d H:i:s');
        $cod = ['nome'=>$nome, 'ativo'=>$ativo, 'datamodificacao'=>$datagora];
        $cond = ['idcategoria='=> $idcategoria];


        $resultado = $crud->update($cod, $cond);

        if($resultado){
            $dados = array(
                'tipo' => TYPE_MSG_SUCCESS,
                'mensagem' => 'Categoria atualizada com sucesso.'
            );
        } else{
            $dados = array(
                'tipo' => TYPE_MSG_ERROR,
                'mensagem' => 'Não foi possível criar a categoria.'
            );
         }
    }

}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);