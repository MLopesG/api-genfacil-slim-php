<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/cidades',function(){
    $this->get('', function($request, $response){

        $cidades = $this->db->table('cidade')->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'cidades'=> $cidades
        ];

        $result['message'] = count($cidades) . " - Cidades cadastradas";

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $cidade = $this->db->table('cidade')->insert($data);

        if($cidade){
            $result['message'] = 'Cidade cadastrado com sucesso!';
            $result['cidade'] = $data;
        }else{
            $result['message'] = 'Não foi possivel cadastrar cidade!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/alterar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $cidade = $this->db->table('cidade')
        ->where('id_cidade', $arg['id'])
        ->update($data);

        if($cidade){
            $result['message'] = 'Cidade alterado com sucesso!';
            $result['cidade'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar cidade!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $cidade = $this->db->table('cidade')
        ->where('id_cidade', $arg['id'])
        ->delete($data);

        if($cidade){
            $result['message'] = 'Cidade removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover cidade!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
