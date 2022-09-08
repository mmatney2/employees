<?php
// Checking data by post method
if(isset($_POST["export"])) {
	// Connect to our data base
	$con = mysqli_connect("localhost",
		"root", "", "employees");
	// Accept csv or text files
	header('Content-Type: text/csv; charset=utf-8');
	// Download csv file as geeksdata.csv
	header('Content-Disposition: attachment;filename=employees.csv');
	// Storing data
	$output = fopen("php://output", "w"); 
	fputcsv($output, array('Marketing', 'IST', 'Accounting'));
	$sql = "SELECT SUM(salary) FROM `employees` GROUP BY `dept` DESC;";

	// fputcsv($output, array('Totals By State'));
	$sql .= "SELECT SUM(salary) 'Totals By State' FROM `employees` GROUP BY `state` ASC;";

	// fputcsv($output, array('Overall Average Salary'));
	$sql .= "SELECT ROUND(AVG(salary), 2) 'Overall Average Salary' FROM `employees`;";

	// fputcsv($output, array('Overall Total Salary'));
	$sql .= "SELECT SUM(salary) 'Overall Total Salary' FROM `employees`;";

	// fputcsv($output, array('Employees Alphabetic'));
	$sql .= "SELECT `name` 'Employees Alphabetic' FROM `employees`;";
	// Execute multi query
	if (mysqli_multi_query($con, $sql)) {
		do {
		// Store first result set
		if ($result = mysqli_store_result($con)) {
			while ($row = mysqli_fetch_row($result)) {
			printf("%s\n", $row[0]);
			}
			mysqli_free_result($result);
		}
		// if there are more result-sets, the print a divider
		if (mysqli_more_results($con)) {
			printf("-----------\n");
		  }
		//Prepare next result set
		} while (mysqli_next_result($con));
	}
}
	mysqli_close($con);
  ?>