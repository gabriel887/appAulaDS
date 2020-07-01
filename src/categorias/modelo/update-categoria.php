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

        //$requestData = array_map('utf8_decode', $requestData);

        $idcategoria = $requestData['idcategoria'];
        $nome = $requestData['nome'];
        $ativo = $requestData['ativo'] == "on" ? "S" : "N";
        $datagora = date('Y-d-m H:i:s', strtotime($requestData['dataagora']));


        $sqlComando = "UPDATE categorias SET nome = '$nome', datamodificacao = $datagora, ativo = '$ativo' where idcategoria = $idcategoria ";

         $resultado = mysqli_query($conexao, $sqlComando);

         if($resultado && mysqli_num_rows($resultado) <0){
            $dados = array(
                'tipo' => TYPE_MSG_SUCCESS,
                'mensagem' => 'Categoria criada com sucesso.'
            );
         } else{
            $dados = array(
                'tipo' => TYPE_MSG_ERROR,
                'mensagem' => 'Não foi possível criar a categoria.'. mysqli_error($conexao)
            );
         }
    }

    mysqli_close($conexao);
}

echo json_encode($dados, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);