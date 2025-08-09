   
    <?php
session_start();
if(isset($_SESSION['phone']))
{
    ?>
    
    
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vender Dashboard</title>
    <link href="css/vender/vender-index.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <h1>Welcome, Seller!</h1>
                <div class="seller-details">
                        <p><strong>Name:</strong> <?php echo ($_SESSION['name']); ?></p>
                        <p><strong>Email:</strong> <?php echo ($_SESSION['email']); ?></p>
                        <p><strong>Phone:</strong> <?php echo ($_SESSION['phone']); ?></p>

                </div>
                <form action="logout.php" method="post" >
                  <button class="logout-btn"  type="submit" name="logout">Logout</button>
                </form>
            </div>
        </header>
        <main>
            <section class="properties">
                <h2>Your Listed Properties</h2>
                <div class="property-card">
                    <img src="img/houses/property-1.jpg" alt="Property 1">
                    <div class="property-info">
                        <h3>Beautiful Family House</h3>
                        <p><strong>Location:</strong> New York</p>
                        <p><strong>Price:</strong> $1,200,000</p>
                    </div>
                </div>
                <div class="property-card">
                <img src="img/houses/property-2.jpg" alt="Property 1">
                <div class="property-info">
                        <h3>Modern Apartment</h3>
                        <p><strong>Location:</strong> Los Angeles</p>
                        <p><strong>Price:</strong> $800,000</p>
                    </div>
                </div>
                <!-- Add more property cards as needed -->
            </section>
        </main>
    </div>
</body>
</html>


<?php
}
else
{
    header("Location: vender-login.html");
    exit();
}
?>

