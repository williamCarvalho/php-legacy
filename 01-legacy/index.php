<?php

$db = new PDO('mysql:host=localhost;dbname=os_management', 'root', '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create') {
    $customer = $_POST['name'];
    $description = $_POST['description'];
    $value = $_POST['value'];

    $stmt = $db->prepare("INSERT INTO service_orders (name, description, value, status) VALUES (?, ?, ?, 'P')");
    $stmt->execute([$customer, $description, $value]);
    header('Location: index.php');
    exit;
}

$stmt = $db->query("SELECT * FROM service_orders ORDER BY id DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$arrStatus = [
    "P" => "Pending",
    "A" => "In progress",
    "F" => "Finished",
    "C" => "Canceled"
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>LEGACY SYSTEM - Service Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h1 class="h3 mb-4 text-secondary">Service Order Dashboard (Legacy)</h1>

                        <h2 class="h5 mb-3">New Service Order</h2>

                        <form method="POST" action="./" class="row g-3">
                            <input type="hidden" name="action" value="create" />

                            <div class="col-md-6">
                                <label>Customer name</label><br />
                                <input type="text" name="name" class="form-control" placeholder="Name" required />
                            </div>

                            <div class="col-md-6">
                                <label>Value ($)</label><br />
                                <input type="number" step="0.01" class="form-control" name="value" placeholder="Value" required />
                            </div>

                            <div class="col-12">
                                <label>Service description</label><br />
                                <textarea name="description" class="form-control" placeholder="Description" rows="2" required></textarea>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="h5 mb-3">Registered Orders</h2>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle">
                                <thead class="table-dark">
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Description</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                </thead>

                                <tbody>
                                    <?php if (empty($orders)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No orders registered.</td>
                                        </tr>
                                    <?php else: ?>

                                        <?php foreach ($orders as $os): ?>
                                            <tr>
                                                <td>
                                                    <?= $os['id'] ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($os['name']) ?>
                                                </td>
                                                <td>
                                                    <?= htmlspecialchars($os['description']) ?>
                                                </td>
                                                <td>
                                                    $ <?= number_format($os['value'], 2) ?>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary"><?= $arrStatus[$os['status']] ?></span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>