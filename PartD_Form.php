<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	
	
	<script>
			function myFunction() {
				document.getElementById("wine_search").reset();
			}
			
	</script>
	<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>


<?php

	//session_start();
	$connection = mysqli_connect("localhost","root","nigger","winestore");	
	$result = mysqli_query($connection, "SELECT * FROM winestore");


?>

<html>
	<head>
	<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body>
		<table style='margin-left:529px;margin-top:100px' border='0'>
				<tr>
					<td>
						<img src='../logo.jpg' alt='Mountain View' style='width:150px;height:150px'>
					</td>
					<td style='text-align:center'>
						<h1>Wine Search</h1>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
						Created By Tharindu Gamage
					</td>
				</tr>
		</table>
		
		<table style="margin-left:350px;margin-top:30px" border="0">
		<form id="wine_search" method="get" style="margin-left:280px;margin-top:150px" action="Pear_DB.php"> 
			
			<tr>
			<td>Wine Name :</td>
			<td>
			<input type="text" name="wine_name" value="" size=20/>
			</td>
			</tr>
			
			<tr>
			<td>Region Select</td>
			<td>
			<?php
			$region = mysqli_query ($connection,"SELECT region_name FROM region");
			
			// Start the HTML body, and output preformatted text 
			echo "<select name='region'>";
			while ($row=mysqli_fetch_array($region) )
			{
			echo "<option>".($row["region_name"])."</option>";
			}
			echo "</select>";
			?>
			</td></tr>
			
			<tr>
			<td>Winery Name :</td>
			<td>
			<input type="text" name="winery_name" value="" size=20/>
			</td></tr>
			
			<tr>
			<td>Range of Years :</td>
			<td>
			From <input maxlength="4" min="1950" max="2000" style="width:50px" type="number" name="start_year" id="start_year" value="" /> to <input style="width:50px" min="1950" max="2000" maxlength="4" type="number" name="end_year" id="end_year" value="" size="6"/>
			</td>
			</tr>
					
			<tr>
			<td>Minimum number of wines in stock :</td>
			<td>
			<input type="number" min="0" max="9999" name="Min_wine_in_stock" value="" size="6"/>
			</td>
			</tr>
			
			<tr>
			<td>Minimum number of Customers who purchased this wine :</td>
			<td>
			<input type="number" min="0" max="9999" name="Min_customers" value="" size="6"/>
			</td>
			</tr>
			
			<tr>
			<td>Cost Range :</td>
			<td>
			Min: <input maxlength="4" min="0" max="9999" style="width:40px" type="number" id="cost_min_range" name="cost_min_range"/> Max: <input maxlength="4" min="0" max="9999" style="width:40px" type="number" id="cost_max_range" name="cost_max_range"/>
			</td>
			</tr>
		</table>
		
		<input style="margin-left:629px;width:120px;margin-top:10px" type="submit" name="search" value="Search"/>
		<br>
		<button style="margin-left:350px" type="reset" value='Reset'>Reset Form</button>
		</form>
		</body>
		
</html>
