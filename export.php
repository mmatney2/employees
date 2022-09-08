<?php
// Checking data by post method
if(isset($_POST["export"])) {
	// Connect to our data base
	$con = mysqli_connect("localhost","root", "", "employees");
	// Accept csv or text files
	header('Content-Type: text/csv; charset=utf-8');
	// Download csv file as geeksdata.csv
	header('Content-Disposition: attachment;filename=employees.csv');
	// Storing data
	$output = fopen("php://output", "w+"); 

   //for retreiving totals by dept.
	$sql  = "SELECT 'Totals By Dept :' FROM `employees` limit 1; ";
	$sql .= "SELECT `dept`, FORMAT(CAST(SUM(salary) as Decimal(13,2)),2)  FROM `employees` GROUP BY `dept` DESC;";
	$sql .= "SELECT null FROM `employees` limit 1; ";

   
	//for retreiving totals by states.
	
	$sql .= "SELECT 'Totals By State :' FROM `employees` limit 1; ";
	$sql .= "SELECT `state`, FORMAT(CAST(SUM(salary) as Decimal(13,2)),2)  FROM `employees` GROUP BY `state` ASC;";
	$sql .= "SELECT null FROM `employees` limit 1; ";

	// //for retreiving overall average salary
	$sql .= "SELECT 'Overall Average Salary :', FORMAT(CAST(AVG(salary) as Decimal(13,2)),2) FROM `employees`;";
	// for retreiving overall total salary
	$sql .= "SELECT 'Overall Total Salary :', FORMAT(CAST(SUM(salary) as Decimal(13,2)),2) FROM `employees`; ";
	$sql .= "SELECT null FROM `employees` limit 1; ";

	//Employees Alphabetical
	$sql .= "SELECT 'Employees Alphabetic:' FROM `employees` limit 1; ";
	$sql .= "SELECT null , `name` FROM `employees` ORDER BY `name` ASC;";
	// Execute multi query
	$lines = [];
	if (mysqli_multi_query($con, $sql)) {
		do { 
		// Store first result set
		if ($result = mysqli_store_result($con)) {		
			while ($row = mysqli_fetch_assoc($result)) {
				fputcsv($output, array_values($row));	
			}			
			mysqli_free_result($result);
		}
		//Prepare next result set
		} while (mysqli_next_result($con));
	}
}
	mysqli_close($con);
  ?>