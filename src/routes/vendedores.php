<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/vendedores',function(){
    $this->get('', function($request, $response){

        $vendedores = $this->db->table('vendedor')->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'vendedores'=> $vendedores
        ];

        $result['message'] = count($vendedores) . " - Vendedores cadastrados";

        return $response->withJson($result);
    });

    $this->get('/{id}', function($request, $response, $arg){

        $vendedor = $this->db->table('vendedor')
        ->where('id_vendedor',$arg['id'])
        ->get();

        $result = [
            'success'=> true,
            'message'=>''
        ];

        if(!isset($vendedor[0]->id_vendedor)){
            $result['message'] = 'Desculpe, vendedor não encontrado!';
            $result['success'] = false;
        }else{
            $result['vendedor'] = $vendedor;
        }

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $vendedor = $this->db->table('vendedor')->insert($data);

        if($vendedor){
            $result['message'] = 'Vendedor cadastrado com sucesso!';
            $result['vendedor'] = $data;
        }else{
            $result['message'] = 'Não foi possivel cadastrar vendedor!';
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

        $vendedor = $this->db->table('vendedor')
        ->where('id_vendedor', $arg['id'])
        ->update($data);

        if($vendedor){
            $result['message'] = 'Vendedor alterado com sucesso!';
            $result['vendedor'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar vendedor!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $vendedor = $this->db->table('vendedor')
        ->where('id_vendedor', $arg['id'])
        ->delete($data);

        if($vendedor){
            $result['message'] = 'Vendedor removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover vendedor!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
