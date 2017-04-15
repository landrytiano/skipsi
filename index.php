<?php include 'job/controller/database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prediksi Nilai Tukar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 100;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {
      height: 100%;
      margin-top:50px;
      margin-bottom: 50px;
    }
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: black;
      color: white;
      position: fixed;
      right: 0;
      bottom: 0;
      left: 0;
      padding-top: 6px;
      width: auto;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }

    .morris-hover{position:absolute;z-index:1000}.morris-hover.morris-default-style{border-radius:10px;padding:6px;color:#666;background:rgba(255,255,255,0.8);border:solid 2px rgba(230,230,230,0.8);font-family:sans-serif;font-size:12px;text-align:center}.morris-hover.morris-default-style .morris-hover-row-label{font-weight:bold;margin:0.25em 0}
    .morris-hover.morris-default-style .morris-hover-point{white-space:nowrap;margin:0.1em 0}

  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Beranda</a></li>
        <li><a href="prediksi.php">Prediksi</a></li>
        <li><a href="kalkulasi.php">Kalkulasi</a></li>
        <li><a href="histori.php">Histori</a></li>
      </ul>
  </div>
</nav>
<?php 

$query = "SELECT * FROM prediction2 order by date desc limit 1";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);

 ?>  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-1 sidenav"></div>
    <div class="col-sm-10 text-left"> 
      <h1 align='center'>Prediksi Nilai Tukar Rupiah</h1>
      <h4 align='left'>Harga Hari Ini</h4>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Mata Uang</th>
            <th>
              <?php 
                echo date("l, d M Y");
               ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>USA Dollar (USD)</td>
            <td>IDR 
            <?php 
                echo $row["usd"];
            ?>
            </td> 
          </tr>
          <tr>
            <td>Singapore Dollar (SGD)</td>
              <td>IDR 
            <?php 
                echo $row["sgd"];

            ?>
            </td> 
          </tr>
          <tr align='left'>
            <td>China Yuan (CNY)</td>
             <td>IDR 
            <?php 
                echo $row["cny"];

            ?>
            </td> 
          </tr>
        </tbody>
      </table>
      <hr>

<?php
//echo date("l, d M Y");
$mulai = date("d");
$akhir = date("d")+7;
$selisih = $akhir - $mulai;

// include_once('simple_html_dom.php');
// $usd = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
// $usdtable = $usd->find('div.s4-ca',0);
// $usdb4trim = $usdtable->find('table.table1',0)->find('tbody tr',24)->find('td',2);            

// $sgd = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
// $sgdtable = $sgd->find('div.s4-ca',0);
// $sgdb4trim = $sgdtable->find('table.table1',0)->find('tbody tr',21)->find('td',2);

// $cny = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
// $cnytable = $cny->find('div.s4-ca',0);
// $cnyb4trim = $cnytable->find('table.table1',0)->find('tbody tr',5)->find('td',2);
$date=date('Y-m-d');
$query = "SELECT * FROM prediction7 where date='$date'";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);

$query2 = "SELECT * FROM prediction2 order by date desc";
$result2 = $conn->query($query2);
$row2 = mysqli_fetch_assoc($result2);

//while($row = mysqli_fetch_assoc($result)) {echo $row["usd"]; echo "\n";}

$row["date"]; echo "\n";
?>

      <h4 align='left'>Prediksi</h4>
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">USA Dollar (USD)</a>
            </h4>
          </div>
          <div id="collapse1" class="panel-collapse collapse in">
            <div class="panel-body">
            <table class="table">
            <thead align="right">
              <tr>
                <?php 
                  for ($e=0; $e <= $selisih; $e++) { 
                 ?>
                <th align="center">
                  <?php 
                    echo date("j")+$e; echo date(" M Y");
                   ?>
                </th>
                <?php } ?>
              </tr>
            </thead>
              <tbody>
              <tr align="left">
                <td><?php echo $row["today_value"]; echo "\n";?></td>
                <td><?php echo $row["day1_value"]; echo "\n";?></td>
                <td><?php echo $row["day2_value"]; echo "\n";?></td>
                <td><?php echo $row["day3_value"]; echo "\n";?></td>
                <td><?php echo $row["day4_value"]; echo "\n";?></td>
                <td><?php echo $row["day5_value"]; echo "\n";?></td>
                <td><?php echo $row["day6_value"]; echo "\n";?></td>
                <td><?php echo $row["day7_value"]; echo "\n";?></td>
              </tr>
            </tbody>
            </table>  
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Singapore Dollar (SGD)</a>
            </h4>
          </div>
          <div id="collapse2" class="panel-collapse collapse">
            <div class="panel-body">
              <table class="table">
            <thead>
              <tr align="center">
                <?php 
                  for ($e=0; $e <= $selisih; $e++) { 
                 ?>
                <th>
                  <?php 
                    echo date("j")+$e; echo date(" M Y");
                   ?>
                </th>
                <?php } ?>
              </tr>
            </thead>
              <tbody>
              <tr align="left">
                <?php
                  for ($e=0; $e <= $selisih; $e++) { 
                ?>
                <td>
                <?php
                    //data prediksi ini nantinya akan dibuat 1 row untuk 7 hari berikutnya, select by day yang increment 
                    echo $row2["sgd"];
                  ?>
                </td>
                  <?php
                  }
                ?>
              </tr>
            </tbody>
            </table>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">China Yuan (CNY)</a>
            </h4>
          </div>
          <div id="collapse3" class="panel-collapse collapse">
            <div class="panel-body">
              <table class="table">
            <thead>
              <tr align="center">
                <?php 
                  for ($e=0; $e <= $selisih; $e++) { 
                 ?>
                <th>
                  <?php 
                    echo date("j")+$e; echo date(" M Y");
                   ?>
                </th>
                <?php } ?>
              </tr>
            </thead>
              <tbody>
              <tr align="left">
                <?php
                  for ($e=0; $e <= $selisih; $e++) { 
                ?>
                <td>
                <?php
                    //data prediksi ini nantinya akan dibuat 1 row untuk 7 hari berikutnya, select by day yang increment 
                    echo $row2["cny"];
                  ?>
                </td>
                  <?php
                  }
                ?>
              </tr>
            </tbody>
            </table>
            </div>
          </div>
        </div>
      </div> 
      <div class='row'>
      <form action="prediksi.php" method="get">
        </div>
        <div class='row'>
          <div class='col-sm-5'></div>
          <div class='col-sm-2'>
            <button class="btn btn-default" value="Submit Button">Prediksi Manual</button>
          </div>
        </div>
      </form>



    </div>
    <div class="col-sm-1 sidenav">

    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p><a href="tentang.php">Tentang Kami</a> | DJL &#169; 2017</p>
</footer>

</body>
</html>
