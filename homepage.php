<?php
    // mengaktifkan session
    session_start();
 
    // cek apakah user telah login, jika belum login maka di alihkan ke halaman login
    if($_SESSION['status'] !="login"){
        header("location:index.php");
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>

  <body>
    <div class="container" style="margin-top: 100px">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
             <center><h4><B>DATABASE TUGAS AKHIR</B></h4></center>
             <center><h5><i>"TEKNIK  KOMPUTER"</i></h5></center>
            </div>
            <div class="card-body">
            <a href="data_mahasiswa.php" class="btn btn-info btn-success" style="margin-bottom: 10px">DATA MHS</a>
              <a href="data_tugasakhir.php" class="btn btn-info btn-success" style="margin-bottom: 10px">DATA TA</a>
              <a href="data_dosbing.php" class="btn btn-info btn-success" style="margin-bottom: 10px">DATA DOSBING</a>
              <a href="rightjoin.php" class="btn btn-info btn-success" style="margin-bottom: 10px">MAHASISWA & DOSBING</a>
              <a href="innerjoin.php" class="btn btn-info btn-success" style="margin-bottom: 10px">DAFTAR TA</a>
              <table class="table table-bordered" id="myTable">
              <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
              <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
    <div class="form-group">
        <label for="sel1">Cari:</label>
        <?php
        $kata_kunci="";
        if (isset($_POST['kata_kunci'])) {
            $kata_kunci=$_POST['kata_kunci'];
        }
        ?>
        <input type="text" name="kata_kunci" value="<?php echo $kata_kunci;?>" class="form-control"  required/>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-warning" value="Pilih">
        <a href="homepage.php" class="btn btn-danger">Reset</a>
    </div>
    </form>

    <table class="table table-bordered table-striped">
        <br>
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>ANGKATAN</th>
            <th>ALAMAT</th>

        </tr>
        </thead>
        <?php

        include "koneksi.php";
        if (isset($_POST['kata_kunci'])) {
            $kata_kunci=trim($_POST['kata_kunci']);
            $sql="SELECT * FROM mahasiswa WHERE Nim LIKE '%".$kata_kunci."%' or Nama like '%".$kata_kunci."%' or Alamat like '%".$kata_kunci."%' or Angkatan like '%".$kata_kunci."%' order by Nim asc";

        }else {
            $sql="SELECT * FROM mahasiswa ORDER BY Nim asc";
        }


        $query=mysqli_query($koneksi,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($query)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["Nim"]; ?></td>
                <td><?php echo $data["Nama"];   ?></td>
                <td><?php echo $data["Angkatan"];   ?></td>
                <td><?php echo $data["Alamat"];   ?></td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
</div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
     // $(document).ready( function () {
      //    $('#myTable').DataTable();
     // } );
    </script>
  </body>
</html>