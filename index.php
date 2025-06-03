<?php
    require "data.php";

    // Filter invoice data based on status using query string
    if (isset($_GET['status'])) {
      $invoices = array_filter($invoices, function ($invoice) {
      return $invoice['status'] === $_GET['status'];
      });
    }

    // Delete
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $index = array_find_key($invoices, function ($invoice) {
        return $invoice['number'] == $_POST['number'];
      });

      unset($invoices[$index]);

      $_SESSION['invoices'] = $invoices;
      header("Location: index.php");
      exit();
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
      
    <table class="table align-middle">
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
              <td class="table-success text-center">Paid</td>
            <?php elseif ($invoice['status'] == 'pending'): ?>
              <td class="table-warning text-center">Pending</td>
            <?php else : ?>
              <td class="table-secondary text-center">Draft</td>
            <?php endif; ?>
            <td><a href="update.php?number=<?php echo $invoice['number'] ?>" class="btn btn-link">Edit</a></td>
            <td>
              <form method="post">
                <input type="hidden" name="number" value="<?php echo $invoice['number']; ?>"/>
                <button type="submit" class="text-danger btn btn-link">Delete</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </main>
</body>
</html>