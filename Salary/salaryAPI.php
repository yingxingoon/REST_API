<?php
header("Content-Type:application/json");
if ((isset($_POST['employeeID']) && $_POST['employeeName'] && $_POST['date'] && $_POST['employeType'] 
&& $_POST['basicSalary'] && $_POST['bonus'] && $_POST['overtimeNum'] && $_POST['overtimeRate'] && $_POST['earlyOut'] 
&& $_POST['lateness']) || (isset($_POST['employeeID']) && $_POST['employeeName'] && $_POST['date'] 
&& $_POST['employeType'] && $_POST['hoursWorked'] && $_POST['hourlyRate']) != "") {
	
	include('db.php');
	$employeeID = $_POST['employeeID'];
	$employeeName = $_POST['employeeName'];
	$date = $_POST['Date'];
	$employeeType = $_POST['employeeType'];

	if($employeeType == "fullTime"){
		$basicSalary = $_POST['basicSalary'];
		$bonus = $_POST['bonus'];
		$overtimeNum = $_POST['overtimeNum'];
		$overtimeRate = $_POST['overtimeRate'];
		$earlyOut = $_POST['earlyOut'];
		$lateness = $_POST['lateness'];   

		$netCalSalary = &$basicSalary + $bonus + ($overtimeNum * $overtimeRate) - $earlyOut - $lateness;
		response($netSalary, 200, $netCalSalary);

		$query = "INSERT INTO salaryReport (employeeID, employeeName, employeeType, salDate, netCalSalary) VALUES ($employeeID, '$employeeName', '$employeeType', $date, $netCalSalary)";
		if(mysqli_query($con, $query)){
			response(null, 200, "Data inserted successfully");
		} else{
			response(null, 400, "Error");
		}
	} else{
		$hoursWorked = $_POST['hoursWorked'];
		$hourlyRate = $_POST['hourlyRate'];

		$netCalSalary = $hoursWorked * $hourlyRate;
		response($netSalary, 200, $netCalSalary);

		$query = "INSERT INTO salaryReport (employeeID, employeeName, employeeType, salDate, netCalSalary) VALUES ($employeeID, '$employeeName', '$employeeType', $date, $netCalSalary)";
		if(mysqli_query($con, $query)){
			response(null, 200, "Data inserted successfully");
		} else{
			response(null, 400, "Error");
		}

	}
} else {
	response(NULL, 400, "Invalid Request");
}

function response($username, $code, $message)
{
    // Set the response header and status code
    http_response_code($code);

    // Construct the response array
    $response = array(
        'username' => $username,
        'code' => $code,
        'message' => $message
    );

    // Convert the response array to JSON
    $json_response = json_encode($response);

    // Set the Content-Type header to JSON
    header('Content-Type: application/json');

    // Echo the JSON response
    echo $json_response;
}

//curl -X POST -d "username=user&password=password" http://localhost/REST_API/login/api.php
