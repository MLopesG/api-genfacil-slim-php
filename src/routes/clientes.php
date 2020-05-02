<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/clientes',function(){
    $this->get('', function($request, $response){

        $clientes = $this->db->table('cliente')->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'clientes'=> $clientes
        ];

        $result['message'] = count($clientes) . " - Clientes cadastrados";

        return $response->withJson($result);
    });

    $this->get('/{id}', function($request, $response, $arg){

        $cliente = $this->db->table('cliente')
        ->where('id_cliente',$arg['id'])
        ->get();

        $result = [
            'success'=> true,
            'message'=>''
        ];

        if(!isset($cliente[0]->id_cliente)){
            $result['message'] = 'Desculpe, cliente não encontrado!';
            $result['success'] = false;
        }else{
            $result['cliente'] = $cliente;
        }

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $cliente = $this->db->table('cliente')->insert($data);

        if($cliente){
            $result['message'] = 'Cliente cadastrado com sucesso!';
            $result['cliente'] = $data;
        }else{
            $result['message'] = 'Não foi possivel cadastrar cliente!';
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

        $cliente = $this->db->table('cliente')
        ->where('id_cliente', $arg['id'])
        ->update($data);

        if($cliente){
            $result['message'] = 'Cliente alterado com sucesso!';
            $result['cliente'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar cliente!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $cliente = $this->db->table('cliente')
        ->where('id_cliente', $arg['id'])
        ->delete($data);

        if($cliente){
            $result['message'] = 'Cliente removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover cliente!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
