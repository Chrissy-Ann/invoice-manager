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
/*
The Client Name field must contain only letters and spaces and cannot be more than 255 characters.
The Client Email field must be a properly formatted email address.
The Invoice Amount must be an integer.
The Invoice Status must be either "draft", "pending", or "paid"
*/
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