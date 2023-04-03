<?php 
if(isset($_POST['price_range'])){ 
     
    // Include database configuration file 
    $hostname = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "assignment1";

    $conn = mysqli_connect($hostname, $username,$password,$dbname);
            //$link = mysqli_connect("aa4xf37s2fw51e.cs0uliqvpua0.us-east-1.rds.amazonaws.com","uts","internet","uts");
    if (!$conn)
        die("Could not connect to Server");
     
    // Set conditions for filter by price range 
    $whereSQL = ''; 
    $priceRange = $_POST['price_range']; 
    if(!empty($priceRange)){ 
        $priceRangeArr = explode(',', $priceRange); 
        $whereSQL = "WHERE price BETWEEN '".$priceRangeArr[0]."' AND '".$priceRangeArr[1]."'"; 
        $orderSQL = " ORDER BY price ASC "; 
    }else{ 
        $orderSQL = " ORDER BY created DESC "; 
    } 
     
    // Fetch matched records from database 
    $query = $db->query("SELECT * FROM products $whereSQL $orderSQL"); 
     
    if($query->num_rows > 0){ 
        while($row = $query->fetch_assoc()){ 
    ?> 
        <div class="list-item"> 
            <h2><?php echo $row["product_name"]; ?></h2> 
            <h4>Price: $<?php echo $row["unit_price"]; ?></h4> 
        </div> 
    <?php  
        } 
    }else{ 
        echo '<p>Product(s) not found...</p>'; 
    } 
} 
?>