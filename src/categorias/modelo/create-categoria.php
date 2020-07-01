<?php

include('../../banco/conexao.php');

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
        $datagora = date('Y-d-m H:i:s', strtotime($requestData['dataagora']));


        $sqlComando = "INSERT INTO categorias (nome, ativo, datacriacao, datamodificacao)
         VALUES ('$nome', '$ativo', '$datagora', '$datagora')";

         $resultado = mysqli_query($conexao, $sqlComando);

         if($resultado){
            $dados = array(
                'tipo' => TYPE_MSG_SUCCESS,
                'mensagem' => 'Categoria criada com sucesso.'
            );
         } else{
            $dados = array(
                'tipo' => TYPE_MSG_ERROR,
                'mensagem' => 'Não foi possível criar a categoria.'.mysqli_error($conexao)
            );
         }
    }

    mysqli_close($conexao);
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);