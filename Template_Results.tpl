<!DOCTYPE HTML PUBLIC
                 "-//W3C//DTD HTML 4.01 Transitional//EN"
                 "http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
  <title>Wine Search Query</title>
<body>
	  	<table style="margin-left:529px;margin-top:100px" border="0">
			<tr>
				<td>
					<img src="../logo.jpg" alt="Mountain View" style="width:150px;height:150px">
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
		  
		<table style="margin-left:130px;margin-top:10px" border='1' >		
		<tr>
			<th>Wine Name</th>
			<th>Wine Variety</th>
			<th>Year</th>
			<th>Winery Name</th>
			<th>Region Name</th>
			<th>Bottles in Stock</th>
			<th>Minimum Cost</th>
			<th>No of People Who Purchased the Wine</th>
		</tr>
		<!-- BEGIN RESULT_DETAILS -->		
		<tr>
			
			<td style='text-align:center'>{WINENAME}</td>
			<td style='text-align:center'>{WINE_VARIETY}</td>
			<td style='text-align:center'>{YEAR}</td>
			<td style='text-align:center'>{WINERY_NAME}</td>
			<td style='text-align:center'>{REGION_NAME}</td>
			<td style='text-align:center'>{ON_HAND}</td>
			<td style='text-align:center'>{MIN_COST}</td>
			<td style='text-align:center'>{MIN_CUSTOMERS}</td>	
			
		</tr>
		<!-- END RESULT_DETAILS -->			
		
	</table>
	
	</br><a style='margin-left:130px' href="PartC_Form.php">Back to Search Form</a><br/><br/>
			 
	  	
</body>
</html>
