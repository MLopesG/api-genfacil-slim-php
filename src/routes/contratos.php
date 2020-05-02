<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/contratos',function(){
    $this->get('', function($request, $response){

        $contratos = $this->db->table('pagamento')
        ->join('contrato', 'contrato.id_contrato','=','pagamento.id_contrato')
        ->join('pacote', 'contrato.id_pacote','=','pacote.id_pacote')
        ->join('vendedor', 'contrato.id_vendedor','=','vendedor.id_vendedor')
        ->join('cliente', 'contrato.id_cliente','=','cliente.id_cliente')
        ->join('servico', 'contrato.id_servico','=','servico.id_servico')
        ->join('veiculo', 'veiculo.id_veiculo','=','contrato.id_veiculo')
        ->join('tipo_veicullo', 'tipo_veicullo.id_tipo_veiculo','=','veiculo.id_tipo_veiculo')
        ->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'contratos'=> $contratos
        ];

        $result['message'] = count($contratos) . " - Contratos fechados";

        return $response->withJson($result);
    });

    $this->get('/{id}', function($request, $response, $arg){

        $contrato = $this->db->table('pagamento')
        ->join('contrato', 'contrato.id_contrato','=','pagamento.id_contrato')
        ->join('pacote', 'contrato.id_pacote','=','pacote.id_pacote')
        ->join('vendedor', 'contrato.id_vendedor','=','vendedor.id_vendedor')
        ->join('cliente', 'contrato.id_cliente','=','cliente.id_cliente')
        ->join('servico', 'contrato.id_servico','=','servico.id_servico')
        ->join('veiculo', 'veiculo.id_veiculo','=','contrato.id_veiculo')
        ->join('tipo_veicullo', 'tipo_veicullo.id_tipo_veiculo','=','veiculo.id_tipo_veiculo')
        ->where('contrato.id_contrato', $arg['id'])
        ->get();

        $result = [
            'success'=> true,
            'message'=>''
        ];

        if(!isset($contrato[0]->id_contrato)){
            $result['message'] = 'Desculpe, contrato não encontrado!';
            $result['success'] = false;
        }else{
            $result['contrato'] = $contrato;
        }

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();
        $contrato = $this->db->table('contrato')->insertGetId($data);
 
        if($contrato > 0){
            $pagamento = $this->db->table('pagamento')->insert([
                "data_pagamento"=>  date('Y-m-d'),
                "id_contrato" => $contrato
            ]);

            if($pagamento){
                $result['message'] = 'Contrato cadastrado com sucesso!';
                $result['contrato'] = $data;
            }else{
                $result['message'] = 'Não foi possivel cadastrar contrato!';
                $result['success'] = false;
            }
        }else{
            $result['message'] = 'Não foi possivel cadastrar contrato!';
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

        $contrato = $this->db->table('contrato')
        ->where('id_contrato', $arg['id'])
        ->update($data);

        if($vendedor){
            $result['message'] = 'Contrato alterado com sucesso!';
            $result['contrato'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterar contrato!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $vendedor = $this->db->table('contrato')
        ->where('id_contrato', $arg['id'])
        ->delete($data);

        if($vendedor){
            $result['message'] = 'Contrato removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover contrato!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
