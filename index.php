<?php
    require "data.php";

    // Filter invoice data based on status using query string
    if (isset($_GET['status'])) {
      $invoices = array_filter($invoices, function ($invoice) {
      return $invoice['status'] === $_GET['status'];
      });
    }

    // If the add form was submitted, add the data to the invoice array
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
      array_push($invoices, [
        'number' => getInvoiceNumber(),
        'amount' => $_POST['amount'],
        'status' => $_POST['status'],
        'client' => $_POST['client'],
        'email' => $_POST['email']
      ]);

      // Update session array
      $_SESSION['invoices'] = $invoices;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice Manager</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <main class="p-5 container">
    
    <h1 class="display-3 mb-4">Invoices</h1>
    
    <nav class="nav nav-tabs justify-content-between mb-3">
      <div class="d-flex">
		    <a class="nav-link" href="index.php">All</a>
		    <a class="nav-link" href="index.php?status=draft">Draft</a>
        <a class="nav-link" href="index.php?status=pending">Pending</a>
        <a class="nav-link" href="index.php?status=paid">Paid</a>
      </div>
      <div class="text-end">
        <a class="nav-link" href="add.php">&plus;Add</a>
      </div>
	  </nav>
      
    <table class="table">
      <thead>
        <tr>
          <th>Account Number</th>
          <th>Client Name</th>
          <th>Client Email</th>
          <th>Invoice Amount</th>
          <th>Invoice Status</th>
        </tr>
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

  </main>
</body>
</html>