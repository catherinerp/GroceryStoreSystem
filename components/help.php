<!-- 
Author: Catherine Pe Benito
Created: 04/04/2023
This page contains help information.
-->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="categories/landing.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
	</head>
	<body>
		<h1 style="text-align:center">Help</h1>
		<div class="help-container">
        <h2>Frequently Asked Questions</h2>
		<button class="accordion">Section 1</button>
		<div class="panel">
		<p>answer</p>
		</div>

		<button class="accordion">Section 1</button>
		<div class="panel">
		<p>answer</p>
		</div>

		<button class="accordion">Section 1</button>
		<div class="panel">
		<p>answer</p>
		</div>
</div>		
        <script>
		var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function() {
			this.classList.toggle("active");
			var panel = this.nextElementSibling;
			if (panel.style.display === "block") {
			panel.style.display = "none";
			} else {
			panel.style.display = "block";
			}
		});
		}
</script>
</script>
</body>
</html>	