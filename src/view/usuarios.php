<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home</title>

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
            <a class="nav-link" href="cadastro_conta.html">Contas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro_prod.php">Cadastrar Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cadastro_fornec.html">Cadastrar Fornecedores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="manut_estoque.html">Consulta e manutenção</a>
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

  <section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 order-lg-1">
          <div class="p-5">
            <h2 class="display-4">Usuários</h2>
          </div>
          <form action="./usuarios.php" method="POST">
            <div class="form-group">
                <label for="txtBusca">Buscar:</label>
                <input type="text" class="form-control form-control-user" id="txtBusca" name="txtBusca">
            </div>
            <div class="form-group">
                <select class="form-control form-control-user" id="tipoSel" name="tipoSel">
                  <option value="id">Id</option>
                  <option value="nome">Nome</option>
                </select>
            </div>
            <div class="text-center form-group" style="margin-left: -60px;">
                <button style="margin-left:47px" type="submit" class="btn btn-primary">Buscar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="row">
          <table class="table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                </tr>
            </thead>
            <tbody>
            <?php

                include_once "../fachada.php";

                $dao = $factory->getUsuarioDao();
                $usuarios = null;

                if (isset($_POST["txtBusca"]) && isset($_POST["tipoSel"]) && !empty(@$_POST["txtBusca"]) && !empty(@$_POST["tipoSel"]))
                {
                    $busca = @$_POST["txtBusca"];
                    $tipoBusca = @$_POST["tipoSel"];
                }
                else
                {
                    $usuarios = $dao->buscaTodos();
                }

                if (!empty($busca) && $tipoBusca == "id")
                {
                    $usuario = $dao->buscaPorId($busca);
                    if ($usuario)
                    {
                        $usuarioId = $usuario->getId();

                        echo "<tr>";
                        echo "<td style='width: 5px; cursor: pointer'><a style='color: black' href='usuario_detalhe.php?id=$usuarioId'>Editar</a></td>";
                        echo "<td style='width: 5px; cursor: pointer'><a style='color: black' href='../remove_usuario.php?id=$usuarioId'>Apagar</a></td>";
                        echo "<td>" . $usuario->getNome() . "</td>";
                        echo "<td>" . $usuario->getEmail() . "</td>";
                        echo "<td>" . $usuario->getTelefone() . "</td>";
                        echo "</tr>";
                    }
                }
                else if (!empty($busca) && $tipoBusca == "nome")
                {
                    $usuarios = $dao->buscaPorNome($busca, false);
                }

                if ($usuarios)
                {
                    foreach ($usuarios as $usuario)
                    {

                        $usuarioId = $usuario->getId();

                        echo "<tr>";
                        echo "<td style='width: 5px; cursor: pointer'><a style='color: black' href='usuario_detalhe.php?id=$usuarioId'>Editar</a></td>";
                        echo "<td style='width: 5px; cursor: pointer'><a style='color: black' href='../remove_usuario.php?id=$usuarioId'>Apagar</a></td><br></br>";
                        echo "<td>" . $usuario->getNome() . "</td>";
                        echo "<td>" . $usuario->getEmail() . "</td>";
                        echo "<td>" . $usuario->getTelefone() . "</td>";
                        echo "</tr>";
                    }
                          }
                      ?>
            </tbody>
          </table>
        </div>   
      </div>
    </div>        
  </section>
    
    
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