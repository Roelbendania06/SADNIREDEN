<?php
session_start();
include "db.php";

// Check if admin is logged in
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit;
}

// Fetch orders
$orderResult = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard - Cheyenne Bakery Supply</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background: #f8f5f0; margin:0; }
.sidebar {
    position: fixed;
    top: 0; left: 0;
    width: 220px; height: 100%;
    background: linear-gradient(to bottom, #8d4b24, #b5651d);
    color: white;
    padding-top: 50px;
}
.sidebar a {
    display: block;
    padding: 15px 20px;
    color: white;
    text-decoration: none;
    font-weight: 500;
    transition: 0.2s;
}
.sidebar a:hover {
    background: rgba(255,255,255,0.1);
}
.main {
    margin-left: 220px;
    padding: 40px;
}
h1 { color: #8d4b24; margin-bottom: 30px; }
.table th, .table td { vertical-align: middle; }
.status-pending { color: orange; font-weight: bold; }
.status-completed { color: green; font-weight: bold; }
.btn-complete { background:#b5651d; color:white; padding:5px 10px; border-radius:5px; text-decoration:none; }
.btn-complete:hover { background:#8d4b24; color:white; }
.logout-btn { float:right; margin-bottom:20px; }
</style>
</head>
<body>

<div class="sidebar">
    <h3 class="text-center">Admin Menu</h3>
    <a href="admin_dashboard.php">Orders</a>
    <a href="stocks.php">Stocks</a>
    <a href="update_product.php">Update Product</a>
    <a href="delete_product.php">Delete Product</a>
    <a href="report.php">Reports</a>
    <a href="admin_logout.php" class="mt-4">Logout</a>
</div>

<div class="main">
    <h1>Orders</h1>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if($orderResult->num_rows > 0): ?>
                <?php while($order = $orderResult->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo htmlspecialchars($order['product']); ?></td>
                        <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo $order['payment_method']; ?></td>
                        <td>
                            <?php 
                                if(isset($order['status']) && $order['status'] === 'Completed') 
                                    echo "<span class='status-completed'>Completed</span>"; 
                                else 
                                    echo "<span class='status-pending'>Pending</span>";
                            ?>
                        </td>
                        <td>
                            <?php if(!isset($order['status']) || $order['status'] !== 'Completed'): ?>
                                <a href="update_order.php?id=<?php echo $order['id']; ?>" class="btn-complete">Mark Complete</a>
                            <?php else: ?>
                                ✔ Done
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">No orders yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
