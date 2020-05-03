<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/',function(){
    $this->get('', function($request, $response){

        $vendedores = $this->db->table('vendedor')->get();

        $result = [
            'success'=> true,
            'message'=>'',
            'painel'=> [
                "counts" => [
                    "contratos" =>( $this->db->table('contrato')->count()),
                    "manuntencos" => $this->db->table('manuntencao')->count(),
                    "clientes" => $this->db->table('cliente')->count(),
                    "servicos" => $this->db->table('servico')->count()
                ],
                "data"=>[
                    "contratos" => $this->db->table('pagamento')
                    ->join('contrato', 'contrato.id_contrato','=','pagamento.id_contrato')
                    ->join('vendedor', 'contrato.id_vendedor','=','vendedor.id_vendedor')
                    ->join('cliente', 'contrato.id_cliente','=','cliente.id_cliente')
                    ->get(),
                    "manuntencos" => $this->db->table('manuntencao')->orderBy('id_manuntencao','desc')
                    ->join('veiculo','veiculo.id_veiculo','=','manuntencao.id_veiculo')
                    ->limit(5)->get(),
                    "clientes" => $this->db->table('cliente')->orderBy('id_cliente','desc')->limit(5)->get(),
                    "servicos" => $this->db->table('servico')->orderBy('id_servico','desc')->limit(5)->get(),
                    "veiculos" => $this->db->table('veiculo')->limit(3)->get()
                ]
            ]
        ];

        $result['message'] = "Painel Administrativos, últimas atualizações de informações(Contratos, Manuntenções, Clientes e Serviços).";

        return $response->withJson($result);
    });
});
