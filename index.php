<?php

// Connect syntax
$connect = mysqli_connect("localhost",
	"root", "", "employees");

// Display data from geeksdata table
$query ="SELECT * FROM employees";

// Storing it in result variable
$result = mysqli_query($connect, $query);
?>

// HTML code to display our data
// present in table
<!DOCTYPE html>
<html>

<head>
	<script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
	</script>
	
	<link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	
	<script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
	</script>
</head>

<body>
	<div class="container" style="width:900px;">
		<h2 align="center">Employees Table</h2>

		<h3 align="center">
			Export data into CSV from Data Base
		</h3>
		<br />
		
		<!-- After clicking on submit button
			export.php code is revoked -->
		<form method="post" action="export.php"
			align="center">
			<input type="submit" name="export"
				value="CSV Export"
				class="btn btn-success" />
		</form>
		<br />

		<!-- Code for table because our data is
			displayed in tabular format -->
		<div class="table-responsive" id="employee_table">
			<table class="table table-bordered">
				<tr>
					<th width="5%">name</th>
					<th width="35%">salary</th>
					<th width="10%">dept</th>
					<th width="20%">state</th>
				</tr>
				<?php
				
				// Fetching all data one by one using
				// while loop
				while($row = mysqli_fetch_array($result)) {
				?>
				
				<!-- taking attributes and storing
					in table cells -->
				<tr>
					<!-- column names in table -->
					<td><?php echo $row["name"]; ?></td>
					<td><?php echo $row["salary"]; ?></td>
					<td><?php echo $row["dept"]; ?></td>
					<td><?php echo $row["state"]; ?></td>
				</tr>
				<?php	
				}?>
			</table>
			<!-- Closing table tag -->
		</div>
		<!-- Closing div tag -->
	</div>
</body>

</html>
