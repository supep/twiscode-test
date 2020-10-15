<?php

$response = ['code' => 1];
if(!isset($_GET['number']))
{
	$response['code'] = 0;
	$response['message'] = 'Input is empty';
	echo json_encode($response);
	exit;
}
$number = $_GET['number'];
//check number
if(!is_numeric($number))
{
	$response['code'] = 0;
	$response['message'] = 'Input is not numeric';
	echo json_encode($response);
	exit;
}
//check option
if(isset($_GET['option']) && $_GET['option'] != 'decbin' && $_GET['option'] != 'bindec')
{
	$response['code'] = 0;
	$response['message'] = 'Unknown option';
	echo json_encode($response);
	exit;
}
//Decimal to binary
if(isset($_GET['option']) && $_GET['option'] == 'decbin')
{
	$number = (int)$number;
	$binary = '';
	do
	{
		$remain = $number%2;
		$number = floor($number/2);
		$binary = $remain . $binary;
	} while($number!=0);
	$response['output'] = $binary;
}
//binary to decimal
else
{
	$number = (string)$number;
	$pangkat = 0;
	$decimal = 0;
	for($i = strlen($number)-1; $i>=0; $i--)
	{
		if($number[$i]>1)
		{
			$response['code'] = 0;
			$response['message'] = 'Input is not binary';
			echo json_encode($response);
			exit;
		}
		if($number[$i] == '1')
		{
			$decimal += pow(2, $pangkat);
		}
		$pangkat++;
	}
	$response['output'] = $decimal;
}
echo json_encode($response);

?>