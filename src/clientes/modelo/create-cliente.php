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

    if(empty($requestData['nome']) || empty($requestData['ativo']) ){
        $dados = array(
            'tipo' => TYPE_MSG_INFO,
            'mensagem' => 'Existe(m) campo(s) obrigatório(s) vazio(s).'
        );
    } else {
        $nome = $requestData['nome'];
        $ativo = $requestData['ativo'] == "on" ? "S" : "N";
        $email = $requestData['email'];
        $telefone = $requestData['telefone'];
        $date = new DateTime();
        $datagora = $requestData['dataagora'] = $date->format('Y-m-d H:i:s');
        $cod = ['nome'=>$nome, 'email'=>$email, 'telefone'=>$telefone, 'ativo'=>$ativo, 'datacriacao'=>$datagora, 'datamodificacao'=>$datagora];
        $crud = Crud::getInstance($conexao, "clientes");
        $resultado = $crud->insert($cod);
         if($resultado){
            $dados = array(
                'tipo' => TYPE_MSG_SUCCESS,
                'mensagem' => 'cliente criada com sucesso.'
            );
         } else{
            $dados = array(
                'tipo' => TYPE_MSG_ERROR,
                'mensagem' => $resultado
            );
         }
    }
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);