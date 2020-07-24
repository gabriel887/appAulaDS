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
    $crud = Crud::getInstance($conexao, "clientes");
    if(empty($requestData['nome']) || empty($requestData['ativo']) || empty($requestData['email']) || empty($requestData['telefone']) ){
        $dados = array(
            'tipo' => TYPE_MSG_INFO,
            'mensagem' => 'Existe(m) campo(s) obrigatório(s) vazio(s).'
        );
    } else {

        $idcliente = $requestData['idcliente'];
        $nome = $requestData['nome'];
        $email = $requestData['email'];
        $telefone = $requestData['telefone'];
        $ativo = $requestData['ativo'] == "on" ? "S" : "N";
        $date = new DateTime();
        $datagora = $requestData['dataagora'] = $date->format('Y-m-d H:i:s');
        $cod = ['nome'=>$nome, 'email'=>$email, 'telefone'=>$telefone, 'ativo'=>$ativo, 'datamodificacao'=>$datagora];
        $cond = ['idcliente='=> $idcliente];


        $resultado = $crud->update($cod, $cond);

        if($resultado){
            $dados = array(
                'tipo' => TYPE_MSG_SUCCESS,
                'mensagem' => 'cliente atualizada com sucesso.'
            );
        } else{
            $dados = array(
                'tipo' => TYPE_MSG_ERROR,
                'mensagem' => 'Não foi possível criar a cliente.'
            );
         }
    }

}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);