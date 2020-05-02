<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/empresas',function(){
    $this->get('', function($request, $response){

        $empresas = $this->db->table('empresa')
        ->join('cidade','empresa.id_cidade','=','cidade.id_cidade')
        ->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'empresas'=> $empresas
        ];

        $result['message'] = count($empresas) . " - Empresas cadastrados";

        return $response->withJson($result);
    });

    $this->get('/{id}', function($request, $response, $arg){

        $empresa = $this->db->table('empresa')
        ->join('cidade','empresa.id_cidade','=','cidade.id_cidade')
        ->where('id_empresa', $arg['id'])
        ->get();


        $result = [
            'success'=> true,
            'message'=>''
        ];

        if(!isset($empresa[0]->id_empresa)){
            $result['message'] = 'Desculpe, empresa não encontrado!';
            $result['success'] = false;
        }else{
            $result['empresa'] = $empresa;
        }

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $empresa = $this->db->table('empresa')->insert($data);

        if($empresa){
            $result['message'] = 'Empresa cadastrado com sucesso!';
            $result['empresa'] = $data;
        }else{
            $result['message'] = 'Não foi possivel cadastrar empresa!';
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

        $empresa = $this->db->table('empresa')
        ->where('id_empresa', $arg['id'])
        ->update($data);

        if($empresa){
            $result['message'] = 'Empresa alterado com sucesso!';
            $result['empresa'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar empresa!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $empresa = $this->db->table('empresa')
        ->where('id_empresa', $arg['id'])
        ->delete($data);

        if($empresa){
            $result['message'] = 'Empresa removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover empresa!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
