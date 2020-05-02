<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/veiculos',function(){
    $this->get('', function($request, $response){

        $veiculos = $this->db->table('veiculo')
        ->join('tipo_veicullo', 'tipo_veicullo.id_tipo_veiculo','=','veiculo.id_tipo_veiculo')
        ->join('empresa','empresa.id_empresa','=','veiculo.id_empresa')
        ->orderBy('id_veiculo','desc')
        ->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'veiculos'=> $veiculos
        ];

        $result['message'] = count($veiculos) . " - veiculos na frota";

        return $response->withJson($result);
    });

    $this->get('/{id}', function($request, $response, $arg){

        $veiculo = $this->db->table('veiculo')
        ->join('tipo_veicullo', 'tipo_veicullo.id_tipo_veiculo','=','veiculo.id_tipo_veiculo')
        ->join('empresa','empresa.id_empresa','=','veiculo.id_empresa')
        ->where('id_veiculo',$arg['id'])
        ->get();

        $manuntencoes = $this->db->table('manuntencao')->where('id_veiculo',$arg['id'])->get();

        $contratos = $this->db->table('pagamento')
        ->join('contrato', 'contrato.id_contrato','=','pagamento.id_contrato')
        ->join('pacote', 'contrato.id_pacote','=','pacote.id_pacote')
        ->join('vendedor', 'contrato.id_vendedor','=','vendedor.id_vendedor')
        ->join('cliente', 'contrato.id_cliente','=','cliente.id_cliente')
        ->join('servico', 'contrato.id_servico','=','servico.id_servico')
        ->join('veiculo', 'veiculo.id_veiculo','=','contrato.id_veiculo')
        ->join('tipo_veicullo', 'tipo_veicullo.id_tipo_veiculo','=','veiculo.id_tipo_veiculo')
        ->where('veiculo.id_veiculo',$arg['id'])
        ->get();

        $result = [
            'success'=> true,
            'message'=>''
        ];

        if(!isset($veiculo[0]->id_veiculo)){
            $result['message'] = 'Desculpe, veiculo não encontrado!';
            $result['success'] = false;
        }else{
            $result['message'] = count($contratos) . ' - Contratos fechados, ' .count($manuntencoes) . ' - Manuntenções realizadas';
            $result['veiculo'] = $veiculo;
            $result['manuntencoes'] = $manuntencoes;
            $result['contratos'] = $contratos;
        }

        return $response->withJson($result);
    });

    $this->post('/cadastrar', function($request, $response){
        $result = [
            'success'=> false,
            'message'=>'',
        ];

        $data = $request->getParsedBody();

        $veiculo = $this->db->table('veiculo')->insert($data);

        if($veiculo){
            $result['message'] = 'Veiculo cadastrado com sucesso!';
            $result['veiculo'] = $data;
        }else{
            $result['message'] = 'Não foi possivel cadastrar veiculo!';
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

        $veiculo = $this->db->table('veiculo')
        ->where('id_veiculo', $arg['id'])
        ->update($data);

        if($veiculo){
            $result['message'] = 'Veiculo alterado com sucesso!';
            $result['veiculo'] = $data;
        }else{
            $result['message'] = 'Não foi possivel alterado veiculo!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });

    $this->post('/deletar/{id}', function($request, $response, $arg){
        $result = [
            'success'=> false,
            'message'=>'',
        ];
 
        $veiculo = $this->db->table('veiculo')
        ->where('id_veiculo', $arg['id'])
        ->delete($data);

        if($veiculo){
            $result['message'] = 'Veiculo removido com sucesso!';
        }else{
            $result['message'] = 'Não foi possivel remover veiculo!';
            $result['success'] = false;
        }
        return $response->withJson($result);
    });
});
