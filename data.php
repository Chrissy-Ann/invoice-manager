<?php 

  $dsn = 'sqlite:invoice_manager.sqlite';

  try {
    $db = new PDO($dsn);
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit();
  }

  
  $sql = "SELECT * FROM statuses";
  $result = $db->query($sql);
  $statuses = $result->fetchAll(PDO::FETCH_COLUMN, 1);