<?php 



if (isset($_POST['Cadastrar'])) {
    $erros = array();
    
    $nome = $_POST['nome'];
    $idade = $_POST['idade'];
    $Email = $_POST['Email'];
    $cpf = $_POST['cpf'];
    $cpf = preg_replace('/[^0-9]/', '', $cpf); // retirando ífens e pontos
   
    
    // --------- FUNÇÕES AUXILIARES ---------
    
    // Função para validar CPF existente:
    function cpfValido($cpf){
        $Repet_List = [9, 10];
        foreach ($Repet_List as $item){
            $soma = 0;
            $num_multiplicador = $item +1;
            
            for ($i = 0; $i <9; $i ++){
                $soma += $cpf[$i] * ($num_multiplicador--);
            }
            $resultado = (($soma * 10) % 11);

            if ($cpf[$item] != $resultado){
                return false;
            }
        }
    }

    

    // --------------------cuidado
    // $a = array(
    //     'idade' => array(
    //         'status' => true,
    //         'mensagem' => 'A idade precisa ser preenchida'
    //     ),
    //     'nome' => array(
    //         'status' => true,
    //         'mensagem' => 'O nome precisa ser preenchido'
    //     ),
    //     'email' => array(
    //         'status' => true,
    //         'mensagem' => 'O email precisa ser preenchido'
    //     )
    // );


    // --------- VALIDAÇÃO DE CAMPOS ---------

    // VALIDAÇÃO DO CAMPO NOME
    if ($nome == '' ){
        $erros[] = "O campo Nome precisa ser preenchido";
    }elseif(preg_match('/[^a-zA-Z\sÀ-ÖØ-öø-ÿ]/', $nome)){
        $erros[] = "O campo Nome deve conter somente letras e espaços";
    }

    // VALIDAÇÃO DO CAMPO IDADE
    if($idade == ''){
        // $a['idade']['status'] = true;
        // $a['idade']['mensagem'] = "O campo Idade precisa ser preenchido";
        $erros['idade'] = "O campo Idade precisa ser preenchido";
    }elseif(!$idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT)){
        $erros[] = "O Campo Idade precisa ser preenchido somente com Números inteiros";
    }elseif ($idade > 122){
        $erros[] = "Você deve declarar uma idade humanamente possível";
    }

    // VALIDAÇÃO DO CAMPO E-MAIL
    if($Email == ''){
        $erros[] = "O campo E-Mail precisa ser preenchido";
    }elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)){
        $erros[] = "O Campo E-Mail precisa ser preenchido com um E-mail válido";
    }

    // VALIDAÇÃO DE CAMPO CPF
    if($cpf == ''){
        $erros[] = "O campo CPF precisa ser preenchido";
    }elseif (strlen($cpf) != 11) {
        $erros[] = "O campo CPF deve possui 11 digitos";
    }elseif (!cpfValido($cpf)){
        $erros[] = "CPF inválido";
    }

    // VALIDAÇÃO DE GENERO
    if (!isset($_POST['genero'])){
        $erros[] = "O Genero precisa ser declarado";
    }else{
        $genero = $_POST['genero'];
    }

    
    
    header('Contente-Type: application/json');
    header('Access-Control-Allow-Origin:'); 
    // LIMITA QUEM PODE ACESSAR AS INFORMAÇÕES QUE SERÃO PASSADAS, 
    // SE NÃO FOR PASSADO NADA APÓS : SIGNIFICA QUE SOMENTE O SERVIDOR QUE ESTÁ SENDO EXECUTADO
    // TEM ACESSO AS INFORMAÇÕES

    // IMPORTANTE QUE O CABEÇALHO SEJA DEFINIDO ANTES DE ENVIAR QUAISQUER RESPOSTAS




    // --------- ENVIO DE ERROS ---------

    // if (!empty($erros)){
    //     foreach($erros as $erro){
    //         $resposta[] = $erro;
    //     }
    //     echo json_encode($resposta);
    // }else{
    //     //$resposta = "Formulário realizado com sucesso";
    //     //echo json_encode($resposta);

    //     $dados = array(
    //         'nome' => $nome,
    //         'idade'=> $idade,
    //         'Email' => $Email,
    //         'cpf' => $cpf,
    //         'genero' => $genero
    //     );

    //     $arquivo = 'dados.json';
    //     $data = json_decode(file_get_contents($arquivo), true);
    //     $data[] = $dados;
    //     file_put_contents($arquivo, json_encode($data));
    // }

}




$a = array(
    'idade' => array(
        'status' => true,
        'mensagem' => 'A idade precisa ser preenchida'
    ),
    'nome' => array(
        'status' => true,
        'mensagem' => 'O nome precisa ser preenchido'
    ),
    'email' => array(
        'status' => false,
        'mensagem' => 'O email precisa ser preenchido'
    )
);

echo json_encode($a);


?>