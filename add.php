<?php
  require "data.php";

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
                
        <form method="post" action="index.php" class="bg-light border border-1 p-4">

          <div class="form-group mb-3">
            <label class="form-label" for="client">Client Name</label>
            <input class="form-control" id="client" name="client">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" for="email">Client Email</label>
            <input class="form-control" type="email" id="email" name="email">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" for="amount">Invoice Amount</label>
            <input class="form-control" id="amount" name="amount">
          </div>

          <div class="form-group mb-3">
            <label class="form-label" for="status">Invoice Status</label>
            <select class="form-select" id="status" name="status">
              <option value="draft">Draft</option>
              <option value="pending">Pending</option>
              <option value="paid">Paid</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary">Add Invoice</button>
          <a class="btn btn-secondary" href="index.php">Cancel</a>
        </form>
      </div>
    </div>
  </main>
</body>
</html>