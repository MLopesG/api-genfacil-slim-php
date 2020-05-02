<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/servicos',function(){
    $this->get('', function($request, $response){

        $servicos = $this->db->table('servico')->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'servicos'=> $servicos
        ];

        $result['message'] = count($servicos) . " - Serviços cadastrados";

        return $response->withJson($result);
    });

    $this->get('/{id}', function($request, $response, $arg){

        $servico = $this->db->table('servico')
        ->where('id_servico',$arg['id'])
        ->get();

        $result = [
            'success'=> true,
            'message'=>''
        ];

        if(!isset($servico[0]->id_servico)){
            $result['message'] = 'Desculpe, serviço não encontrado!';
            $result['success'] = false;
        }else{
            $result['servico'] = $servico;
        }

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $servico = $this->db->table('servico')->insert($data);

        if($servico){
            $result['message'] = 'Serviços cadastrado com sucesso!';
            $result['servico'] = $data;
        }else{
            $result['message'] = 'Não foi possivel cadastrar serviço!';
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

        $servico = $this->db->table('servico')
        ->where('id_servico', $arg['id'])
        ->update($data);

        if($vendedor){
            $result['message'] = 'Serviço alterado com sucesso!';
            $result['servico'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar serviço!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $serviço = $this->db->table('servico')
        ->where('id_servico', $arg['id'])
        ->delete($data);

        if($serviço){
            $result['message'] = 'Serviço removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover serviço!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
