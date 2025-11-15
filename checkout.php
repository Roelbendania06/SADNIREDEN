<?php
include "db.php"; // your database connection

// Initialize variables
$product  = $_POST['product'] ?? $_GET['product'] ?? '';
$name     = $_POST['name'] ?? '';
$quantity = $_POST['quantity'] ?? 0;
$payment  = $_POST['payment'] ?? '';

// Handle form submission
if(isset($_POST['submit_order'])){
    if(!$product || !$name || !$quantity || !$payment){
        die("Invalid order. Please go back and try again.");
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO orders (product, customer_name, quantity, payment_method) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $product, $name, $quantity, $payment);
    if($stmt->execute()){
        echo "<script>
                alert('Order Placed Successfully!');
                window.location.href='landingpage.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Failed to place order. Please try again.');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Confirmation - Cheyenne Bakery Supply</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background: #fffaf3; margin: 0; }
.container { display: flex; flex-wrap: wrap; max-width: 900px; margin: 60px auto; gap: 30px; }
.left, .right { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); flex: 1; min-width: 300px; }
h2 { font-weight: 600; margin-bottom: 20px; }
input, select { width: 100%; padding: 12px; margin: 12px 0; border-radius: 8px; border: 1px solid #ccc; font-size: 15px; }
.btn { background: #b5651d; padding: 12px; color: white; border: none; border-radius: 8px; width: 100%; cursor: pointer; font-size: 16px; margin-top: 15px; }
.btn:hover { background: #8d4b24; }
.summary-box p { font-size: 16px; margin: 8px 0; }
.summary-box { background: #fff7e6; padding: 20px; border-left: 5px solid #b5651d; border-radius: 10px; }
@media screen and (max-width: 800px) { .container { flex-direction: column; } }
</style>
</head>
<body>

<div class="container">

    <!-- LEFT: Order Details -->
    <div class="left">
        <h2>Confirm Your Order</h2>
        <form method="POST">
            <input type="hidden" name="product" value="<?php echo htmlspecialchars($product); ?>">
            <label>Product</label>
            <input type="text" value="<?php echo htmlspecialchars($product); ?>" disabled>

            <label>Your Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>

            <label>Quantity</label>
            <input type="number" name="quantity" value="<?php echo $quantity ?: 1; ?>" min="1" required>

            <label>Payment Method</label>
            <select id="paymentMethod" name="payment" required>
                <option value="">Select</option>
                <option value="Cash on Delivery" <?php if($payment=='Cash on Delivery') echo 'selected'; ?>>Cash on Delivery</option>
                <option value="Bank Transfer" <?php if($payment=='Bank Transfer') echo 'selected'; ?>>Bank Transfer</option>
                <option value="GCash" <?php if($payment=='GCash') echo 'selected'; ?>>GCash</option>
            </select>

            <button type="submit" name="submit_order" class="btn">Place Order</button>
        </form>
    </div>

    <!-- RIGHT: Payment Summary -->
    <div class="right">
        <h2>Order Summary</h2>
        <div class="summary-box" id="summary">
            <p><b>Product:</b> <?php echo htmlspecialchars($product); ?></p>
            <p><b>Name:</b> <span id="summaryName"><?php echo htmlspecialchars($name); ?></span></p>
            <p><b>Quantity:</b> <span id="summaryQuantity"><?php echo $quantity ?: 1; ?></span></p>
            <p><b>Payment Method:</b> <span id="summaryPayment"><?php echo $payment ?: 'Not selected'; ?></span></p>
        </div>
        <a href="landingpage.php" class="btn" style="margin-top:15px;">Return to Home</a>
    </div>

</div>

<script>
// Update summary dynamically
const nameInput = document.querySelector('input[name="name"]');
const quantityInput = document.querySelector('input[name="quantity"]');
const paymentSelect = document.getElementById('paymentMethod');

nameInput.addEventListener('input', () => document.getElementById('summaryName').innerText = nameInput.value);
quantityInput.addEventListener('input', () => document.getElementById('summaryQuantity').innerText = quantityInput.value);
paymentSelect.addEventListener('change', () => document.getElementById('summaryPayment').innerText = paymentSelect.value);
</script>

</body>
</html>
