<?php
$product = isset($_GET['product']) ? $_GET['product'] : "Unknown Product";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Product - Cheyenne Bakery Supply</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f7eedd;
    margin: 0;
}

/* Container layout */
.wrapper {
    width: 80%;
    margin: 40px auto;
    display: flex;
    gap: 30px;
}

/* Left / Right Columns */
.left, .right {
    background: white;
    padding: 30px;
    border-radius: 15px;
    width: 50%;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

/* Titles */
.left h2, .right h2 {
    margin-top: 0;
    font-weight: 600;
}

/* Inputs */
input, select {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 15px;
}

/* Button */
.btn {
    background: #b5651d;
    color: white;
    padding: 12px;
    width: 100%;
    border-radius: 8px;
    border: none;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
}
.btn:hover {
    background: #8d4b24;
}

/* Payment Info Box */
.payment-box {
    background: #fff7ec;
    padding: 15px;
    border-radius: 10px;
    border-left: 4px solid #b5651d;
    margin-top: 15px;
    font-size: 15px;
}
</style>

<script>
function showPaymentDetails() {
    let method = document.getElementById("payment").value;
    let display = document.getElementById("payInfo");

    if (method === "Cash on Delivery") {
        display.innerHTML = `
            <h3>Cash on Delivery</h3>
            <p>• Pay only when the product arrives.</p>
            <p>• Make sure your address is correct.</p>
        `;
    }
    else if (method === "Bank Transfer") {
        display.innerHTML = `
            <h3>Bank Transfer Details</h3>
            <p><b>Bank:</b> BDO</p>
            <p><b>Account Name:</b> Cheyenne Bakery Supply</p>
            <p><b>Account Number:</b> 1234-5678-9012</p>
        `;
    }
    else if (method === "GCash") {
        display.innerHTML = `
            <h3>GCash Payment</h3>
            <p><b>GCash Name:</b> Cheyenne Bakery Supply</p>
            <p><b>GCash Number:</b> 0912-345-6789</p>
            <p>Please send screenshot after payment.</p>
        `;
    }
    else {
        display.innerHTML = `<p>Please select a payment method.</p>`;
    }
}
</script>

</head>

<body>

<div class="wrapper">

    <!-- LEFT SIDE: Order Form -->
    <div class="left">
        <h2>Order Details</h2>
        <p>You are buying: <b><?php echo $product; ?></b></p>

        <form method="POST" action="checkout.php">
            <input type="hidden" name="product" value="<?php echo $product; ?>">

            <label>Your Name</label>
            <input type="text" name="name" required>

            <label>Quantity</label>
            <input type="number" name="quantity" min="1" required>

            <label>Payment Method</label>
            <select name="payment" id="payment" onchange="showPaymentDetails()" required>
                <option value="">Select Payment Method</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="GCash">GCash</option>
            </select>

            <button type="submit" class="btn">Confirm Order</button>
        </form>
    </div>

    <!-- RIGHT SIDE: Payment Information -->
    <div class="right">
        <h2>Payment Information</h2>

        <div id="payInfo" class="payment-box">
            <p>Please select a payment method to view details.</p>
        </div>
    </div>

</div>

</body>
</html>
