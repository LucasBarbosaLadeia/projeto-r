<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

$products = fetch_products($conn);
$products = organize_into_array($products);

$filterMin = 0;
$results = $products;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filterMin = isset($_POST['minprice']) ? floatval($_POST['minprice']) : 0;
    // validação simples
    if ($filterMin < 0) {
        $error = 'Preço mínimo não pode ser negativo.';
        $results = [];
    } else {
        $results = search_products($products, $filterMin);
    }
}

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalogo - Exemplo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Minha Loja</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link active" href="#">Produtos</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Filtrar Produtos</h5>
          <form method="post">
            <div class="mb-3">
              <label class="form-label">Preço mínimo</label>
              <input name="minprice" type="number" step="0.01" class="form-control" value="<?php echo htmlspecialchars($filterMin); ?>">
            </div>
            <button class="btn btn-primary" type="submit">Aplicar</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-md-8">
      <h3>Lista de Produtos</h3>
      <?php if (!validate_products_array($products)): ?>
        <div class="alert alert-warning">Nenhum produto válido encontrado.</div>
      <?php else: ?>
        <?php if (isset($error)): ?>
          <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Preço com desconto (10%)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($results as $row): ?>
              <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td>R$ <?php echo number_format($row['price'],2,',','.'); ?></td>
                <td>R$ <?php echo number_format(calculate_discount((float)$row['price'], 10),2,',','.'); ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
