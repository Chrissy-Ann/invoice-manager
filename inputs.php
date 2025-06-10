<?php
/*
I used copilot to understand 'echo $movie['title'] ?? '';' in the movie mayhem example and used it.
If the value is null (like in add.php), the value is an empty string.
If the value is not null (like in update.php), that is the value so the form can be prepopulated.
This means I can use the same input temple for both forms, even though one must be prepopulated.
*/
?>

<div class="form-group mb-3">
  <label class="form-label" for="client">Client Name</label>
  <input type="text" class="form-control" id="client" name="client" required
  value="<?php echo $invoice['client'] ?? ''; ?>">
</div>

<div class="form-group mb-3">
  <label class="form-label" for="email">Client Email</label>
  <input type="text" class="form-control" id="email" name="email" required
  value="<?php echo $invoice['email'] ?? ''; ?>">
</div>

<div class="form-group mb-3">
  <label class="form-label" for="amount">Amount</label>
  <input type="text" class="form-control" id="amount" name="amount" required
  value="<?php echo $invoice['amount'] ?? ''; ?>">
</div>

<div class="form-group mb-3">
  <label class="form-label" for="status">Invoice Status</label>
  <select class="form-select" id="status" name="status" required>
    <option value="">Select a Status</option>
    <?php foreach ($statuses as $status) : ?>
      <option value="<?php echo $status; ?>"
        <?php if (isset($invoice['status_id']) && $status === $statuses[$invoice['status_id']-1]) : ?> selected <?php endif; ?> >
        <?php echo ucfirst($status); ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>