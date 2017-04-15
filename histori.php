<!DOCTYPE html>
<html lang="en">
<head>
  <title>Prediksi Nilai Tukar</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="diagram.js"></script>
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
        <li><a href="kalkulasi.php">Kalkulasi</a></li>
        <li class="active"><a href="histori.php">Histori</a></li>
      </ul>
  </div>
</nav>

<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-1 sidenav"></div>
    <div class="col-sm-10 text-left"> 
      <h1 align='center'>Histori</h1>
        <div class="row"><form action="prediksi.php" method="get"></div>
        <div class='row'>
          <div class='col-sm-2'></div>
          <div class='col-sm-2'>          
            <?php echo $_GET['matauang']; ?>
            <select class="form-control" id="matauang">
              <option value="all">ALL</option>
              <option value="usd">USD</option>
              <option value="sgd">SGD</option>
              <option value="cny">CNY</option>
            </select>
          </div>

<?php 
  
echo  $tahun_now = date("Y");
echo  $bulan_now = date("M");

 echo $tahun_start = "2015";
echo  $bulan_start = "1";

echo  $selisih_tahun=$tahun_now-$tahun_start;


 ?>

          <div class='col-sm-2'>
            <select class="form-control" id="mulai">
              <?php for ($i=0; $i <= $selisih_tahun; $i++) { ?>
                <option value="<?php echo $tahun_start+$i; ?>"><?php echo $tahun_start+$i;?></option>
              <?php } ?>
            </select>
          </div>
          <div class='col-sm-2'>
            <select class="form-control" id="akhir">
              <?php for ($i=$selisih_tahun; $i >= 0; $i--) { ?>
                <option value="<?php echo $tahun_now-$i;?>"><?php echo $tahun_now-$i;?></option>
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

  include 'job/controller/database.php';
  $query = "";//SELECT * FROM prediction2 order by date desc";
  $result = $conn->query($query);
  if (mysqli_num_rows($result)>0) {
?>
      <div class="col-md-12">
      <table class="table table-bordered">
        <thead  align="center">
          <tr>
            <th>Tanggal</th>
            <th>USD</th>
            <th>SGD</th>
            <th>CNY</th>
            <th>Emas</th>
            <th>Minyak</th>
            <th>Tingkat Inflasi</th>
            <th>Suku Bunga</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)) { ?>
          <tr align="center">
            <td><?php echo $row["date"] ?></td>
            <td><?php echo "Rp.".$row["usd"] ?></td>
            <td><?php echo "Rp.".$row["sgd"] ?></td>
            <td><?php echo "Rp.".$row["cny"] ?></td>
            <td><?php echo $row["gold"] ?></td>
            <td><?php echo $row["oil"] ?></td>
            <td><?php echo $row["inflation"] ?></td>
            <td><?php echo $row["interest"] ?></td>            
          </tr>
          <?php 
            }
          }else {
            echo "0 Result"; 
        } 
          ?>
        </tbody>
      </table>
      </div>
          <!-- <div class="col-md-10">
              <div id="area-example" style="height:300px;"></div>
          </div>
           -->
    </div>
        
      <br><br> 
    <div class="col-sm-1 sidenav"></div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p><a href="tentang.php">Tentang Kami</a> | DJL &#169; 2017</p>
</footer>

</body>
</html>
