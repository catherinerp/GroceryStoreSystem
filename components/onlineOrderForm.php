<!-- 
Author: Catherine Pe Benito
Created: 26/04/2023
This contains the page to add shipping details.
-->
<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$fullnameErr = $emailErr = $addressErr = $stateErr = $countryErr = "";
$nameIsValid = $emailIsValid = $addressIsValid = $stateIsValid = $countryIsValid = false;
$fullname = $email = $address = $state = $country = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fullname"])) {
        $fullnameErr = "Full name is required";
      } else {
        $fullname = test_input($_POST["fullname"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) {
          $fullnameErr = "Only letters and white space allowed";
        } else {
            $nameIsValid = true;
        }
      }

    if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        } else {
            $emailIsValid = true;
        }
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
      } else {
        $address = test_input($_POST["address"]);
        $addressIsValid = true;
        }
      

      if (empty($_POST["state"])) {
        $stateErr = "State is required";
      } else {
        $state = test_input($_POST["state"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$state)) {
          $stateErr = "Only letters and white space allowed";
        } else {
            $stateIsValid = true;
        }
      }
      if (empty($_POST["country"])) {
        $countryErr = "Country is required";
      } else {
        $country = test_input($_POST["country"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$country)) {
          $countryErr = "Only letters and white space allowed";
        } else {
            $countryIsValid = true;
        }
      }
    if ($nameIsValid && $emailIsValid && $addressIsValid && $stateIsValid && $countryIsValid) {
        // Multiple recipients separated by comma
        $from = '"Catherine" <cpebenito88@gmail.com>';
        $to = 'cpebenito88@gmail.com';

        // Subject

        $subject = 'Office supplies - Reminder';

        // Message

        $message = '
        <html>
        <head>
        <title>Office supplies for March</title>
        </head>
        <body>
        <p>We need the following office supplies</p>
        <table>
        <tr>
        <th>Item</th><th>Quantity</th><th>Month</th><th>Department</th>
        </tr>
        <tr>
        <td>Notebook</td><td>10</td><td>March</td><td>Operations</td>
        </tr>
        <tr>
        <td>Chair</td><td>5</td><td>March</td><td>Marketing</td>
        </tr>
        </table>
        </body>
        </html>
        ';
        // To send HTML emails, remember to set the Content-type header
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $message = quoted_printable_encode($PLAINTEXT);
        $subject = "=?UTF-8?B?".base64_encode($SUBJECT)."?=";
        // Other additional headers
        $headers = array();
        $headers[] = 'To: cpebenito88@gmail.com';
        $headers[] = 'From: Catherine Pe Benito <cpebenito88@gmail.com>';

        $headers[] = 'Cc: Catherine Pe Benito <Catherine.Pebenito@student.uts.edu.au>';

        // Mail it

        mail($to, $subject, $message, implode("\r\n", $headers),"-f".$from);


        header("Location: confirmOrderPage.php?fullname=$fullname&email=$email&address=$address&state=$state&country=$country");
        exit();
    }  
}
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Checkout</title>
        <link rel="icon" href="../assets/favicon.ico">
        <link rel="stylesheet" href="../assets/css/checkoutPage.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
	<body>
        
    <div class="banner">
        <img href="../index.php" target="_blank" class="img-logo" src="../assets/images/logo-smallsize.png" alt="Grocery To-Go Logo">
        <h3>Your first choice for easy, accessible shopping.</h3>
    </div>
    <?php
            ini_set('display_errors', 1);
            ini_set('error_reporting', E_ALL);?>
        <div class="shopping-cart-container">
        <div class="cart-items-container">
        <?php
        if (empty($_SESSION['cart'])) {
            echo "<p>Cart is empty.</p>";
        } else {
            include "dbConfig.php";
            $total_price = 0;
            $total_quantity = 0;
        foreach ($_SESSION['cart'] as $item_id => $quantity) {
            // Retrieve the item details from the database
            // You would need to modify this code based on your database structure
            $query = "SELECT * FROM products WHERE product_id = $item_id";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
    
            // Calculate the total price and total quantity
            $unit_price = $row['unit_price'];
            $item_price = $unit_price * $quantity;
            $item_price = number_format((float)$item_price, 2, '.', '');

            $total_price += $item_price * $quantity;
            $total_quantity += $quantity;
        }
    }
        ?>
        <div class="col-25">
            <div class="container">
            <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $total_quantity?></b></span></h4>
            <p><a href="#">Product 1</a> <span class="price">$<?php echo $item_price ?></span></p>
            <p><a href="#">Product 2</a> <span class="price">$5</span></p>
            <p><a href="#">Product 3</a> <span class="price">$8</span></p>
            <p><a href="#">Product 4</a> <span class="price">$2</span></p>
            <hr>
            <p>Total <span class="price" style="color:black"><b>$<?php echo $total_price?></b></span></p>
            </div>
        </div>
        <h2>Billing Details</h3>
        <sub><span class="required">*</span> Required field</sub>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="name">Full Name <span class="required">*</span></label></br>
            <input type="text" id="name" name="fullname" placeholder="E.g. Jane Doe">
            <span class="required"><?php echo $fullnameErr;?></span>
            </br>
            <label for="email">Email <span class="required">*</span></label></br>
            <input type="text" id="email" name="email" placeholder="E.g. jane@email.com">
            <span class="required"><?php echo $emailErr;?></span>
            </br>
            <label for="address">Address <span class="required">*</span></label></br>
            <input type="text" id="address" name="address" placeholder="E.g. 123 Place Street">
            <span class="required"><?php echo $addressErr;?></span>
            </br>
            <label for="state">State <span class="required">*</span></label></br>
            <input type="text" id="state" name="state" placeholder="State">
            <span class="required"><?php echo $stateErr;?></span>
            </br>
            <label for="country">Country <span class="required">*</span></label></br>
            <input type="text" id="country" name="country" placeholder="Country">
            <span class="required"><?php echo $stateErr;?></span>    
            </br>
            <div class="cart-actions">
                <h3>Item Quantity</h3><?php echo "$total_quantity"?>
                <h2>Cart Total</br><?php echo "$$total_price"?></h2>
            <input class="checkout-btn" type="submit" name="submit" value="Place Order">
            </div>
        </form>
    </div>
    </body>
</html>