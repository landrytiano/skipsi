<?php
include 'job/controller/database.php';
$date=date('Y-m-d');
$query = "SELECT * FROM prediction7 where date='$date'";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);

$GLOBALS['day0']=$row["today_value"];
$GLOBALS['day1']=$row["day1_value"];
$GLOBALS['day2']=$row["day2_value"];
$GLOBALS['day3']=$row["day3_value"];
$GLOBALS['day4']=$row["day4_value"];
$GLOBALS['day5']=$row["day5_value"];
$GLOBALS['day6']=$row["day6_value"];
$GLOBALS['day7']=$row["day7_value"];


function idr_to_usd($value,$position) {
//echo $GLOBALS['$day0'];
        if ($position==0) {
                return $value/$GLOBALS['day0'];
        }elseif ($position==1) {
                return $value/$GLOBALS['day1'];
        }elseif ($position==2) {
                return $value/$GLOBALS['day2'];
        }elseif ($position==3) {
                return $value/$GLOBALS['day3'];
        }elseif ($position==4) {
                return $value/$GLOBALS['day4'];
        }elseif ($position==5) {
                return $value/$GLOBALS['day5'];
        }elseif ($position==6) {
                return $value/$GLOBALS['day6'];
        }elseif ($position==7) {
                return $value/$GLOBALS['day7'];
        }
}
function usd_to_idr($value,$position) {
        if ($position==0) {
                return $value*$GLOBALS['day0'];
        }elseif ($position==1) {
                return $value*$GLOBALS['day1'];
        }elseif ($position==2) {
                return $value*$GLOBALS['day2'];
        }elseif ($position==3) {
                return $value*$GLOBALS['day3'];
        }elseif ($position==4) {
                return $value*$GLOBALS['day4'];
        }elseif ($position==5) {
                return $value*$GLOBALS['day5'];
        }elseif ($position==6) {
                return $value*$GLOBALS['day6'];
        }elseif ($position==7) {
                return $value*$GLOBALS['day7'];
        }
}

$jenis=$_REQUEST['jenis'];
$jumlah=$_REQUEST['jumlah'];
$tanggal=$_REQUEST['tanggal'];

if(empty($jenis)){
     header("location: kalkulasi.php?err=Jenis kalkulasi harus diisi");   
}else if(empty($jumlah)){
        header("location: kalkulasi.php?err=Jumlah harus diisi");
}else if($jumlah<=0 || !is_numeric($jumlah)){
        header("location: kalkulasi.php?err=Jumlah tidak boleh berisi nol atau selain angka");
}else if($tanggal==""){
        header("location: kalkulasi.php?err=Tanggal harus diisi");
}else{

        if (strcmp($jenis,"idr_to_usd")==0) {
                $hasil = idr_to_usd($jumlah,$tanggal);
        }elseif ($jenis=="usd_to_idr") {
                $hasil = usd_to_idr($jumlah,$tanggal);
        }
        header("location: kalkulasi.php?hasil=$hasil&jenis=$jenis&jumlah=$jumlah&tanggal=$tanggal");
}
?>
