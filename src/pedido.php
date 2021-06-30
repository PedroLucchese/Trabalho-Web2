<?php

// Métodos de acesso ao banco de dados 
require "fachada.php"; 
$dao = $factory->getPedidoDao();

$request_method=$_SERVER["REQUEST_METHOD"];

if(!empty($_GET['id']))
    {
        $numeroPedido=intval($_GET["id"]);
        $pedidoJSON = $dao->buscaPedidoJSON($numeroPedido);
        if($pedidoJSON!=null) {
            echo $pedidoJSON;
            var_dump(http_response_code(200)); // 200 OK
        } else {
            var_dump(http_response_code(404)); // 404 Not Found
        }
    } 
    else
    {
        echo $dao->buscaPedidosJSON();
        var_dump(http_response_code(200));// 200 OK
    }

?>