<?php
  require "data.php";
  require "functions.php";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $updated = sanitize($_POST);
    $errors = validate($updated);

    // Update an invoice
    if (count($errors) == 0) {
      $invoices = array_map(function ($invoice) use ($updated) {
        if ($invoice['number'] == $updated['number']) {
          var_dump($updated);
          return $updated;
        }
        return $invoice;
      }, $invoices);

      $_SESSION['invoices'] = $invoices;

      header("Location: index.php");
    }
  }

  // Show the correct invoice using query string
  if (isset($_GET['number'])) {
    $invoice = current(array_filter($invoices, function ($invoice) {
      return $invoice['number'] == $_GET['number'];
    }));

    if (!$invoice) {
      header("Location: index.php");
    }
  } else {
    header("Location: index.php");
    exit();
  }

  // Array of possible statuses (not including all)
  $possStatus = ['draft', 'pending', 'paid'];

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
  <main class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <h1 class="display-4 text-center mb-3 p-5">Update Invoice</h1>

        <!-- Display Errors -->
        <?php if (isset($errors) && count($errors)) : ?>
          <div class="alert alert-danger mt-3">
            <ul>
              <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
              <?php endforeach; ?>  
            </ul>
            </div>
        <?php endif; ?>
                
        <form method="post" class="bg-light border border-1 p-4">

          <input type="hidden" name="number" value="<?php echo $invoice['number'] ?>"/>

          <div class="form-group mb-3">
            <label class="form-label" for="client">Client Name</label>
            <input class="form-control" id="client" name="client" required value="<?php echo $invoice['client']; ?>">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" for="email">Client Email</label>
            <input class="form-control" type="email" id="email" name="email" required value="<?php echo $invoice['email']; ?>">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" for="amount">Invoice Amount</label>
            <input class="form-control" id="amount" name="amount" required value="<?php echo $invoice['amount']; ?>">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" for="status">Invoice Status</label>
            <select class="form-select" id="status" name="status" required>
              <option value="">Select a Status</option>
              <?php foreach ($possStatus as $status) : ?>
                <option
                  value="<?php echo $status; ?>"
                  <?php if ($status == $invoice['status']) : ?> selected <?php endif; ?> >
                  <?php echo ucfirst($status); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Update Invoice</button>
          <a class="btn btn-secondary" href="index.php">Cancel</a>
        </form>

      </div>
    </div>
  </main>
</body>
</html>