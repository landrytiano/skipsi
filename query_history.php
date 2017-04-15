<?php
include 'job/controller/database.php';

$bulan_mulai=$_REQUEST['bulan_mulai'];
$tahun_mulai=$_REQUEST['tahun_mulai'];
$bulan_end=$_REQUEST['bulan_end'];
$tahun_end=$_REQUEST['tahun_end'];

$start = date_create();
date_date_set($start, $tahun_mulai, $bulan_mulai, null);
date_format($date, 'Y-M-d');

$end = date_create();
date_date_set($end, $tahun_end, $bulan_end, null);
date_format($date, 'Y-M-d');

$query = "SELECT * FROM prediction2 where date between $start and $end order by date asc";
$result = $conn->query($query);
$row = mysqli_fetch_assoc($result);



//    header("location: kalkulasi.php?row=$row");

?>

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