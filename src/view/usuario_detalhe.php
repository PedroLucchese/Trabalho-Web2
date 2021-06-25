<?php
    include "../fachada.php";

    $usuarioId = $_GET['id'];
    $dao = $factory->getUsuarioDao();
    try
    {
        $usuario = $dao->buscaPorId($usuarioId);
    }
    catch (Exception $e)
    {
    echo "<script>alert('Houve um problema ao buscar as informações deste usuário!\n Erro: $e')</script>";
    }
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Usuário</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/one-page-wonder.min.css" rel="stylesheet">

</head>
<body> 
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">Submarino</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
          <li class="nav-item">
            <a class="nav-link" href="login.html">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro_conta.php">Contas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro_prod.php">Cadastrar Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro_fornec.php">Cadastrar Fornecedores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manut_estoque.php">Consulta e manutenção</a>
          </li>
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                <span class="">Usuário Admin</span>
                <img style="height: 30px;" class="img-profile rounded-circle"src="img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"> 
                    Sair <!-- Habilitar Logout aqui -->
                </a>
            </div>
          </li>
        </ul>

        
      </div>
    </div>
  </nav>
  <header class="masthead text-center text-white">
    <div class="masthead-content">
      <div class="container">
        <h1 class="masthead-heading mb-0">Submarino</h1>
      </div>
    </div>
    <div class="bg-circle-1 bg-circle"></div>
    <div class="bg-circle-2 bg-circle"></div>
    <div class="bg-circle-3 bg-circle"></div>
    <div class="bg-circle-4 bg-circle"></div>
  </header>
            <section class="main">
                <h1>
                    <i class="fas fa-user-plus"></i>
                    <span>Usuário</span>
                </h1>
                <form action="../altera_usuario.php?id=<?php echo $usuarioId; ?>" method="POST" role="form">
                    <div class="user">
                        <div class="cad_user">
                            <div class="info_user">
                            <div class="ClassHtml">
                                    <input type="text" name="nome" id="nome" placeholder="Nome" value='<?php echo $usuario->getNome() ?>'>
                                </div>
                                <div class="ClassHtml">
                                    <input type="text" name="telefone" id="telefone" placeholder="Telefone" value='<?php echo $usuario->getTelefone() ?>'>
                                </div>
                                <div class="ClassHtml">
                                    <input type="text" name="email" id="email" placeholder="Email" value='<?php echo $usuario->getEmail() ?>'>
                                </div>
                                <div class="ClassHtml">
                                    <input type="text" name="cartaoCredito" id="cartaoCredito" placeholder="Cartão de crédito" value='<?php echo $usuario->getNumCartao() ?>'>
                                </div>
                                <div class="ClassHtml">
                                    <input type="password" name="senha" id="senha" placeholder="Senha" value='<?php echo $usuario->getSenha() ?>'>
                                </div>
                                <div class="ClassHtmls" style="padding-top: 10px">
                                    <button style="background-color: red" type="button" onclick="document.location.href='../remove_usuario.php?id=<?php echo $usuarioId; ?>'">Excluir</button>
                                    <button type="submit">Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </main>
        
    </div>
    <!-- Footer -->
    <footer class="py-5 bg-black">
        <div class="container">
        <p class="m-0 text-center text-white small">Copyright &copy; Submarino 2021</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./js/script.js"></script>
    
</body>
</html>