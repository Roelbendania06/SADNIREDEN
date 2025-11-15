<?php
$year = date("Y");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cheyenne Bakery Supply</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
html { scroll-behavior: smooth; }
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    background: #fffaf3;
}

/* Header */
header {
    background: linear-gradient(to right, #8d4b24, #b5651d);
    padding: 15px 30px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 100;
}
nav a {
    color: white;
    margin-left: 25px;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}

/* Hero */
.hero {
    background: url('https://images.unsplash.com/photo-1565958011703-44f9829ba187') center/cover no-repeat;
    height: 65vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
}
.hero h1 {
    font-size: 55px;
    color: white;
    text-align: center;
    font-weight: 600;
}

/* Section */
.section {
    padding: 50px 20px;
    text-align: center;
}

/* Products */
.products {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 25px;
    max-width: 1000px;
    margin: auto;
}
.card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    transition: 0.3s;
}
.card:hover {
    transform: translateY(-5px);
}

/* Button */
.btn {
    background: #b5651d;
    padding: 10px 25px;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    display: inline-block;
    margin-top: 12px;
    font-weight: 500;
}

/* Contact Section */
.contact-container {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    justify-content: center;
    align-items: flex-start;
    margin-top: 30px;
}
.contact-form, .contact-info-map {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}
.contact-form {
    flex: 1;
    min-width: 300px;
    max-width: 450px;
}
.contact-info-map {
    flex: 1;
    min-width: 300px;
    max-width: 550px;
}
form input, form textarea {
    width: 100%;
    padding: 12px;
    margin: 12px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 15px;
}

/* Map */
.map-container {
    margin-top: 15px;
    border-radius: 12px;
    overflow: hidden;
}

/* Footer */
footer {
    background: linear-gradient(to right, #8d4b24, #b5651d);
    padding: 20px;
    text-align: center;
    color: white;
    margin-top: 40px;
    font-size: 15px;
}
</style>
</head>

<body>

<header>
    <h2>Cheyenne Bakery Supply</h2>
    <nav>
        <a href="#home">Home</a>
        <a href="#products">Products</a>
        <a href="#contact">Contact</a>
        <a href="admin_login.php">Admin Login</a>
    </nav>
</header>

<!-- Hero -->
<section class="hero" id="home">
    <h1>Your Trusted Partner in Baking Solutions</h1>
</section>

<!-- Products -->
<section class="section" id="products">
<h2 style="font-weight:600;">Our Best-Selling Products</h2>

<div class="products">
    <div class="card">
        <h3>Premium Flour</h3>
        <p>High-quality flour for all baking needs.</p>
        <a class="btn" href="buy.php?product=Premium+Flour">Buy Now</a>
    </div>

    <div class="card">
        <h3>Chocolate Chips</h3>
        <p>Perfect for cookies and desserts.</p>
        <a class="btn" href="buy.php?product=Chocolate+Chips">Buy Now</a>
    </div>

    <div class="card">
        <h3>Cupcake Liners</h3>
        <p>Durable and colorful liners.</p>
        <a class="btn" href="buy.php?product=Cupcake+Liners">Buy Now</a>
    </div>
</div>
</section>

<!-- Contact -->
<section class="section" id="contact">
<h2 style="font-weight:600;">Contact Us</h2>

<div class="contact-container">

    <!-- Form -->
    <div class="contact-form">
        <form method="POST" action="send_message.php">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Message" rows="6" required></textarea>
            <button class="btn" type="submit">Send Message</button>
        </form>
    </div>

    <!-- Info + Map -->
    <div class="contact-info-map">
        <h3>Contact Information</h3>
        <p>📍 123 Bakery Street, Nasugbu, Batangas</p>
        <p>📞 +63 912 345 6789</p>
        <p>📧 support@cheyennebakery.com</p>
        <p>🕒 Mon – Sat: 8:00 AM – 6:00 PM</p>

       <div class="map-container"> 
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3874.0145500787706!2d120.59988217484911!3d14.072299192557131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd92c2c86f8c8f%3A0x9d572cca7cf72883!2sNasugbu%2C%20Batangas!5e0!3m2!1sen!2sph!4v1700000000000" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"> 

        </iframe> 
    </div>
 </div>
    

</div>
</section>

<!-- Footer -->
<footer>
© <?php echo $year; ?> Cheyenne Bakery Supply — All Rights Reserved
</footer>

</body>
</html>
