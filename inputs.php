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

<div class="form-group mb-3">
  <label class="form-label" for="doc">Upload Invoice PDF</label>
  <input type="file" class="form-control" id="doc" name="doc" accept=".pdf">
</div>