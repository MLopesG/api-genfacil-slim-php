<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {    
    $app->add(function ($req, $res, $next) {
        $response = $next($req, $res);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    require __DIR__ .'/routes/veiculos.php';
    require __DIR__ .'/routes/manuntencoes.php'; 
    require __DIR__ .'/routes/vendedores.php'; 
    require __DIR__ .'/routes/tipoVeiculos.php'; 
    require __DIR__ .'/routes/servicos.php'; 
    require __DIR__ .'/routes/pacotes.php'; 
    require __DIR__ .'/routes/empresas.php'; 
    require __DIR__ .'/routes/cidades.php'; 
    require __DIR__ .'/routes/contratos.php'; 
    require __DIR__ .'/routes/index.php'; 
};


