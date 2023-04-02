<!-- 
Author: Catherine Pe Benito
Created: 06/03/2023
-->
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="assets/css/header.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <a class="active" href="home.php" target="view">Home</a>
            <a href="categories.php" target="view">Categories</a>
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
            <a href="#" target="view">Cateogiry 1</a>
            <a href="#">Category 2</a>
            <a href="#">Category 3</a>
            <a href="#">Category 4</a>
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