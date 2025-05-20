<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice Manager</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>
  <div class="p-5 container">
    <h1 class="display-3 mb-4">Invoices</h1>
    <div>
      <!--Navbar-->
      <div class="mb-3">
        <ul class="nav nav-tabs">
          <?php foreach ($statuses as $status) : ?>
            <li class="nav-item">
              <?php if ($status == 'all' && $page != 'all') : ?>
                <a class="nav-link" href="/invoice-manager-Chrissy-Ann/index.php"><?php echo ucfirst($status) ?></a>
              <?php elseif ($status == 'all' && $page == 'all') : ?>
                <a class="nav-link active" href="/invoice-manager-Chrissy-Ann/index.php"><?php echo ucfirst($status) ?></a>
              <?php elseif ($page == $status) : ?>
                <a class="nav-link active" href="<?php echo "/invoice-manager-Chrissy-Ann/{$status}.php"?>"><?php echo ucfirst($status) ?></a>
              <?php else : ?>
                <a class="nav-link" href="<?php echo "/invoice-manager-Chrissy-Ann/{$status}.php"?>"><?php echo ucfirst($status) ?></a>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <!--Table-->
      <div>
        <table class="table">
          <thead>
            <div class="row">
            <tr>
              <th class="col-2">Account Number</th>
              <th class="col-3">Client Name</th>
              <th class="col-3">Email Address</th>
              <th class="col-2">Amount</th>
              <th class="col-2">Status</th>
            </tr>
            </div>
          </thead>
          <tbody>
            <?php foreach ($invoices as $invoice) : ?>
              <tr>
                <td><?php echo "#{$invoice['number']}" ?></td>
                <td><?php echo $invoice['client'] ?></td>
                <td><?php echo $invoice['email'] ?></td>
                <td><?php echo "$ {$invoice['amount']}.00" ?></td>
                <?php if ($invoice['status'] == 'paid'): ?>
                  <td class="table-success">Paid</td>
                <?php elseif ($invoice['status'] == 'pending'): ?>
                  <td class="table-warning">Pending</td>
                <?php else : ?>
                  <td class="table-secondary">Draft</td>
                <?php endif; ?>
              </tr>
              <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>