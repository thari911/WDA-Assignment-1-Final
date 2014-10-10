<?php
set_include_path('C:/wamp/bin/php/php5.5.12/pear');
require_once "HTML/Template/IT.php";
require_once "DB.php";
require "db.inc";


$template = new HTML_Template_IT("."); 
$template2 = new HTML_Template_IT(".");
$template3 = new HTML_Template_IT(".");    
$template4 = new HTML_Template_IT(".");     
$template->loadTemplatefile("TemplateD_Results.tpl", true, true);	
$template2->loadTemplatefile("TemplateD_No_Results.tpl",false,false);
$template3->loadTemplatefile("TemplateD_Year_Validation.tpl",false,false);
$template4->loadTemplatefile("TemplateD_Cost_Validation.tpl",false,false);
	 
$dsn = "mysql://{$username}:{$password}@{$hostName}/{$databaseName}";
	$DB = new DB();
	$connection=$DB->connect($dsn);

$wine_name = $_GET['wine_name'];
$region = $_GET['region'];
$winery_name = $_GET['winery_name'];
$start_year = $_GET['start_year'];
$end_year = $_GET['end_year'];
$min_winestock = $_GET['Min_wine_in_stock'];
$min_customers = $_GET['Min_customers'];
$min_cost = $_GET['cost_min_range'];
$max_cost = $_GET['cost_max_range'];
	

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

				 
	$query= "SELECT wine_name,variety,year,winery_name,region_name,on_hand,cost, 
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
  
	@$result=$connection->query($query);
			 
		if($start_year > $end_year)
		{
			$template3->setCurrentBlock("YEAR_VALIDATION");	
		
		$template3->show(); 
		}
		
		else if($min_cost > $max_cost)
		{
			$template4->setCurrentBlock("COST_VALIDATION");	
		
		$template4->show(); 
		}
		
		else if($result->numrows() == 0)
		{
			$template2->setCurrentBlock("RESULT_Failed");	
		
			$template2->parseCurrentBlock(); 	
			
		$template2->show(); 	
		} 	
		else
		{
			while ($regionrow = $result->fetchRow(DB_FETCHMODE_ASSOC))
			{		
				
				$template->setCurrentBlock("RESULT_DETAILS");	
				
				$template->setVariable("WINENAME", $regionrow["wine_name"]);
				$template->setVariable("WINE_VARIETY", $regionrow["variety"]);
				$template->setVariable("YEAR", $regionrow["year"]);
				$template->setVariable("WINERY_NAME", $regionrow["winery_name"]);
				$template->setVariable("REGION_NAME", $regionrow["region_name"]);
				$template->setVariable("ON_HAND", $regionrow["on_hand"]);
				$template->setVariable("MIN_COST", $regionrow["cost"]);
				$template->setVariable("MIN_CUSTOMERS", $regionrow["No_Cust"]);
				 
				$template->parseCurrentBlock(); 
					
			} 
		$template->show();
		}    
		 
	

?>
