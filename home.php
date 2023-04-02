<!-- 
Author: Catherine Pe Benito
Created: 01/04/2023
This pages displays the main content of the home webpage.
-->
<!DOCTYPE html>
<html>
	<body>
	<form action="show_products.php" method="get">
         <table>
            <h2>Browse products</h2>
            <tr>
               <td>
                  Year Made in or After<span style="color:red">*</span>
               </td>
               <td>
                  <input type="text" name="earliest_made" width="20">
               </td>
            </tr>
            <tr>
               <td>
               </td>
            </tr>
            <tr>
               <td>
                  Year Made Before or in<span style="color:red">*</span>
               </td>
               <td>
                  <input type="text" name="latest_made" width="20"><br>
               </td>
            </tr>
            <tr>
               <td colspan="2" align="center">
                  <input type="submit" value="Retrieve Data">
               </td>
            </tr>
         </table>
      </form>
	</body>
</html>	
		