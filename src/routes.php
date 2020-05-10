<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {    
    require __DIR__ .'/routes/veiculos.php';
    require __DIR__ .'/routes/manuntencoes.php'; 
    require __DIR__ .'/routes/vendedores.php'; 
    require __DIR__ .'/routes/tipoVeiculos.php'; 
    require __DIR__ .'/routes/servicos.php'; 
    require __DIR__ .'/routes/pacotes.php'; 
    require __DIR__ .'/routes/empresas.php'; 
    require __DIR__ .'/routes/cidades.php'; 
    require __DIR__ .'/routes/contratos.php'; 
    require __DIR__ .'/routes/clientes.php'; 
    require __DIR__ .'/routes/index.php'; 
};


