<?php
$response = ['code' => 1];
if(!isset($_GET['string']))
{
	$response['code'] = 0;
	$response['message'] = 'Input is empty';
	echo json_encode($response);
	exit;
}
$string = $_GET['string'];
//hapus spasi

// get length of input string 
$length = strlen($string);
$found = [];
$pal = [];
for($i = 0; $i<$length;$i++)
{
	for($j = 0; $j<=$length; $j++)
	{
		$sub = substr($string, $i, $j-$i);
		$sub = str_replace(' ', '', $sub);
		$sub = strtolower($sub);
		$rev = strrev($sub);
		if($sub != '')
		{
			if(isset($found[$rev]))
			{
				$oldEnd = $found[$rev]['end'];
				if(($i - $oldEnd) <= 2)
				{
					$found[$rev]['end'] = $j;
					$pal[count($pal)] = $rev;
				}
			}
			elseif(!isset($found[$sub]))
			{
				$found[$sub] = [
					'start' => $i, 
					'end' => $j
				];
			}
		}
	}
}
$longest = 0;
$output = '';
foreach($pal as $p)
{
	$check = substr($string, $found[$p]['start'], $found[$p]['end']-$found[$p]['start']);
	if($output != '')
	{
		if($found[$p]['end']-$found[$p]['start'] > $longest)
		{
			$output = $check;
			$longest = $found[$p]['end']-$found[$p]['start'];
		}
	}
	else
	{
		$output = $check;
		$longest = $found[$p]['end']-$found[$p]['start'];
	}
}
$response['output'] = $output;
echo json_encode($response);
?>