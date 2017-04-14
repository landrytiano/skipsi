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
        <li><a href="prediksi.php">Prediksi</a></li>
        <li class="active"><a href="kalkulasi.php">Kalkulasi</a></li>
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
            <td >USA Dollar (USD)</td>
            <?php 
                include_once('simple_html_dom.php');
                $usd = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
                $usdtable = $usd->find('div.s4-ca',0);
                $usdb4trim = $usdtable->find('table.table1',0)->find('tbody tr',23)->find('td',2);
                echo $usdb4trim;
            ?>
          </tr>
          <tr>
            <td>Singapore Dollar (SGD)</td>
              <?php 
                $sgd = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
                $sgdtable = $sgd->find('div.s4-ca',0);
                $sgdb4trim = $sgdtable->find('table.table1',0)->find('tbody tr',21)->find('td',2);
                echo $sgdb4trim;
               ?>
          </tr>
          <tr align='left'>
            <td>China Yuan (CNY)</td>
              <?php 
                $cny = file_get_html('http://www.bi.go.id/en/moneter/informasi-kurs/transaksi-bi/Default.aspx');
                $cnytable = $cny->find('div.s4-ca',0);
                $cnyb4trim = $cnytable->find('table.table1',0)->find('tbody tr',5)->find('td',2);
                echo $cnyb4trim;
               ?>
          </tr>
        </tbody>
      </table>

      <hr>
      <h4 align='left'>Kalkulasi</h4>
      <h5>Silakan masukkan yang ingin anda kalkulasi:</h5>
      <div class='row'>
      <div class="form-group">
        <form action="kalkulasi.php" method="get">
        <div>
        <label class="col-sm-2 control-label">Jenis Mata Uang</label>
        <div class="col-sm-8">
          <select class="form-control" id="matauang" name="matauang" selected=''>
            <option value="all">ALL</option>
            <option value="usd">USD</option>
            <option value="sgd">SGD</option>
            <option value="cny">CNY</option>
          </select>
        </div>
        </div>
        <br><br>
        <div>
        <label class="col-sm-2 control-label">Jenis Kalkulasi</label>
        <div class="col-sm-8">
          <select class="form-control" id="matauang" name="matauang" selected=''>
            <option value="all">Rupiah -> USD</option>
            <option value="all">Rupiah -> SGD</option>
            <option value="all">Rupiah -> CNY</option>
            <option value="usd">USD -> Rupiah</option>
            <option value="sgd">SGD -> Rupiah</option>
            <option value="cny">CNY -> Rupiah</option>
          </select>
        </div>
        </div>
        <br><br>
        <div>
        <label class="col-sm-2 control-label">Jumlah Rupiah</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="usr">
        </div>
        </div>
        <br><br>
        <div>
        <label class="col-sm-2 control-label">Tanggal Prediksi</label>
        <div class="col-sm-8">
          <select class="form-control" id="mulai">
            <?php for ($i=1; $i <= 7; $i++) { ?>
              <option value="<?php echo date("j")+$i; echo date(" M Y");?>"><?php echo date("j")+$i; echo date(" M Y");?></option>
            <?php } ?>
          </select>
        </div>
        </div>
        <br><br>
        <div class="col-sm-12" align="center">
          <button type="submit " class="btn btn-default" value="Submit Button">Kalkulasi Sekarang</button>
        </div>
      </form>
      </div>

      </div>
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

<footer class="container-fluid text-center">
  <p><a href="tentang.php">Tentang Kami</a> | DJL &#169; 2017</p>
</footer>

</body>
</html>
