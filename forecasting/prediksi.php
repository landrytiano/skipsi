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
      height: 600px;
      margin-top:50px;

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
      padding: 1rem;
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
<!--      <div class="well">
      <p><a href="#">Link</a></p>
      </div>
      <div class="well">
      <p><a href="#">Link</a></p>
      </div>
      <div class="well">
      <p><a href="#">Link</a></p>
      </div>
    -->
    </div>
    <div class="col-sm-10 text-left"> 
      <h1 align='center'>Prediksi Nilai Tukar Rupiah</h1>
      <div class='row'>
        <div class='col-sm-2'></div>
        <div class='col-sm-2'><h6>Mata Uang</h6></div>
        <div class='col-sm-2'><h6>Tanggal Mulai</h6></div>
        <div class='col-sm-2'><h6>Tanggal Akhir</h6></div>
        <div class='col-sm-2'></div>
        
      <form action="prediksi.php" method="get">
        </div>
        <div class='row'>
          <div class='col-sm-2'></div>
          <div class='col-sm-2'>          
            <select class="form-control" id="matauang" name="matauang" selected=''>
              <option value="all"  >ALL</option>
              <option value="usd"  >USD</option>
              <option value="sgd"  >SGD</option>
              <option value="cny"  >CNY</option>
            </select>
          </div>
          <div class='col-sm-2'>
            <select class="form-control" id="mulai" name="mulai" selected=''>
              <?php for ($i=0; $i < 7; $i++) { ?>
                <option value="<?php echo date("j")+$i; echo date(" M Y");?>"><?php echo date("j")+$i; echo date(" M Y");?></option>
              <?php } ?>
            </select>
          </div>
          <div class='col-sm-2'>
            <select class="form-control" id="akhir" name="akhir" selected=''>
              <?php for ($i=7; $i >= 0; $i--) { ?>
                <option value="<?php echo date("j")+$i; echo date(" M Y");?>"><?php echo date("j")+$i; echo date(" M Y");?></option>
              <?php } ?>
            </select>
          </div>
          <div class='col-sm-2'>
            <button type="submit " class="btn btn-default" value="Submit Button">Prediksi Sekarang</button>
          </div>
        </div>
      </form>
		<hr>


            <?php

            echo $matauang = $_GET['matauang']; 
            echo $mulai = $_GET['mulai'];
            echo $akhir = $_GET['akhir'];
            
            echo "\n";
            echo $selisih = $akhir - $mulai;

            //Database
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "fann";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else{
              echo "Connected successfully ";
            }

            $query = sprintf("select * from prediction");
            $hasil = mysql_query($query);

            if (!$hasil) {
              $pesan = 'invalid query: '.mysql_error()."\n";
              $pesan = 'query: '.$query;
              die($pesan);
              }

              while ($row=mysql_fetch_assoc($hasil)) {
                echo $row['date'];
              }
                mysql_free_result($hasil);
            ?>


      <h4 align='left'>Hasil Prediksi Anda</h4>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Mata Uang</th>
            <?php 
              for ($e=0; $e < $selisih; $e++) { 
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
          <tr>

          <?php 
                include_once('simple_html_dom.php');
                $usd = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
                $usdtable = $usd->find('div.s4-ca',0);
                $usdb4trim = $usdtable->find('table.table1',0)->find('tbody tr',23)->find('td',2);            

                $sgd = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
                $sgdtable = $sgd->find('div.s4-ca',0);
                $sgdb4trim = $sgdtable->find('table.table1',0)->find('tbody tr',21)->find('td',2);

                $cny = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
                $cnytable = $cny->find('div.s4-ca',0);
                $cnyb4trim = $cnytable->find('table.table1',0)->find('tbody tr',5)->find('td',2);

                if (strcmp($matauang,"usd")==0){
           ?>

            <td >USA Dollar (USD)</td>
            <?php
              for ($e=0; $e < $selisih; $e++) { 
                echo $usdb4trim;
              }
            ?>
          </tr>
          <?php 
            }else if (strcmp($matauang,"sgd")==0){
           ?>
          <tr>
            <td>Singapore Dollar (SGD)</td>
              <?php 
                for ($e=0; $e < $selisih; $e++) { 
                  echo $sgdb4trim; 
                }
              ?>
          </tr>
          <?php 
            }else if (strcmp($matauang,"cny")==0){
           ?>
          <tr align='left'>
            <td>China Yuan (CNY)</td>
              <?php
                for ($e=0; $e < $selisih; $e++) { 
                  echo $cnyb4trim;
                }
              ?>
          </tr>
          <?php 
            }else{
           ?>
          <td >USA Dollar (USD)</td>
            <?php
              for ($e=0; $e < $selisih; $e++) { 
                  echo $usdb4trim; 
              }
            ?>
          </tr>
          <tr>
            <td>Singapore Dollar (SGD)</td>
              <?php
                for ($e=0; $e < $selisih; $e++) { 
                  echo $sgdb4trim;
                }
              ?>
          </tr>
          <tr align='left'>
            <td>China Yuan (CNY)</td>
              <?php 
                for ($e=0; $e < $selisih; $e++) { 
                  echo $cnyb4trim;
                }
              ?>
          </tr>
          <?php } ?>

        </tbody>
      </table>

    </div>
    <div class="col-sm-1 sidenav">
<!--      <div class="well">
        <p>ADS</p>
      </div>
      <div class="well">
        <p>ADS</p>
      </div>
    -->
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p><a href="tentang.php">Tentang Kami</a> | DJL &#169; 2017</p>
</footer>

</body>
</html>
