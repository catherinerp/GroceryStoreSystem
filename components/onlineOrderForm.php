<!-- 
Author: Catherine Pe Benito
Created: 26/04/2023
This contains the page to add shipping details.
-->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';
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
        $fullname = htmlentities($_POST['fullname']);
        $email = htmlentities($_POST['email']);
        $address = htmlentities($_POST['address']);
        $state = htmlentities($_POST['state']);
        $country = htmlentities($_POST['country']);
        $subject = htmlentities("your order has been confirmed! | Grocery TO-GO");
        $sender = htmlentities("Grocery TO-GO");

        $today_date = date("d/m/Y");
        $current_time = date("h:i:a");
        $total_price = htmlentities($total_price);
        
        $message = '
        <html>
          <head>
            <title>Order Confirmation | Grocery TO-GO</title>
          </head>
          <body>
            <h1>Your order has been confirmed!</h1>
            <h3>Thank you for ordering from Grocery TO-GO.</h3>'
            .'<p>You should expect your order to be delivered within 2-3 business days.</p>'
            .'<p><b>Time:</b> '. $current_time .'</p>'
            .'<p><b>Date:</b> '. $today_date .'</></p><hr>'
            .'<h2>Order Details</h2>
            single item cost
            total cost'
            .'<p><b>Total: </b>'. $total_price .'</p><hr>'
            .'<h2>Billing Details </h2>'
            .'<p><b>Full Name: </b>'. $fullname .'</p>'
            .'<p><b>Email: </b>'. $email .'</p>'
            .'<p><b>Address: </b>'. $address .'</p>'
            .'<p><b>State: </b>'. $state .'</p>'
            .'<p><b>Country: </b>'. $country .'</p>
          </body>
        ';
        $message .="
        </body>
        </html>";

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username='grocerytogogo@gmail.com';
        $mail->Password='whivlxsyfmrolzyi';
        $mail->Port= 465;
        $mail->SMTPSecure = 'ssl';
        $mail->isHTML(true);
        $mail->setFrom($email, $sender);
        $mail->addAddress($email);
        $mail->Subject = ("$fullname, $subject");
        $mail->Body = $message;
        $mail->send();

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
        <div class="shopping-cart-container">
        <div class="cart-items-container">
        <h2>Order Details</h2></br>
        <?php
        if (empty($_SESSION['cart'])) {
            echo "<p>Cart is empty.</p>";
        } else {
            include "dbConfig.php";
            $total_price = 0;
            $total_quantity = 0;
            echo "<table>";
            echo "<tr class='cart-columns'>";
                echo "<td>Item</td>";
                echo "<td>Quantity</td>";
                echo "<td>Price</td>";
            echo "</tr>";
                foreach ($_SESSION['cart'] as $item_id => $quantity) {
                    $query_string = "SELECT * FROM products WHERE product_id = $item_id";
                    $result = mysqli_query($conn, $query_string);
                    $row = mysqli_fetch_assoc($result);
                    $product_name = $row['product_name'];
                    $product_image= $row['product_image'];
                    $unit_price = $row['unit_price'];
                    $unit_quantity = $row['unit_quantity'];

                    $item_price = $unit_price * $quantity;
                    $item_price = number_format((float)$item_price, 2, '.', '');

                    echo "<tr>
                            <td>
                                <div class='cart-item-image'>
                                    <img src='categories/images/$product_image' style='width:75px; height:75px'>\t
                                </div>
                                <div class='cart-item-name'>
                                $product_name
                                </br>($unit_quantity)
                                </div>
                            </td>
                            <td>
                                \t$quantity\t
                            </td>
                            <td>$$item_price</td>
                            </tr>\t";
                    $total_price = $total_price + $item_price;
                    $total_price = number_format((float)$total_price, 2, '.', '');
                    $total_quantity = $total_quantity + $quantity;
                }
                echo "</table>";
         }
        ?>
        <h2>Shipping Details</h2>
        <sub><span class="required">*</span> Required field</sub>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="fullname">Full Name <span class="required">*</span></label></br>
            <input type="text" id="fullname" name="fullname" placeholder="E.g. Jane Doe">
            <span class="required"><?php echo $fullnameErr;?></span>
            </br>
            <label for="email">Email <span class="required">*</span></label></br>
            <input type="email" id="email" name="email" placeholder="E.g. jane@email.com">
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
                <h2>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $total_quantity?></b></span></h2>
                <h2><?php echo "$$total_price"?></h2></br>
                <input style="float:right" class="checkout-btn" type="submit" name="submit" value="Place Order"></input>
            </div>
        </form>
    </div>
    </body>
</html>