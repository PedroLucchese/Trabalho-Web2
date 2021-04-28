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
      <a class="navbar-brand" href="index.html">Submarino</a>
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
            <a class="nav-link" href="cadastro_fornec.html">Cadastrar item</a>
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
            <section class="main">
                <h1>
                    <i class="fas fa-user"></i>
                    <br><span style = "margin-left: 50px">Fornecedores</span>
                </h1>
                <section>
                <form action="./fornecedores.php" method="POST">
                    <div>
                        <label style = "margin-left: 50px" for="txtBusca">Buscar:</label>
                        <input id="txtBusca" name="txtBusca" type="text">
                        <select id="tipoSel" name="tipoSel">
                            <option value="id">Id</option>
                            <option value="nome">Nome</option>
                        </select>
                        <button type="submit">Buscar</button>
                    </div>
                </form>
                </section>
                <section class="users">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Nome</th>
                                <th>Descricao</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                            
                            include_once "../fachada.php";

                            $dao = $factory->getFornecedorDao();
                            $fornecedor = null;

                            if (isset($_POST["txtBusca"]) && isset($_POST["tipoSel"]) && !empty(@$_POST["txtBusca"]) && !empty(@$_POST["tipoSel"]))
                            {
                                $busca = @$_POST["txtBusca"];
                                $tipoBusca = @$_POST["tipoSel"];
                            }
                            else
                            {
                                $fornecedor = $dao->buscaTodos();
                            }
                            
                            if (!empty($busca) && $tipoBusca == "id")
                            {
                                $fornecedor = $dao->buscaPorId($busca);
                                if ($fornecedor)
                                {
                                    $id = $fornecedor->Getid();
                                    
                                    echo "<tr>";
                                    echo "<td style='width: 5px; cursor: pointer'><a style='color: black' href='fornecedor_detalhe.php?id=$id'>Editar</a></td>";
                                    echo "<td style='width: 5px; cursor: pointer'><a style='color: black' href='../remove_fornecedor.php?id=$id'>Apagar</a></td>";
                                    echo "<td>" . $fornecedor->getNome() . "</td>";
                                    echo "<td>" . $fornecedor->getDescricao() . "</td>";
                                    echo "<td>" . $fornecedor->getEmail() . "</td>";
                                    echo "<td>" . $fornecedor->getTelefone() . "</td>";
                                    echo "</tr>";
                                }
                            }
                            else if (!empty($busca) && $tipoBusca == "nome")
                            {
                                $fornecedor = $dao->buscaPorNome($busca, false);
                            }

                            if ($fornecedor)
                            {
                                foreach ($fornecedor as $fornecedor)
                                {

                                    $id = $fornecedor->Getid();

                                    echo "<tr>";
                                    echo "<td style='width: 5px; cursor: pointer'><a style='color: black' href='fornecedor_detalhe.php?id=$id'>Editar</a></td>";
                                    echo "<td style='width: 5px; cursor: pointer'><a style='color: black' href='../remove_fornecedor.php?id=$id'>Apagar</a></td>";
                                    echo "<td>" . $fornecedor->getNome() . "</td>";
                                    echo "<td>" . $fornecedor->getDescricao() . "</td>";
                                    echo "<td>" . $fornecedor->getEmail() . "</td>";
                                    echo "<td>" . $fornecedor->getTelefone() . "</td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </section>
                
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