<!-- 
Author: Catherine Pe Benito
Created: 06/03/2023
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="assets/css/header.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    </head>
	<body>
        <div class="banner">
            <img href="index.php" class="img-logo" src="assets/images/logo-smallsize.png" alt="Grocery To-Go Logo">
            <h3>Your first choice for easy, accessible shopping.</h3>
            <div class="shopping-cart">
            <button>
                Cart
                <i class="fa fa-shopping-cart"></i>
            </button>
            </div>
        </div>
		<div class="topnav">
            <a style="cursor:pointer" onclick="openNav()"><i class="fa fa-bars"></i> Browse</a>
            <a class="active" href="landingpage.php" target="view">Home</a>
            <div class="dropdown">
                <a class="drophvr" href="categories.php" target="view">Categories <i class="fa fa-caret-down"></i></a>
                <div class="dropdown-links">
                    <a href="components/categories/show_fv.php" target="view">Fruit & Vegetables</a>
                    <a href="components/categories/show_ms.php" target="view">Meat & Seafood</a>
                    <a href="#" target="view">Snacks & Confectionery</a>
                    <a href="#" target="view">Freezer</a>
                    <a href="#" target="view">Beauty & Personal Care</a>
                    <a href="#" target="view">Pets</a>
                    <a href="#" target="view">Household</a>
                </div>
            </div>
            <a href="register.php" target="view">Register</a>
            <div class="search-bar">
            <form action="/search.php">
                <input type="text" placeholder="Search" name="search">
                <button type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
            </div>
        </div>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <p>Browse by Category</p>
            <a href="components/categories/show_fv.php" target="view" onclick="closeNav()">Fruit & Vegetables</a>
            <a href="components/categories/show_ms.php" target="view" onclick="closeNav()">Meat & Seafood</a>
            <a href="#" target="view" onclick="closeNav()">Snacks & Confectionery</a>
            <a href="#" target="view" onclick="closeNav()">Freezer</a>
            <a href="#" target="view" onclick="closeNav()">Beauty & Personal Care</a>
            <a href="#" target="view" onclick="closeNav()">Pets</a>
            <a href="#" target="view" onclick="closeNav()">Household</a>
        </div>
        <script>
            function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            }

            function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            }
        </script>
	</body>
</html>	