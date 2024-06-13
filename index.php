<?php 
	session_start();
	if(empty($_SESSION['username']) || $_SESSION['username'] == '' || !isset($_SESSION['username'])){
		header("location:login.php");
	};
	include 'dbconnect.php';
	date_default_timezone_set("Asia/Bangkok");
	
	
	if(isset($_POST['addcust']))
	{
		$nama = $_POST['nama'];
		$notelp = $_POST['notelp'];
		$alamat = $_POST['alamat'];
		$email = $_POST['email'];
			  
		$tambahcustomer = mysqli_query($conn,"insert into customer values('','$nama','$notelp','$alamat','$email',current_timestamp())");
		if($tambahcustomer){
		echo " <div class='alert alert-success' align='center'>
			<strong>Berhasil Menambahkan Pelanggan Baru!</strong> Anda akan dialihkan ke halaman sebelumnya.
		  </div>
		<meta http-equiv='refresh' content='1; url= index.php'/>  ";
		} else { echo "<div class='alert alert-warning' align='center'>
			<strong>Gagal menambahkan pelanggan baru!</strong> Anda akan dialihkan ke halaman sebelumnya.
		  </div>
		 <meta http-equiv='refresh' content='1; url= index.php'/> ";
		}
		
	};
	
	if(isset($_POST['addorder']))
	{
		$custid = $_POST['kastemer'];
		$salt1 = mt_rand(2,999);
		$salt2 = mt_rand(1001,1234);
		$hash1 = date("m") * date("d") + date("i") * date("s");
		$hash2 = $salt1 * $salt2;
		$hashing = $hash1 * $hash2;
		$orderid = crypt($custid, $hashing);
			  
		$tambahorder = mysqli_query($conn,"insert into po values('','$orderid','$custid',current_timestamp(),'','Ordered','')");
		if($tambahorder){
		echo " <div class='alert alert-success' align='center'>
			Berhasil membuat pesanan baru, Anda akan dialihkan ke halaman berikutnya.
		  </div>
		<meta http-equiv='refresh' content='1; url= stock/order.php?orderid=".$orderid."'/>  ";
		} else { echo "<div class='alert alert-warning' align='center'>
			Gagal membuat pesanan baru, Anda akan dialihkan ke halaman sebelumnya.
		  </div>
		 <meta http-equiv='refresh' content='1; url= index.php'/> ";
		}
		
	}
	
	$itungcust = mysqli_query($conn,"select count(customerid) as jumlahcust from customer");
	$itungcust2 = mysqli_fetch_assoc($itungcust);
	$itungcust3 = $itungcust2['jumlahcust'];
	
	$itungorder = mysqli_query($conn,"select count(orderid) as jumlahorder from po where status not like 'Completed' and status not like 'Canceled'");
	$itungorder2 = mysqli_fetch_assoc($itungorder);
	$itungorder3 = $itungorder2['jumlahorder'];
	
	$itungtrans = mysqli_query($conn,"select count(orderid) as jumlahtrans from po where status='Completed'");
	$itungtrans2 = mysqli_fetch_assoc($itungtrans);
	$itungtrans3 = $itungtrans2['jumlahtrans'];
	
	?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
	
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
               <a href="#"><h2><b>Irwan Plasindo</b></h2></a>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
							<li class="active"><a href="index.php"><span>Home</span></a></li>
                            <li>
                                <a href="stock/stock.php"><i class="ti-dashboard"></i><span>Stock Barang</span></a>
                            </li>
							<li>
                                <a href="stock/manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
                            </li>
							<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Transaksi Data
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="stock/masuk.php">Barang Masuk</a></li>
                                    <li><a href="stock/keluar.php">Barang Keluar</a></li>
                                </ul>
                            </li>
							<li><a href="stock/customer.php"><span>Kelola Pelanggan</span></a></li>
							<li><a href="stock/user.php"><span>Kelola Staff</span></a></li>
                            <li>
                                <a href="stock/logout.php"><span>Keluar</span></a>
                                
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li><h3><div class="date">
								<script type='text/javascript'>
						<!--
						var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
						var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
						var date = new Date();
						var day = date.getDate();
						var month = date.getMonth();
						var thisDay = date.getDay(),
							thisDay = myDays[thisDay];
						var yy = date.getYear();
						var year = (yy < 1000) ? yy + 1900 : yy;
						document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);		
						//-->
						</script></b></div></h3>

						</li>
                        </ul>
                    </div>
                </div>
            </div>
			
			
			<!-- header area end -->
			<?php 
			
				$periksa_bahan=mysqli_query($conn,"select * from stock_brg where stock <10");
				while($p=mysqli_fetch_array($periksa_bahan)){	
					if($p['stock']>=1){	
						?>	
						<script>
							$(document).ready(function(){
								$('#pesan_sedia').css("color","white");
								$('#pesan_sedia').append("<i class='ti-flag'></i>");
							});
						</script>
						<?php
						echo "<div class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Stok  <strong><u>".$p['nama']. "</u> <u>".($p['jenis'])."</u></strong> yang tersisa kurang dari 10</div>";		
					}
				}
				?>
			
            
            <!-- page title area end -->
            <div class="main-content-inner">
                
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Pelanggan</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h1><?php echo $itungcust3 ?></h1>
                                    </div>
									<button data-toggle="modal" data-target="#customer" type="button" class="btn btn-primary btn-block">Tambah Pelanggan</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="single-report">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-book"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Pesanan</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h1><?php echo $itungorder3 ?></h1>
                                    </div>
									<button data-toggle="modal" data-target="#order" type="button" class="<?php 
									if($itungcust3==0){
										echo 'btn btn-secondary btn-block';
									} else {
										echo 'btn btn-primary btn-block';
									}
									?>">Tambah Pesanan</button>
                                </div>
                            </div>
                        </div>
						<div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-link"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Transaksi Selesai</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h1><?php echo $itungtrans3 ?></h1>
                                    </div>
									<!-- <button type="button" class="<?php 
									if($itungtrans3==0){
										echo 'btn btn-secondary btn-block';
									} else {
										echo 'btn btn-primary btn-block';
									}?>">Lihat Transaksi</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- overview area end -->
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Selamat Datang</h2>
                                </div>
                                <div class="market-status-table mt-4">
                                    Anda masuk sebagai <strong><?php echo $_SESSION['username'] ?></strong>
									<p>Anda login pada <?php echo $_SESSION['time'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
		
		<!-- Tambah Customer Baru -->
			<div id="customer" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Pelanggan Baru</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Nama</label>
									<input name="nama" type="text" class="form-control" placeholder="Nama Pelanggan" required autofocus>
								</div>
								<div class="form-group">
									<label>No.Telp</label>
									<input name="notelp" type="tel" class="form-control" placeholder="Telepon Pelanggan" maxlength="15" required>
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<input name="alamat" type="text" class="form-control" placeholder="Alamat Pelanggan">
								</div>
								<div class="form-group">
									<label>Email</label>
									<input name="email" type="email" class="form-control" placeholder="Email Pelanggan">
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addcust" type="submit" class="btn btn-primary" value="Simpan">
								
							</div>
						</form>
					</div>
				</div>
			</div>
			
			<!-- Tambah Customer Baru -->
			<div id="order" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Pesanan Baru</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Nama Pelanggan</label>
									<select name="kastemer" class="custom-select form-control">
									<option selected>Pilih Pelanggan</option>
									<?php
									$det=mysqli_query($conn,"select * from customer order by customername ASC")or die($mysqli->error());
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['customerid'] ?>"><?php echo $d['customername'] ?> (<?php echo $d['customeraddress'] ?>)</option>
										<?php
								}
								?>		
									</select>
									
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name ="addorder" type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
		
		
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script><b>Irwan Plasindo</b></a>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>
