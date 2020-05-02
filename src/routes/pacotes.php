<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/pacotes',function(){
    $this->get('', function($request, $response){

        $pacotes = $this->db->table('pacote')->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'pacotes'=> $pacotes
        ];

        $result['message'] = count($pacotes) . " - Pacotes cadastrados";

        return $response->withJson($result);
    });

    $this->get('/{id}', function($request, $response, $arg){

        $pacote = $this->db->table('pacote')
        ->where('id_pacote',$arg['id'])
        ->get();

        $result = [
            'success'=> true,
            'message'=>''
        ];

        if(!isset($pacote[0]->id_pacote)){
            $result['message'] = 'Desculpe, pacote não encontrado!';
            $result['success'] = false;
        }else{
            $result['pacote'] = $pacote;
        }

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $pacote = $this->db->table('pacote')->insert($data);

        if($pacote){
            $result['message'] = 'Pacote cadastrado com sucesso!';
            $result['pacote'] = $data;
        }else{
            $result['message'] = 'Não foi possivel cadastrar pacote!';
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

        $pacote = $this->db->table('pacote')
        ->where('id_pacote', $arg['id'])
        ->update($data);

        if($pacote){
            $result['message'] = 'Pacote alterado com sucesso!';
            $result['pacote'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar pacote!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $pacote = $this->db->table('pacote')
        ->where('id_pacote', $arg['id'])
        ->delete($data);

        if($pacote){
            $result['message'] = 'Pacote removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover pacote!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
