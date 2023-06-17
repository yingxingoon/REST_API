<?php
header("Content-Type:application/json");
if (
	(isset($_POST['employeeID']) && isset($_POST['employeeName']) && isset($_POST['date']) &&
	($_POST['employeeType'] == "fullTime") && isset($_POST['basicSalary']) && isset($_POST['bonus']) &&
	isset($_POST['overtimeNum']) && isset($_POST['overtimeRate']) && isset($_POST['earlyOut']) &&
	isset($_POST['lateness']))

	||

	(isset($_POST['employeeID']) && isset($_POST['employeeName']) && isset($_POST['date']) && 
	($_POST['employeeType'] == "partTime") && isset($_POST['hoursWorked']) && isset($_POST['hourlyRate']))
) {
	
	$employeeID = $_POST['employeeID'];
	$employeeName = $_POST['employeeName'];
	$date = $_POST['date'];
	$employeeType = $_POST['employeeType'];

	if($employeeType == "fullTime"){
		$basicSalary = $_POST['basicSalary'];
		$bonus = $_POST['bonus'];
		$overtimeNum = $_POST['overtimeNum'];
		$overtimeRate = $_POST['overtimeRate'];
		$earlyOut = $_POST['earlyOut'];
		$lateness = $_POST['lateness'];   

		$overtime = $overtimeNum * $overtimeRate;
		$deduct = $earlyOut + $lateness;

		$netCalSalary = $basicSalary + $bonus + ($overtime) - $deduct;
		

		$output = array(
			'employeeID' => $employeeID,
			'employeeName' => $employeeName,
			'date' => $date,
			'employeeType' => $employeeType,
			'netCalSalary' => $netCalSalary
		);
		response($output, 200, "Calculated-Full Time");

	} else{
		$hoursWorked = $_POST['hoursWorked'];
		$hourlyRate = $_POST['hourlyRate'];

		$netCalSalary = $hoursWorked * $hourlyRate;
		
		$output = array(
			'employeeID' => $employeeID,
			'employeeName' => $employeeName,
			'date' => $date,
			'employeeType' => $employeeType,
			'netCalSalary' => $netCalSalary
		);
		response($output, 200, "Calculated-Part Time");
	}
} else {
	response(NULL, 400, "Invalid Request");
}

function response($output, $code, $message)
{
    // Set the response header and status code
    http_response_code($code);

    // Construct the response array
    $response = array(
        'output' => $output,
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
