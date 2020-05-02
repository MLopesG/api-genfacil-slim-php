<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/manuntencoes',function(){
    $this->get('', function($request, $response){

        $manuntencoes = $this->db->table('manuntencao')
        ->join('veiculo', 'veiculo.id_veiculo','=','manuntencao.id_veiculo')
        ->join('tipo_veicullo', 'tipo_veicullo.id_tipo_veiculo','=','veiculo.id_tipo_veiculo')
        ->orderBy('id_manuntencao','desc')
        ->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'manuntencoes'=> $manuntencoes
        ];

        $result['message'] = count($manuntencoes) . " - Manuntenções em veiculos registradas!";

        return $response->withJson($result);
    });

    $this->get('/{id}', function($request, $response, $arg){

        $manuntencao = $this->db->table('manuntencao')
        ->join('veiculo', 'veiculo.id_veiculo','=','manuntencao.id_veiculo')
        ->join('tipo_veicullo', 'tipo_veicullo.id_tipo_veiculo','=','veiculo.id_tipo_veiculo')
        ->where('id_manuntencao', $arg['id'])
        ->get();

        $result = [
            'success'=> true,
            'message'=>''
        ];

        if(!isset($manuntencao[0]->id_manuntencao)){
            $result['message'] = 'Desculpe, manuntenção não encontrado!';
            $result['success'] = false;
        }else{
            $result['manuntencao'] = $manuntencao;
        }

        return $response->withJson($result);
    });

    $this->post('/registrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $manuntencao = $this->db->table('manuntencao')->insert($data);

        if($manuntencao){
            $result['message'] = 'Manuntenção registrada com sucesso!';
            $result['manuntencao'] = $data;
        }else{
            $result['message'] = 'Não foi possivel registrar manuntenção!';
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

        $manuntencao = $this->db->table('manuntencao')
        ->where('id_manuntencao', $arg['id'])
        ->update($data);

        if($manuntencao){
            $result['message'] = 'Manuntenção alterada com sucesso!';
            $result['manuntencao'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar manuntenção!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $manuntencao = $this->db->table('manuntencao')
        ->where('id_manuntencao', $arg['id'])
        ->delete($data);

        if($manuntencao){
            $result['message'] = 'Manuntenção removida com sucesso!';
            $result['manuntencao'] = $data;
        }else{
            $result['message'] = 'Não foi possivel remover manuntenção!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
