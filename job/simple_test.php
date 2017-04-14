<html>
<head>
<title>Result</title>	
</head>
<?php
$hi = 0.9;
$low = 0.1;
$maxCurr = 14802;
$minCurr = 12502;
$minGold = 578.444;
$maxGold = 466.801;
$minCrude = 27.88;
$maxCrude = 67.77;
$minInfation = 2.79;
$maxInflation = 7.26;
$minSukuBunga = 0.9;
$maxSukuBunga = 0.1;

$currency = $_REQUEST['currency'];
$gold = $_REQUEST['gold'];
$crude = $_REQUEST['crude'];
$inflation = $_REQUEST['inflation'];
$suku = $_REQUEST['suku'];
function normalizeCurrency($value) {
$hi = 0.9;
$low = 0.1;
$maxCurr = 14802;
$minCurr = 12502;
$minGold = 578.444;
$maxGold = 466.801;
$minCrude = 27.88;
$maxCrude = 67.77;
$minInfation = 2.79;
$maxInflation = 7.26;
$minSukuBunga = 0.9;
$maxSukuBunga = 0.1;
	$value = (($hi-$low)*($value-$minCurr)/($maxCurr-$minCurr))+$low;
	return $value;
}
function denormalizeCurrency($value) {
$hi = 0.9;
$low = 0.1;
$maxCurr = 14802;
$minCurr = 12502;
$minGold = 578.444;
$maxGold = 466.801;
$minCrude = 27.88;
$maxCrude = 67.77;
$minInfation = 2.79;
$maxInflation = 7.26;
$minSukuBunga = 0.9;
$maxSukuBunga = 0.1;
	$value = (($value-$low)*($maxCurr-$minCurr)/($hi-$low))+$minCurr;
	return $value;
}
$train_file = (dirname(__FILE__) . "input_coba_float.net");
if (!is_file($train_file))
	die("The file xor_float.net has not been created! Please run simple_train.php to generate it" . PHP_EOL);
$ann = fann_create_from_file($train_file);
if ($ann) {
	$input = array($currency,$gold,$crude,$inflation,$suku);
	
	$calc_out = fann_run($ann, $input);
	for($i=0;$i<7;$i++){
		echo "</br>";
		printf(" \n Currency test %f with value (%f,%f,%f,%f,%f) -> Denormalized value day %d: %f with normalized value : %f\n",denormalizeCurrency($input[0]),$input[0], $input[1], $input[2], $input[3], $input[4],$i+1,denormalizeCurrency($calc_out[$i]),$calc_out[$i]);
	}
	fann_destroy($ann);
} else {
	die("Invalid file format" . PHP_EOL);
}
?>
</br>
<a href="input.php">back</a>
</html>
