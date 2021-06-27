<?php

    $idProduto = $_GET['idProduto'];


?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/placeholder-loading/dist/css/placeholder-loading.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <label for="full-screen">
                <i class="fas fa-bars"></i>
            </label>
            <?php
			include "../verifica.php";
            include_once "usuario_logado.php";
            ?>
        </header>
        <main>
            <?php
                include_once "nav.php";
            ?>
            <section class="main">
                <h1>
                    <i class="fas fa-user-plus"></i>
                    <span>Informe a quantidade para o produto</span>
                </h1>
                    <div class="user">
                        <div class="cad_user">
                            <div class="info_user">
                            <?php
                                echo "<form action=\"../controller/gerencia_carrinho.php?acao=adicionar&id=$idProduto\" method=\"POST\">"
                            ?>
                                <div class="bxUser">
                                    <input type="number" name="qtdProduto" id="qtdProduto" placeholder="Quantidade de produto">
                                </div>
                                <div class="row" style="text-align: right">
                                    <button class="btn btn-success" type="submit">Adicionar ao carrinho</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
            </section>
        </main>
    </div>
</body>
</html>