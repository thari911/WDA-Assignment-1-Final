<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<title>Wines</title>
</head>
<body>
<?php

	$wine_name = $_GET['wine_name'];
	$region = $_GET['region'];
	$winery_name = $_GET['winery_name'];
	$start_year = $_GET['start_year'];
	$end_year = $_GET['end_year'];
	$min_winestock = $_GET['Min_wine_in_stock'];
	$min_customers = $_GET['Min_customers'];
	$min_cost = $_GET['cost_min_range'];
	$max_cost = $_GET['cost_max_range'];
	
	 //Validation for no input entered
	
	if($wine_name == NULL)
	{
		$wine_name = "";
	}
	
	if($region == "All")
	{
		$region = "";
	}
	
	if($winery_name == NULL)
	{
		$winery_name = "";
	}
	
	if($start_year == NULL)
	{
		$start_year = 1950;
	}
	
	if($end_year == NULL)
	{
		$end_year = 2000;
	}
	
	if($min_winestock == NULL)
	{
		$min_winestock = 0;
	}
	
	if($min_customers == NULL)
	{
		$min_customers = 0;
	}
	
	if($min_cost == NULL)
	{
		$min_cost = 0;
	}
	
	if($max_cost == NULL)
	{
		$max_cost	 = 9999;
	}
	
	if($start_year > $end_year)
	{
		echo "<table style='margin-left:529px;margin-top:100px' border='0'>
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
			</table>";
			
			echo "<div style='margin-left:450px;margin-top:70px;font-size:20px'><b>".'Your Start Year Must Be Smaller Than Your End Year!!!'."</b></div>";
			
			echo "</br></br><a style='margin-top:200px;margin-left:450px' href=\"Main Page.php\">Back to Search Form</a><br/><br/>";
	}	
	
	else if($min_cost > $max_cost)
	{
		echo "<table style='margin-left:529px;margin-top:100px' border='0'>
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
			</table>";
			
			echo "<div style='margin-left:410px;margin-top:70px;font-size:20px'><b>".'Your Minimum Cost Must Be Smaller Than Your Maximum Cost!!!'."</b></div>";
			
			echo "</br></br><a style='margin-top:200px;margin-left:410px' href=\"Main Page.php\">Back to Search Form</a><br/><br/>";
	}	
	
	else
	{
	  // (2) Run the query on the winestore through the connection
	  $query = "SELECT wine_name,variety,year,winery_name,region_name,on_hand,cost, 
				(SELECT COUNT(items.cust_id) 
					FROM items 
					WHERE items.wine_id = wine.wine_id) AS No_Cust
				FROM 
				wine,winery,region,wine_variety,grape_variety,inventory
				WHERE 
				wine.winery_id=winery.winery_id
				AND winery.region_id = region.region_id
				AND wine_variety.wine_id = wine.wine_id
				AND wine_variety.variety_id = grape_variety.variety_id
				AND wine.wine_id = inventory.wine_id
				
				AND wine_name LIKE '%".$wine_name."%'
				AND region_name LIKE '%".$region."%'
				AND winery_name LIKE '%".$winery_name."%' 
				AND on_hand >= '".$min_winestock."'
				AND (year BETWEEN '".$start_year."' AND '".$end_year."')
				AND (cost BETWEEN '".$min_cost."' AND '".$max_cost."')				
				HAVING No_Cust >= '".$min_customers."'";
				
				
	  //(1) Open the database connection
	  $connection = mysqli_connect("localhost","root","nigger","winestore");	
	  $result = mysqli_query($connection, $query)
	  or die("Error: ".mysqli_error($connection));
		
	 
	  // Start the HTML body, and output preformatted text
	  if(mysqli_num_rows($result) == 0)
		{
			echo "<table style='margin-left:529px;margin-top:100px' border='0'>
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
			</table>";
			
			echo "<div style='margin-left:520px;margin-top:70px;font-size:20px'><b>".'No Search Results Matching Your Criteria!!!'."</b></div>";
			echo "</br></br><a style='margin-top:200px;margin-left:520px' href=\"Main Page.php\">Back to Search Form</a><br/><br/>";
		}
	  
		  else
		  {
		  echo "<table style='margin-left:529px;margin-top:100px' border='0'>
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
			</table>";
		  echo "<table style='margin-left:130px;margin-top:10px' border='1'>";
		  echo "<tr><th>Wine Name</th>
				<th>Wine Variety</th>
				<th>Year</th>
				<th>Winery Name</th>
				<th>Region Name</th>
				<th>Bottles in Stock</th>
				<th>Minimum Cost</th>
				<th>No of People Who Purchased the Wine</th></tr>";
		
		  while ($row = mysqli_fetch_array($result)) {
			  echo "<tr><td style='text-align:center'>".$row[0]."</td>";
			  echo "<td style='text-align:center'>".$row[1]."</td>";
			  echo "<td>".$row[2]."</td>";
			  echo "<td style='text-align:center'>".$row[3]."</td>";
			  echo "<td style='text-align:center'>".$row[4]."</td>";
			  echo "<td style='text-align:center'>".$row[5]."</td>";
			  echo "<td style='text-align:center'>".$row[6]."</td>";
			  echo "<td style='text-align:center'>".$row['No_Cust']."</td>";
			
		   // Print a carriage return to neaten the output
		   echo "\n";
		  }
		  echo "</td></tr>";
		  echo "</table>";
		  echo "</br><a style='margin-left:130px' href=\"Main Page.php\">Back to Search Form</a><br/><br/>";
		  }	
		
	  // (4) Close the database connection
	  mysqli_close($connection);
	 }
?>
</body>
</html>
