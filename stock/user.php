
<?php 
	session_start();
	if(empty($_SESSION['username']) || $_SESSION['username'] == '' || !isset($_SESSION['username'])){
		header("location:../login.php");
	};
	include '../dbconnect.php';
	
	$idstaff = $_SESSION['id'];
	$unamestaff = $_SESSION['username'];
	
	if(isset($_POST['adduser']))
	{
		$username = $_POST['uname'];
		$password = password_hash($_POST['upass'], PASSWORD_DEFAULT); 
			  
		$tambahuser = mysqli_query($conn,"insert into login values('','$username','$password')");
		if ($tambahuser){
		echo " <div class='alert alert-success'>
			Berhasil menambahkan staff baru.
		  </div>
		<meta http-equiv='refresh' content='1; url= user.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal menambahkan staff baru.
		  </div>
		 <meta http-equiv='refresh' content='1; url= user.php'/> ";
		}
		
	};
	?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Richard's Lab Procurement - Kelola Staff</title>
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
	<!-- Start datatable css -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	
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
							<li><a href="../index.php"><span>Home</span></a></li>
                            <li>
                                <a href="stock.php"><i class="ti-dashboard"></i><span>Stock Barang</span></a>
                            </li>
							<li>
                                <a href="manageorder.php"><i class="ti-dashboard"></i><span>Kelola Pesanan</span></a>
                            </li>
							<li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout"></i><span>Transaksi Data
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="masuk.php">Barang Masuk</a></li>
                                    <li><a href="keluar.php">Barang Keluar</a></li>
                                </ul>
                            </li>
							<li><a href="customer.php"><span>Kelola Pelanggan</span></a></li>
							<li class="active"><a href="user.php"><span>Kelola Staff</span></a></li>
                            <li>
                                <a href="logout.php"><span>Keluar</span></a>
                                
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
            
            
            <!-- page title area end -->
            <div class="main-content-inner">
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Daftar Staff</h2>
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Staff Baru</button>
                                </div>
                                    <div class="data-tables datatable-dark">
										 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No.</th>
												<th>Username</th>
												<th>Opsi</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from login order by staffid ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){

												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['username'] ?></td>
													<td>
													<form method="post">
													<input type="button" class="btn btn-info" data-toggle="modal" data-target="#staff<?php echo $p['staffid'];?>" value="Ubah Password" \>
													<input type="hidden" name="staffidd" value="<?php echo $p['staffid'] ?>" \>
													<input data-toggle="modal" data-target="#hapus<?php echo $p['staffid'];?>" type="button" class="btn btn-danger" value="Hapus Staff" \>
													</form>
													</td>
												</tr>		
												
												<!-- modal input -->
														<div id="staff<?php echo $p['staffid'];?>" class="modal fade">
															<div class="modal-dialog modal-sm">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Ubah Password <strong><?php echo $p['username'] ?></strong></h4>
																	</div>
																	<div class="modal-body">
																		<form method="post">
																			<div class="form-group">
																				<label>Username</label>
																				<input type="text" name="currentuname" class="form-control" value="<?php echo $p['username'] ?>" disabled>
																			</div>
																			<div class="form-group">
																				<label>Password <strong><?php echo $p['username'] ?></strong> saat ini</label>
																				<input type="password" class="form-control" name="currentpw">
																			</div>
																			<div class="form-group">
																				<label>Password baru</label>
																				<input type="password" class="form-control" name="newpw">
																			</div>
																			<input type="hidden" value="<?php echo $p['staffid'] ?>" name="staffidform">
																		</div>
																		<div class="modal-footer">
																			<input name="updatepw" type="submit" class="btn btn-primary" value="Update">
																		</div>
																		</form>
																</div>
															</div>
														</div>
														
														<div id="hapus<?php echo $p['staffid'];?>" class="modal fade">
															<div class="modal-dialog modal-sm">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">Apakah Anda yakin ingin menghapus <strong><?php echo $p['username'] ?></strong>?</h4>
																	</div>
																	<div class="modal-body">
																		<form method="post">
																			<div class="form-group">
																				<label>Verifikasi password saat ini (Anda login sebagai <strong><?php echo $p['username'] ?></strong>)</label>
																				<input type="password" class="form-control" name="pwskrg">
																			</div>
																			<input type="hidden" value="<?php echo $p['staffid'] ?>" name="staffiddel">
																		</div>
																		<div class="modal-footer">
																			<input name="hapusstaff" type="submit" class="btn btn-danger" value="Hapus">
																		</div>
																		</form>
																</div>
															</div>
														</div>
												
												<?php 
											}
											
											if(isset($_POST["hapusstaff"])){
													$staffidd1 = $_POST['staffiddel'];
													$currentpassword = mysqli_real_escape_string($conn,$_POST['pwskrg']);
													$queryuser2 = mysqli_query($conn,"SELECT * FROM login WHERE staffid='$staffidd1'");
													$cariuser2 = mysqli_fetch_assoc($queryuser2);
					
														if(password_verify($currentpassword, $cariuser2['password'])) {
															$hapusin = mysqli_query($conn,"delete from login where staffid='$staffidd1'");
															if($hapusin){
															echo " <div class='alert alert-success' align='center'>
																<strong>Verifikasi password berhasil.</strong> Data staff akan dihapus dalam 3 detik.
															  </div>
															<meta http-equiv='refresh' content='3; url= user.php'/>  ";
															} else { echo "<div class='alert alert-warning' align='center'>
																Data staff gagal dihapus
															  </div>
															 <meta http-equiv='refresh' content='3; url= user.php'/> ";
															}
															
														} else {
															echo "<div class='alert alert-warning' align='center'>
															<strong>Verifikasi password salah.</strong> Halaman ini akan direfresh dalam 3 detik.
														    </div>
														    <meta http-equiv='refresh' content='3; url= user.php'/> ";
														}
													
													
												};
												
											if(isset($_POST["updatepw"])){
													$staffidd2 = $_POST['staffidform'];
													$currentpass = mysqli_real_escape_string($conn,$_POST['currentpw']);
													$newpass = password_hash($_POST['newpw'], PASSWORD_DEFAULT); 
													$queryuser1 = mysqli_query($conn,"SELECT * FROM login WHERE staffid='$staffidd2'");
													$cariuser1 = mysqli_fetch_assoc($queryuser1);

														if(password_verify($currentpass, $cariuser1['password'])) {
															$updatepassword = mysqli_query($conn,"update login set password='$newpass' where staffid='$staffidd2'");
															
															if($updatepassword){
															echo " <div class='alert alert-success' align='center'>
															Password berhasil diubah.
															</div>
															<meta http-equiv='refresh' content='2; url= user.php'/>  ";
															} else {
															echo "<div class='alert alert-warning' align='center'>
															Gagal ganti password.
														    </div>
														    <meta http-equiv='refresh' content='2; url= user.php'/> ";
															}
															
														} else {
															echo "<div class='alert alert-warning' align='center'>
															<strong>Password saat ini salah.</strong> Halaman ini akan direfresh dalam 3 detik.
														    </div>
														    <meta http-equiv='refresh' content='3; url= user.php'/> ";
														}
											};
		
											?>
										</tbody>
										</table>
                                    </div>
								 </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
               Copyright &copy;<script>document.write(new Date().getFullYear());</script><b>Irwan Plasindo</b></a>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
	
	<!-- modal input -->
			<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah User Baru</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Username</label>
									<input name="uname" type="text" class="form-control" placeholder="Username" required autofocus>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input name="upass" type="password" class="form-control" placeholder="Password">
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="adduser" type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
	
	<script>
	$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
	} );
	</script>
	
	<!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- Start datatable js -->
	 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
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
