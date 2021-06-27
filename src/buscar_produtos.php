<?php

include_once "../fachada.php";

$dao = $factory->getProdutoDao();
$quantidade_registros = 0;
$produtos_buscados = null;

$limit = '9';
$page = 1;
if($_POST['page'] > 1)
{
  $start = (($_POST['page'] - 1) * $limit);
  $page = $_POST['page'];
}
else
{
  $start = 0;
}

if($_POST['query'] == '')
{
  $produtos_buscados = $dao->buscaTodos($limit, $start);
  $quantidade_total_registros_encontrados = $dao->buscaQtdProdutos();
}
else
{
  $produtos_buscados = $dao->buscaPorNome($_POST['query'], $limit, $start);
  $quantidade_total_registros_encontrados = $dao->buscaQtdProdutosComWhere($_POST['query']);
}

$output = '
<label>Quantidade de Registros - '.$quantidade_total_registros_encontrados.'</label>
<table class="table table-striped table-bordered">
  <tr>
    <th>Adicionar Produto</th>
    <th>NOME</th>
    <th>DESCRICAO</th>
    <th>FOTO</th>
  </tr>
';
if($quantidade_total_registros_encontrados > 0)
{
  foreach($produtos_buscados as $row)
  {
    $output .= '
    <tr>
      <td><a href='.'./informa_quantidade.php?idProduto='.$row->getId().'><span>Adicionar</span></a></td>
      <td>'.$row->getNome().'</td>
      <td>'.$row->getDescricao().'</td>
      <td><a href='.'./informa_quantidade.php?idProduto='.$row->getId().'><img src=.'.$row->getFoto().'></a></img></td>
    </tr>
    ';
  }
}
else
{
  $output .= '
  <tr>
    <td colspan="2" align="center">Nenhum nome encontrado</td>
  </tr>
  ';
}

$output .= '
</table>
<br />
<div align="center">
  <ul class="pagination">
';

$total_links = ceil($quantidade_total_registros_encontrados/$limit);
$previous_link = '';
$next_link = '';
$page_link = '';
$page_array = [];

if($total_links > 4)
{
  if($page < 5)
  {
    for($count = 1; $count <= 5; $count++)
    {
      $page_array[] = $count;
    }
    $page_array[] = '...';
    $page_array[] = $total_links;
  }
  else
  {
    $end_limit = $total_links - 5;
    if($page > $end_limit)
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $end_limit; $count <= $total_links; $count++)
      {
        $page_array[] = $count;
      }
    }
    else
    {
      $page_array[] = 1;
      $page_array[] = '...';
      for($count = $page - 1; $count <= $page + 1; $count++)
      {
        $page_array[] = $count;
      }
      $page_array[] = '...';
      $page_array[] = $total_links;
    }
  }
}
else
{
  for($count = 1; $count <= $total_links; $count++)
  {
    $page_array[] = $count;
  }
}

for($count = 0; $count < count($page_array); $count++)
{
  if($page == $page_array[$count])
  {
    $page_link .= '
    <li class="page-item active">
      <a class="page-link" href="#">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
    </li>
    ';

    $previous_id = $page_array[$count] - 1;
    if($previous_id > 0)
    {
      $previous_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$previous_id.'">Anterior</a></li>';
    }
    else
    {
      $previous_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Anterior</a>
      </li>
      ';
    }
    $next_id = $page_array[$count] + 1;
    if($next_id >= $total_links)
    {
      $next_link = '
      <li class="page-item disabled">
        <a class="page-link" href="#">Próximo</a>
      </li>
        ';
    }
    else
    {
      $next_link = '<li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
    }
  }
  else
  {
    if($page_array[$count] == '...')
    {
      $page_link .= '
      <li class="page-item disabled">
          <a class="page-link" href="#">...</a>
      </li>
      ';
    }
    else
    {
      $page_link .= '
      <li class="page-item"><a class="page-link" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
      ';
    }
  }
}

$output .= $previous_link . $page_link . $next_link;
$output .= '
  </ul>

</div>
';

echo $output;

?>

