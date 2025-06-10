<?php
  require "data.php";
  require "functions.php";

  if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Sanitize and validate
    $errors = [];
    $invoice = sanitize($_POST);
    $errors = validate($invoice);

    if (count($errors) === 0) {
      // Call add invoice function
      $id = addInvoice($invoice);

      // Redirect to index
      header("Location: index.php");
      exit();
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Invoice</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
  <main class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <h1 class="display-4 text-center mb-3 p-5">Add New Invoice</h1>

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

          <?php require "inputs.php"; ?>

          <button type="submit" class="btn btn-primary">Add Invoice</button>
          <a class="btn btn-secondary" href="index.php">Cancel</a>
        </form>
      </div>
    </div>
  </main>
</body>
</html>