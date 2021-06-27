<!DOCTYPE html>
<html lang="en">
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
			include "../controller/verifica.php";
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
                    <span>Produtos</span>
                </h1>
                    <div class="user">
                        <div class="cad_user">
                            <div class="info_user">
                                <div class="bxUser">
                                    <input type="text" name="nome" id="nome" placeholder="Digite o produto que você está buscando">
                                </div>
                                <div class="table-responsive" id="dynamic_content">
            
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
        </main>
        
    </div>
    <div class="sairMain">
        <div class="sair">
            <p>deseja sair ?</p>
            <button>Sair</button>
            <button>Cancelar</button>
        </div>
    </div>
    <script src="../../js/script.js"></script>
</body>
</html>
<script>
  $(document).ready(function(){

    load_data(1);

    function load_data(page, query = '')
    {
      $.ajax({
        url:"../controller/busca_produtos.php",
        method:"POST",
        data:{page:page, query:query},
        success:function(data)
        {
          $('#dynamic_content').html(data);
        }
      });
    }

    $(document).on('click', '.page-link', function(){
      var page = $(this).data('page_number');
      var query = $('#nome').val();
      load_data(page, query);
    });

    $('#nome').keyup(function(){
      var query = $('#nome').val();
      load_data(1, query);
    });

  });
</script>