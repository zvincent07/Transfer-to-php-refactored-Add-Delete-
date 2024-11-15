<?php include 'includes/config.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-danger font-weight-bold">Dashboard <small class="text-muted">Manage Accounts</small></h1>
    </div>

    <?php include 'includes/account_filters.php'; ?>
    <?php include 'includes/account_table.php'; ?>
    <?php include 'includes/modals.php'; ?>
</div>

<?php include 'includes/footer.php'; ?>
