<?php 
	session_start();
	if(empty($_SESSION['username']) || $_SESSION['username'] == '' || !isset($_SESSION['username'])){
		header("location:../login.php");
	};
	include '../dbconnect.php';
	?>

<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kelola Pelanggan</title>
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
							<li class="active"><a href="customer.php"><span>Kelola Pelanggan</span></a></li>
							<li><a href="user.php"><span>Kelola Staff</span></a></li>
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
            <!-- header area end -->
			
			
            <!-- page title area end -->
            <div class="main-content-inner">
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Daftar Pelanggan</h2>
								</div>
                                    <div class="data-tables datatable-dark">
										 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>Nama Pelanggan</th>
												<th>No. Telepon</th>
												<th>Alamat</th>
												<th>Email</th>
												<th>Opsi</th>
												
												<!--<th>Opsi</th>-->
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from customer order by customerid ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['customername'] ?></td>
													<td><?php echo $p['customerphone'] ?></td>
													<td><?php echo $p['customeraddress'] ?></td>
													<td><?php echo $p['customeremail'] ?></td>
													<td>
													<form method="post">
													<a class="btn btn-info" data-toggle="modal" data-target="#person<?php echo $p['customerid'];?>"><div class="icon"><i class="fa fa-cog"></i></div></a>
													<input type="hidden" name="custidd" value="<?php echo $p['customerid'] ?>" \>
													<button name="delete" type="submit" class="btn btn-danger" alt="Delete"><div class="icon"><i class="fa fa-trash"></i></div></button>
													</form>
													</td>
												</tr>	

											<!-- modal input -->
														<div id="person<?php echo $p['customerid'];?>" class="modal fade">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title"><?php echo $p['customername'] ?></h4>
																		<p><?php echo $p['customerid'];?></p>
																	</div>
																	<div class="modal-body">
																		<form method="post">
																			<div class="form-group">
																				<label>Nama Lengkap</label>
																				<input name="namalengkap" type="text" class="form-control" value="<?php echo $p['customername'] ?>">
																			</div>
																			<div class="form-group">
																				<label>No. Telp</label>
																				<input name="notelp" type="tel" class="form-control" value="<?php echo $p['customerphone'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Alamat</label>
																				<input name="alamat" type="text" class="form-control" value="<?php echo $p['customeraddress'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Email</label>
																				<input name="emailcust" type="email" class="form-control" value="<?php echo $p['customeremail'] ?>">
																			</div>
																			<input type="hidden" name="idcustomer" value="<?php echo $p['customerid'];?>">
																			
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
																			<input name="updatecust" type="submit" class="btn btn-primary" value="Update">
																		</div>
																		</form>
																</div>
															</div>
														</div>
												
												<?php 
											}
											
											if(isset($_POST["delete"])){
													$custid = $_POST['custidd'];
													$hapusin = mysqli_query($conn,"delete from customer where customerid='$custid'");
													if($hapusin){
													echo " <div class='alert alert-success' align='center'>
														Data pelanggan akan dihapus dalam 2 detik.
													  </div>
													<meta http-equiv='refresh' content='2; url= customer.php'/>  ";
													} else { echo "<div class='alert alert-warning' align='center'>
														Data pelanggan gagal dihapus
													  </div>
													 <meta http-equiv='refresh' content='1; url= customer.php'/> ";
													}
												};
												
												if(isset($_POST["updatecust"])){
													$idcustomer = $_POST['idcustomer'];
													$namalengkap = $_POST['namalengkap'];
													$notelp = $_POST['notelp'];
													$alamat = $_POST['alamat'];
													$emailcust = $_POST['emailcust'];
													$updatedata = mysqli_query($conn,"update customer set customername='$namalengkap', customerphone='$notelp', customeraddress='$alamat', customeremail='$emailcust' where customerid='$idcustomer'");
													if($updatedata){
													echo " <div class='alert alert-success' align='center'>
														Data pelanggan berhasil diubah.
													  </div>
													<meta http-equiv='refresh' content='1; url= customer.php'/>  ";
													} else { echo "<div class='alert alert-warning' align='center'>
														Data pelanggan gagal diubah.
													  </div>
													 <meta http-equiv='refresh' content='1; url= customer.php'/> ";
													}
												};
											?>
											
										</tbody>
										</table>
                                    </div>
									<a href="datapelanggan.php" target="_blank" class="btn btn-info">Export Data</a>
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
