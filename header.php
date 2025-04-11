<?php
ob_start();
session_start();

// Include necessary files and functions
include("admin/inc/config.php"); // Configure your database connection here
include("admin/inc/functions.php"); // Define your custom functions here
include("admin/inc/CSRF_Protect.php");

$csrf = new CSRF_Protect();
$error_message = '';
$success_message = '';

// Define a placeholder for site settings (Replace with your actual site settings retrieval code)
function getSiteSettings($pdo) {
    // Implement your logic to retrieve site settings here from your database
    $stmt = $pdo->prepare("SELECT * FROM tbl_settings");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Create a PDO instance for your database connection
function createPDOConnection() {
    // Replace with your actual database connection parameters
    $host = 'localhost';
    $dbname = 'ecommerceweb';
    // $username = 'localhost';
    $password = ' ';

    try {
        $pdo = new PDO($host,$dbname, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Handle database connection error
        die("Database connection failed: " . $e->getMessage());
    }
}

// Fetch site settings
$pdo = createPDOConnection(); // Establish a database connection
$siteSettings = getSiteSettings($pdo);

// Define language variables (Replace these with your actual language variables)
define('LANG_VALUE_1', 'Value 1');
define('LANG_VALUE_2', 'Value 2');
define('LANG_VALUE_3', 'Value 3');
define('LANG_VALUE_9', 'Your Value 9'); // Replace with actual value
define('LANG_VALUE_13', 'Your Value 13'); // Replace with actual value
define('LANG_VALUE_15', 'Your Value 15'); // Replace with actual value
define('LANG_VALUE_18', 'Your Value 18'); // Replace with actual value
define('LANG_VALUE_89', 'Your Value 89'); // Replace with actual value

// Define a placeholder for removeOldPendingTransactions function
function removeOldPendingTransactions($pdo) {
    // Implement your logic to remove old pending transactions here
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/uploads/<?php echo $siteSettings['favicon']; ?>">

    <!-- Stylesheets -->
    <!-- Include your CSS stylesheets here -->

    <!-- Meta title, keywords, and description -->
    <title><?php echo $siteSettings['meta_title_home']; ?></title>
    <meta name="keywords" content="<?php echo $siteSettings['meta_keyword_home']; ?>">
    <meta name="description" content="<?php echo $siteSettings['meta_description_home']; ?>">

    <!-- Additional head content -->
    <?php echo $siteSettings['before_head']; ?>
</head>
<body>
    <!-- Your HTML content here -->

    <!-- Top Bar -->
    <!-- Include your top bar content here -->

    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="row inner">
                <div class="col-md-4 logo">
                    <a href="index.php"><img src="assets/uploads/<?php echo $siteSettings['logo']; ?>" alt="logo image"></a>
                </div>

                <div class="col-md-5 right">
                    <ul>
                        <?php
                        if(isset($_SESSION['customer'])) {
                            // User is logged in
                            ?>
                            <li><i class="fa fa-user"></i> <?php echo LANG_VALUE_13; ?> <?php echo $_SESSION['customer']['cust_name']; ?></li>
                            <li><a href="dashboard.php"><i class="fa fa-home"></i> <?php echo LANG_VALUE_89; ?></a></li>
                            <?php
                        } else {
                            // User is not logged in
                            ?>
                            <li><a href="login.php"><i class="fa fa-sign-in"></i> <?php echo LANG_VALUE_9; ?></a></li>
                            <li><a href="registration.php"><i class="fa fa-user-plus"></i> <?php echo LANG_VALUE_15; ?></a></li>
                            <?php
                        }
                        ?>

                        <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> <?php echo LANG_VALUE_18; ?> (<?php echo LANG_VALUE_1; ?><?php
                        if(isset($_SESSION['cart_p_id'])) {
                            $table_total_price = calculateTotalCartPrice($_SESSION, $pdo); // Implement calculateTotalCartPrice function
                            echo $table_total_price;
                        } else {
                            echo '0.00';
                        }
                        ?>)</a></li>
                    </ul>
                </div>

                <div class="col-md-3 search-area">
                    <form class="navbar-form navbar-left" role="search" action="search-result.php" method of "get">
                        <?php $csrf->echoInputField(); ?>
                        <div class="form-group">
                            <input type="text" class="form-control search-top" placeholder="<?php echo LANG_VALUE_2; ?>" name="search_text">
                        </div>
                        <button type="submit" class="btn btn-danger"><?php echo LANG_VALUE_3; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <!-- Include your navigation menu here -->

    <!-- Rest of your HTML content -->
    <!-- Include your website content here -->

    <!-- Footer -->
    <!-- Include your footer content here -->

</body>
</html>
