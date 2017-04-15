<?php include 'header.php' ?>  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-1 sidenav">
    </div>
    <div class="col-sm-10 text-left"> 

    <h1 align='center'>Prediksi Nilai Tukar Rupiah</h1>

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

$predictedusd=$_REQUEST['predictedusd'];
$matauang=$_REQUEST['matauang'];
$nilai=$_REQUEST['nilai'];
$gold=$_REQUEST['gold'];
$oil=$_REQUEST['oil'];
$inflation=$_REQUEST['inflation'];
$interest=$_REQUEST['interest'];


if ($nilai=='' or $gold=='' or $oil=='' or $inflation=='' or $interest=='') { 
}else{
?>
        <h4 align='left'>Hasil Prediksi</h4>
        <table class="table table-bordered">
          <tr>
            <td>Jenis Mata Uang</td>
            <td><?php echo $matauang ?></td>
          </tr>
          <tr>
            <td>Nilai Rupiah terhadap Jenis Mata Uang</td>
            <td><?php echo $nilai ?></td>
          </tr>
          <tr>
            <td>Harga Emas</td>
            <td><?php echo $gold ?></td>
          </tr>
          <tr>
            <td>Harga Minyak Mentah</td>
            <td><?php echo $oil ?></td>
          </tr>
          <tr>
            <td>Tingkat Inflasi</td>
            <td><?php echo $inflation ?></td>
          </tr>
          <tr>
            <td>Suku Bunga Dasar Kredit</td>
            <td><?php echo $interest ?></td>
          </tr>
          <tr>
            <td>Nilai Rupiah terhadap <?php echo $matauang; ?></td>
            <td><?php echo $predictedusd ?></td>
          </tr>                                        
      </table>
    <hr>
  <?php } ?>

  <h4 align='left'>Prediksi Manual</h4>
  <div class='row'>
    <div class="form-group">
      <form action="php-fann/core/predictionondemand.php" method="get">
      <div>
      <label class="col-sm-4 control-label">Jenis Mata Uang</label>
      <div class="col-sm-6">
        <select class="form-control" id="matauang" name="matauang" selected=''>
          <option value="USD">USD</option>
          <option value="SGD">SGD</option>
          <option value="CNY">CNY</option>
        </select>
      </div>
      </div>
      <br><br>
      <div>
      <label class="col-sm-4 control-label">Nilai Rupiah terhadap Jenis Mata Uang</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="nilai" name="nilai" placeholder="Masukkan nilai rupiah">
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
        <input type="text" class="form-control" id="interest" name="interest" placeholder="<?php echo $row2["interest"];  ?>">
      </div>
      </div>
      <br><br>
<br><br><br>
        <?php 
          if (!empty($_REQUEST["err"])){
        ?>
        <div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><center><strong>Error, </strong><?php echo $_REQUEST["err"] ?></center></div>
        <?php 
          }
         ?>
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
<?php include 'footer.php' ?>