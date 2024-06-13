<?php 
	session_start();
	include '../dbconnect.php';
	if(empty($_SESSION['username']) || $_SESSION['username'] == '' || !isset($_SESSION['username'])){
		header("location:../login.php");
	};
	date_default_timezone_set("Asia/Bangkok");
	
	if(isset($_POST['addbrgbaru']))
	{
		$nama=$_POST['nama'];
		$jenis=$_POST['jenis'];
		$harga=$_POST['harga'];
		$stock=$_POST['stock'];
			  
		$insertintostock = mysqli_query($conn,"insert into stock_brg values('','$nama','$jenis','$stock','$harga')");
		if ($insertintostock){
		echo " <div class='alert alert-success' align='center'>
			Berhasil menambahkan barang baru.
		  </div>
		<meta http-equiv='refresh' content='1; url= stock.php'/>  ";
		} else { echo "<div class='alert alert-warning' align='center'>
			Gagal menambahkan barang baru.
		  </div>
		 <meta http-equiv='refresh' content='1; url= stock.php'/> ";
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
    <title>Stock Barang</title>
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
                            <li class="active">
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
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Daftar Barang</h2>
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Barang Baru</button>
                                </div>
                                    <div class="data-tables datatable-dark">
										 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>Nama Barang</th>
												<th>Jenis</th>
												<th>Stock</th>
												<th>Harga</th>
												
												<th>Opsi</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from stock_brg order by nama ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
											$idbrg = $p['id'];
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><strong><?php echo $p['nama'] ?></strong></td>
													<td><?php echo $p['jenis'] ?></td>
													<td><?php echo number_format($p['stock']) ?></td>
													<td>Rp<?php echo number_format($p['harga']) ?></td>
													<td>
													<form method="post">
													<a class="btn btn-info" data-toggle="modal" data-target="#barang<?php echo $idbrg ?>"><div class="icon"><i class="fa fa-cog"></i></div></a>
													<input type="hidden" name="barangid" value="<?php echo $idbrg ?>" \>
													<button name="delete" type="submit" class="btn btn-danger" alt="Delete"><div class="icon"><i class="fa fa-trash"></i></div></button>
													</form>
													</td>
												</tr>

												<!-- modal input -->
														<div id="barang<?php echo $idbrg ;?>" class="modal fade">
															<div class="modal-dialog modal-lg">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title"><?php echo $p['nama'] ?><?php echo $p['jenis'];?></h4>
																	</div>
																	<div class="modal-body">
																		<form method="post">
																			<div class="form-group">
																				<label>Nama Barang</label>
																				<input name="namabarang" type="text" class="form-control" value="<?php echo $p['nama'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Jenis</label>
																				<input name="jenisbarang" type="text" class="form-control" value="<?php echo $p['jenis'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Stock</label>
																				<input name="stockbarang" type="number" class="form-control" value="<?php echo $p['stock'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Harga</label>
																				<input name="hargabarang" type="number" class="form-control" value="<?php echo $p['harga'] ?>">
																			</div>
																			<input type="hidden" name="idbarang" value="<?php echo $idbrg ?>">
																			
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
																			<input name="updateinfo" type="submit" class="btn btn-primary" value="Update">
																		</div>
																		</form>
																</div>
															</div>
														</div>
												
												<?php 
											}
											
											
											if(isset($_POST["delete"])){
													$barangid = $_POST['barangid'];
													$hapusin = mysqli_query($conn,"delete from stock_brg where id='$barangid'");
													if($hapusin){
													echo " <div class='alert alert-success' align='center'>
														Data barang akan dihapus dalam 2 detik.
													  </div>
													<meta http-equiv='refresh' content='2; url= stock.php'/>  ";
													} else { echo "<div class='alert alert-warning' align='center'>
														Data barang gagal dihapus
													  </div>
													 <meta http-equiv='refresh' content='1; url= stock.php'/> ";
													}
												};
												
												if(isset($_POST["updateinfo"])){
													$idbarang = $_POST['idbarang'];
													$namabarang = $_POST['namabarang'];
													$jenisbarang = $_POST['jenisbarang'];
													$stockbarang = $_POST['stockbarang'];
													$hargabarang = $_POST['hargabarang'];
													$updatedata = mysqli_query($conn,"update stock_brg set nama='$namabarang', jenis='$jenisbarang', stock='$stockbarang', harga='$hargabarang' where id='$idbarang'");
													if($updatedata){
													echo " <div class='alert alert-success' align='center'>
														Data barang berhasil diubah.
													  </div>
													<meta http-equiv='refresh' content='1; url= stock.php'/>  ";
													} else { echo "<div class='alert alert-warning' align='center'>
														Data barang gagal diubah.
													  </div>
													 <meta http-equiv='refresh' content='1; url= stock.php'/> ";
													}
												};
											?>
										</tbody>
										</table>
                                    </div>
									<a href="datastock.php" target="_blank" class="btn btn-info">Export Data</a>
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
							<h4 class="modal-title">Masukkan stok manual</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Nama</label>
									<input name="nama" type="text" class="form-control" placeholder="Nama Barang" required autofocus>
								</div>
								<div class="form-group">
									<label>Jenis</label>
									<input name="jenis" type="text" class="form-control" placeholder="Jenis Barang">
								</div>
								<div class="form-group">
									<label>Stock</label>
									<input name="stock" type="number" min="0" class="form-control" placeholder="Qty">
								</div>
								<div class="form-group">
									<label>Harga</label>
									<input name="harga" type="number" min="0" class="form-control" placeholder="Harga">
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="addbrgbaru" type="submit" class="btn btn-primary" value="Simpan">
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
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	
	
</body>

</html>
