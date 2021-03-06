<html>
<?php
include 'controller/database.php';
include_once('simple_html_dom.php');
//echo filter_var($emasb4trim, FILTER_SANITIZE_NUMBER_INT)+5;

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
	$minUsd = 12000;
	$maxUsd = 15000;
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

$emas = file_get_html('http://harga-emas.org');
$emas2=$emas->find('div.col-md-8',0);
$emasb4trim = $emas2->find('table tbody tr',3)->find('td',3);
echo "Goldd : ";
echo $emasb4trim;
$emastrim = filter_var(str_replace('.','',substr($emasb4trim, 0 ,strpos($emasb4trim, ' ('))), FILTER_SANITIZE_NUMBER_INT);
echo "<br>"; echo $emastrim; echo "<br>";
echo $gold_norm = normalizeGold($emastrim);

echo "<br>inflation : <br>";
//inflasii
$html1 = file_get_html('http://www.bi.go.id/id/moneter/inflasi/data/');
$tabel1 = $html1->find('div.s4-ca',0);
$inflation = $html1->find('center table.table1',0)->find('tbody tr',1)->find('td',1);
echo  $inflationtrim = strip_tags(str_replace(' ','',str_replace(' %','',$inflation)))/100;
echo "<br>";
echo $inflation_norm = normalizeInflation($inflationtrim);
//USD
echo "<br>USD : <br>";
$usd = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
$usdtable = $usd->find('div.s4-ca',0);
$usdb4trim = $usdtable->find('table.table1',0)->find('tbody tr',24)->find('td',2);
$usdtrim = strip_tags(str_replace('.00','',str_replace(',','', $usdb4trim))); 
echo $usdtrim;
echo "<br>";
echo $usd_norm = normalizeUsd($usdtrim);
//CNY
echo "<br>CNY : <br>";
$cny = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
$cnytable = $cny->find('div.s4-ca',0);
$cnyb4trim = $cnytable->find('table.table1',0)->find('tbody tr',6)->find('td',2);
$cnytrim = strip_tags(str_replace('.00','',str_replace(',','', $cnyb4trim))); 
echo $cnytrim;
echo "<br>";
echo $cny_norm = normalizeCNY($cnytrim);
//SGD
echo "<br>SGD : <br>";
$sgd = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
$sgdtable = $sgd->find('div.s4-ca',0);
$sgdb4trim = $sgdtable->find('table.table1',0)->find('tbody tr',22)->find('td',2);
$sgdtrim = strip_tags(str_replace('.00','',str_replace(',','', $sgdb4trim))); 
echo $sgdtrim;
echo "<br>";
echo $sgd_norm = normalizeSGD($sgdtrim);

//SBDK
echo "<br>SBDK : <br>";
$get_sbdk = file_get_html('http://www.bi.go.id/id/perbankan/suku-bunga-dasar/Default.aspx');
$sbdk = $get_sbdk->find('div.s4-ca',0);
$sbdk_b4_trim = $sbdk->find('table tbody tr td.s4-wpcell-plain table.s4-wpTopTable tbody tr td div.ms-WPBody div',2)->find('div table tbody tr', 3)->find('td',1);
echo $esbdktrim = str_replace('&#160;','',strip_tags($sbdk_b4_trim));
echo "<br>";
echo $interest_norm = normalizeInterest($esbdktrim);
//OIL

echo "<br>OIL : <br>";
$oil = file_get_html('http://hargaminyak.net/');
$oil2=$oil->find('table.in_table',0);
$oilb4trim = $oil2->find('tbody tr',3)->find('td',2);
echo $oiltrim = strip_tags(str_replace(',','.',$oilb4trim));
echo "<br>";
echo $oil_norm=normalizeOil($oiltrim);

$date=date("Y-m-d");

$query = "INSERT INTO `prediction2` (`date`, `usd`, `norm_usd`, `sgd`, `norm_sgd`, `cny`, `norm_cny`, `gold`, `norm_gold`, `inflation`, `norm_inflation`,`oil`,`norm_oil`,`interest`,`norm_interest`)
VALUES('$date', $usdtrim, $usd_norm, $sgdtrim, $sgd_norm, $cnytrim, $cny_norm, $emastrim, $gold_norm, $inflationtrim, $inflation_norm, $oiltrim, $oil_norm,$esbdktrim,$interest_norm)";
echo "<br>".$query;
if ($conn->query($query) === TRUE) {
    echo "New record created successfully";
    //header("Location: http://31.220.56.139/php-fann/core/prediction7.php?usd=".$norm_usd);
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
    //header("Location: http://31.220.56.139/php-fann/core/prediction7.php?usd=".$norm_usd."");
}
echo "<br> To Prediction7...";
//header("Location: ../php-fann/core/prediction7.php?usd=$usd_norm&sgd=$sgd_norm&cny=$sgd_norm&gold=$gold_norm&inflation=$inflation_norm&oil=$oil_norm&interest=$interest_norm");
//echo "<script type=\"text/javascript\">document.location.replace(\"../php-fann/core/prediction7.php?usd=$usd_norm&sgd=$sgd_norm&cny=$sgd_norm&gold=$gold_norm&inflation=$inflation_norm&oil=$oil_norm&interest=$interest_norm\");</script>";
//echo "<script type=\"text/javascript\">document.location.replace(\"http:\/\/localhost\/php-fann/core/prediction7.php?usd=$usd_norm&sgd=$sgd_norm&cny=$sgd_norm&gold=$gold_norm&inflation=$inflation_norm&oil=$oil_norm&interest=$interest_norm\");</script>";
?>
</html>