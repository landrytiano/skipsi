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
        <li><a href="index.php">Beranda</a></li>
        <li class="active"><a href="prediksi.php">Prediksi</a></li>
        <li><a href="kalkulasi.php">Kalkulasi</a></li>
        <li><a href="histori.php">Histori</a></li>
      </ul>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-1 sidenav">
    </div>
    <div class="col-sm-10 text-left"> 

<?php
//echo date("l, d M Y");
$mulai = date("d");
$akhir = date("d")+7;
$selisih = $akhir - $mulai;

$date=date('Y-m-d');
include 'job/controller/database.php';
$query = "SELECT * FROM prediction7 where date='$date'";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);

$query2 = "SELECT * FROM prediction2 order by date desc";
$result2 = $conn->query($query2);
$row2 = mysqli_fetch_assoc($result2);

$row["date"]; echo "\n";
?>

  <h1 align='center'>Prediksi Nilai Tukar Rupiah</h1>
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
  
  <hr>

  <div class='row'>
    <div class="form-group">
      <form action="php-fann/core/predictionondemand.php" method="get">
      <div>
      <label class="col-sm-4 control-label">Jenis Mata Uang</label>
      <div class="col-sm-6">

        <!-- bikin form dalam form -->
        <select class="form-control" id="matauang" name="matauang" selected=''>
          <!-- <option value="2" <?php // ($_GET['my_select'] == "2")? "selected":"";?>>No</options> -->
          <option value="usd">USD</option>
          <option value="sgd">SGD</option>
          <option value="cny">CNY</option>
        </select>
      </div>
      </div>

<?php 
  
  echo $matauang=$_POST["matauang"];


 ?>

      <br><br>
      <div>
      <label class="col-sm-4 control-label">Nilai Rupiah terhadap Jenis Mata Uang</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="usd" name="usd" placeholder="<?php 
          //   if (matauang selected = "usd")==0){
          //     echo $row["usd"]; 
          //   }else if (matauang selected = "sgd")==0){
          //     echo $row["sgd"];  
          //   }else if (matauang selected = "cny")==0 ){
          //     echo $row["cny"];
          //   }
            echo $matauang;
          ?>
        ">
      </div>
      </div>
      <br><br>
      <div>
      <label class="col-sm-4 control-label">Harga Emas</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="gold" name="gold" placeholder="<?php echo $row2["gold"]; ?>">
      </div>
      </div>
      <br><br>
      <div>
      <label class="col-sm-4 control-label">Harga Minyak Mentah</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="oil" name="oil" placeholder="<?php echo $row2["oil"]; ?>">
      </div>
      </div>
      <br><br>
      <div>
      <label class="col-sm-4 control-label">Tingkat Inflasi</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="inflation" name="inflation" placeholder="<?php echo $row2["inflation"]; ?>">
      </div>
      </div>
      <br><br>
      <div>
      <label class="col-sm-4 control-label">Suku Bunga Dasar Kredit</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="interest" name="interest" placeholder="<?php echo $row2["interest"]; ?>">
      </div>
      </div>
      <br><br>
            

      <div class="col-sm-10" align="center">
        <br>
        <button type="submit" class="btn btn-default" value="Submit Button">Prediksi</button>
      </div>
    </form>
    </div>

    </div>




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
