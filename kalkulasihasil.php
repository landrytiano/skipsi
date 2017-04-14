<html>
<head>
<title>Result</title> 
</head>
<?php
include '../../job/controller/database.php';
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

function normalizeGold($value) {
        $hi = 0.9;
        $low = 0.1;
        $minGold = 578444;
        $maxGold = 466801;
        return ($hi-$low)*($value-$minGold)/($maxGold-$minGold)+$low;
}

function normalizeOil($value) {
        $hi = 0.9;
        $low = 0.1;
        $minOil = 27.88;
        $maxOil = 67.77;
        return ($hi-$low)*($value-$minOil)/($maxOil-$minOil)+$low;
}

function normalizeInflation($value) {
        $hi = 0.9;
        $low = 0.1;
        $minInflation = 0.0279;
        $maxInflation = 0.0726;
        return ($hi-$low)*($value-$minInflation)/($maxInflation-$minInflation)+$low;
}

function normalizeUsd($value) {
        $hi = 0.9;
        $low = 0.1;
        $minUsd = 9291;
        $maxUsd = 14045;
        return ($hi-$low)*($value-$minUsd)/($maxUsd-$minUsd)+$low;
}

function normalizeCNY($value) {
        $hi = 0.9;
        $low = 0.1;
        $minCNY = 1929.24;
        $maxCNY = 2325.16;
        return ($hi-$low)*($value-$minCNY)/($maxCNY-$minCNY)+$low;
}

function normalizeSGD($value) {
        $hi = 0.9;
        $low = 0.1;
        $maxSGD = 9600;
        $minSGD = 9291.32;
        return ($hi-$low)*($value-$minSGD)/($maxSGD-$minSGD)+$low;
}

function normalizeInterest($value) {
        $hi = 0.9;
        $low = 0.1;
        $minInterest = 11.32;
        $maxInterest = 12.32;
        return ($hi-$low)*($value-$minInterest)/($maxGold-$minInterest)+$low;
}


$matauang=$_REQUEST['matauang'];
$nilai=$_REQUEST['nilai'];
$sgd=$_REQUEST['sgd'];
$cny=$_REQUEST['cny'];
$gold=$_REQUEST['gold'];
$inflation=$_REQUEST['inflation'];
$oil=$_REQUEST['oil'];
$interest=$_REQUEST['interest'];

$usdnorm=normalizeUsd($_REQUEST['nilai']);
$sgdnorm=normalizeSGD($_REQUEST['sgd']);
$cnynorm=normalizeCNY($_REQUEST['cny']);
$goldnorm=normalizeGold($_REQUEST['gold']);
$inflationnorm=normalizeInflation($_REQUEST['inflation']);
$oilnorm=normalizeOil($_REQUEST['oil']);
$interestnorm=normalizeInterest($_REQUEST['interest']);

$train_file = (dirname(__FILE__) . "/currency.net");
if (!is_file($train_file))
  die("The file currency.net has not been created! Please run simple_train.php to generate it" . PHP_EOL);

//usd
$tempusd=array(10);
$tempusdreal=array(10);
$tempusd[0]=0.0;
$ann = fann_create_from_file($train_file);

$input = array($usdnorm,$goldnorm,$oilnorm,$inflationnorm,$interestnorm);
$calc_out = fann_run($ann, $input);
$predictedusd = denormalizeCurrency($calc_out[0]);

header("location: ../../prediksi.php?predictedusd=$predictedusd&matauang=$matauang&nilai=$nilai&gold=$gold&inflation=$inflation&oil=$oil&interest=$interest");

?>

</br>
<a href="input.php">back</a>
</html>
