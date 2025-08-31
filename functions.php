<?php

// Sanitize Function
function sanitize($data) {
  foreach ($data as $key => $value) {
    switch ($key) {
      case 'amount':
        // convert to an int
        $data[$key] = (int)$data[$key];
        break;
      default:
        // strip unwanted chars
        $data[$key] = htmlspecialchars(stripslashes(trim($value)));
        break;
    }
  }
  return $data;
}

// Validate Function
function validate($invoice) {
  $fields = ['client', 'email', 'amount', 'status'];
  $errors = [];
  global $statuses;

  foreach ($fields as $field) {
    switch ($field) {
      case 'client':
        if (empty($invoice[$field])) {
          $errors[$field] = 'Client name is required';
        } else if (!preg_match('/^[a-zA-Z\s]+$/', $invoice[$field])) {
            $errors[$field] = 'Client name must contain only letters and spaces';
        }else if (strlen($invoice[$field]) > 255) {
          $errors[$field] = 'Client name must be fewer than 255 characters';
        }
        break;
      case 'email':
        if (empty($invoice[$field])) {
          $errors[$field] = 'Client email is required';
        } else if (filter_var($invoice[$field], FILTER_VALIDATE_EMAIL) == false) {
            $errors[$field] = 'Client email must be a properly formatted email address';
        }
        break;
      case 'amount':
        if (empty($invoice[$field])) {
          $errors[$field] = 'Invoice amount is required';
        } else if (filter_var($invoice[$field], FILTER_VALIDATE_INT) == false) {
            $errors[$field] = 'Invoice amount must by a number';
        }
        break;
      case 'status':
        if (empty($invoice[$field])) {
          $errors[$field] = 'Invoice status is required';
        } else if (!in_array($invoice[$field], $statuses) || $invoice[$field] == 'all') {
          $errors[$field] = 'The Invoice Status must be either "draft", "pending", or "paid"';
        }
        break;
    }
  }
  return $errors;
}

// Create Invoice Number Function
function getInvoiceNumber ($length = 5) {
  $letters = range('A', 'Z');
  $number = [];
    
  for ($i = 0; $i < $length; $i++) {
    array_push($number, $letters[rand(0, count($letters) - 1)]);
  }
  return implode($number);
}

// Get All Invoices
function getInvoices() 
{
  global $db;

  $sql = "SELECT * FROM invoices";
  $result = $db->query($sql);
  $invoices = $result->fetchAll(PDO::FETCH_ASSOC);

  return $invoices;
}

// Filter invoices
function filterInvoices ($status_id) 
{
  global $db;

  $sql = "SELECT * FROM invoices WHERE status_id = :status_id";
  $stmt = $db->prepare($sql);
  $stmt->execute([':status_id' => $status_id]);
  $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $invoices;
}

// Get Invoice
function getInvoice ($id) 
{
  global $db;

  $sql = "SELECT * FROM invoices WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->execute(['id' => $id]);
  $invoice = $stmt->fetch();

  return $invoice;
}

// Get Status Id
function getStatusId ($status) 
{
  global $statuses;

  return array_search($status, $statuses) + 1;
}


// Add Invoice
function addInvoice ($invoice) 
{
  global $db;
  $status_id = getStatusId($invoice['status']);

  $sql = "INSERT INTO invoices (number, client, email, amount, status_id) VALUES (:number, :client, :email, :amount, :status_id)";
  $stmt = $db->prepare($sql);
  $stmt->execute([
    ':number' => getInvoiceNumber(),
    ':client' => $invoice['client'],
    ':email' => $invoice['email'],
    ':amount' => $invoice['amount'],
    ':status_id' => $status_id
  ]);

  $id = $db->lastInsertId();

  saveDocument($id);

  return $id;
}


// Update Invoice
function updateInvoice ($invoice) 
{
  global $db;
  $status_id = getStatusId($invoice['status']);

  $sql = "UPDATE invoices SET client = :client, email = :email, amount = :amount, status_id = :status_id WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->execute([
    ':client' => $invoice['client'],
    ':email' => $invoice['email'],
    ':amount' => $invoice['amount'],
    ':status_id' => $status_id,
    ':id' => $invoice['id']
  ]);

  saveDocument($invoice['id']);

  return $invoice['id'];
}


// Delete Invoice
function deleteInvoice ($id) 
{
  global $db;

  $sql = "DELETE FROM invoices WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->execute([':id' => $id]);

  return $stmt->rowCount() === 1;
}

// Save Invoice PDF
function saveDocument ($id) 
{
  $doc = $_FILES['doc'];

  if ($doc['error'] === UPLOAD_ERR_OK) {
    $extension = pathinfo($doc['name'], PATHINFO_EXTENSION);

    if (!file_exists('documents/')) {
      mkdir('documents/');
    }

    $invoice = getInvoice($id);
    $number = $invoice['number'];

    $destination = 'documents/' . $number . '.' . $extension;

    if (file_exists($destination)) {
      unlink($destination);
    }

    return move_uploaded_file($doc['tmp_name'], $destination);
  }
  return false;
}