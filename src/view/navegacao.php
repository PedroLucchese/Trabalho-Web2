<!-- Navigation -->
<?php
include_once "../verifica_adm.php";

//Navigation
echo"<nav class=\"navbar navbar-expand-lg navbar-dark navbar-custom fixed-top\">";
  echo"<div class=\"container\">";
    echo"<a class=\"navbar-brand\" href=\"index.php\">Submarino</a>";
    echo"<button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">";
      echo"<span class=\"navbar-toggler-icon\"></span>";
    echo"</button>";
    echo"<div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">";
      echo"<ul class=\"navbar-nav ml-auto\">";
        echo"<li class=\"nav-item\">";
          echo"<li class=\"nav-item\">";
            echo"<a class=\"nav-link\" href=\"login.html\">Login</a>";
          echo"</li>";

            if($_SESSION["permissao"] == 2){

                echo"<li class=\"nav-item\">";
                echo"<a class=\"nav-link\" href=\"cadastro_conta.php\">Contas</a>";
                echo"</li>";
                echo"<li class=\"nav-item\">";
                echo"<a class=\"nav-link\" href=\"cadastro_prod.php\">Cadastrar Produtos</a>";
                echo"</li>";
                echo"<li class=\"nav-item\">";
                echo"<a class=\"nav-link\" href=\"cadastro_fornec.php\">Cadastrar Fornecedores</a>";
                echo"</li>";
                echo"<li class=\"nav-item\">";
                echo"<a class=\"nav-link\" href=\"manut_estoque.php\">Consulta e manutenção</a>";
                echo"</li>";
                echo"<li class=\"nav-item dropdown no-arrow\">";
                echo"<a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"userDropdown\" role=\"button\" data-toggle=\"dropdown\">";
                echo"<span>Usuário Admin</span>";
                echo"<img style=\"height: 30px;\" class=\"img-profile rounded-circle\"src=\"img/undraw_profile.svg\">";
                echo"</a>";
                echo"</li>";
            }
          echo"</ul>";
          $usuario_logado = $_SESSION["NOME"];
          echo $usuario_logado;
          echo"<form id=\"form_logout\" action=\"../executa_logout.php\" method=\"POST\" role=\"form\">";
                echo"<a href=\"javascript:$('#form_logout').submit();\" class=\"btn btn-primary btn-user btn-block\">Deslogar</a>";
          echo"</form> ";
    echo"</div>";
  echo"</div>";
echo"</nav>";

?>
