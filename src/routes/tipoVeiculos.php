<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/tipo-veiculos',function(){
    $this->get('', function($request, $response){

        $tipos = $this->db->table('tipo_veicullo')->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'tipos'=> $tipos
        ];

        $result['message'] = count($tipos) . " - Tipo de veiculos cadastrados";

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $tipo = $this->db->table('tipo_veicullo')->insert($data);

        if($tipo){
            $result['message'] = 'Tipo veiculo cadastrado com sucesso!';
            $result['tipo'] = $data;
        }else{
            $result['message'] = 'Não foi possivel cadastrar novo tipo!';
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

        $tipo = $this->db->table('tipo_veicullo')
        ->where('id_tipo_veiculo', $arg['id'])
        ->update($data);

        if($tipo){
            $result['message'] = 'Tipo veiculo alterado com sucesso!';
            $result['tipo'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar tipo veiculo!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $vendedor = $this->db->table('tipo_veicullo')
        ->where('id_tipo_veiculo', $arg['id'])
        ->delete($data);

        if($vendedor){
            $result['message'] = 'Tipo veiculo removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover tipo veiculo!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
