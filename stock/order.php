
<?php 
session_start();
include '../dbconnect.php';
if(empty($_SESSION['username']) || $_SESSION['username'] == '' || !isset($_SESSION['username'])){
		header("location:../login.php");
	};
$orderids = $_GET['orderid'];
$liatcust = mysqli_query($conn,"select * from customer c, po p where orderid='$orderids' and p.customerid=c.customerid");
$checkdb = mysqli_fetch_array($liatcust);
date_default_timezone_set("Asia/Bangkok");


if(isset($_POST['adddetailorder']))
	{
		$produk = $_POST['produk'];
		$lihatqty  = mysqli_query($conn,"select * from stock_brg where id='$produk'");
		$stock = mysqli_fetch_array($lihatqty);
		$qty = $_POST['qty'];
		$updatestock = $stock['stock'] - $qty;
		$orderid = $_POST['idpesanan'];
			  
		$addtodetpo = mysqli_query($conn,"insert into detpo values('','$orderid','$produk','$qty')");
		$updatestock = mysqli_query($conn,"update stock_brg set stock='$updatestock' where id='$produk'");
		$setbarangkeluar = mysqli_query($conn,"insert into brg_keluar values('',current_timestamp(),'$produk','$qty','$orderid')");
		if($addtodetpo&&$updatestock&&$setbarangkeluar){
		echo " <div class='alert alert-success' align='center'>
			Produk berhasil ditambahkan!
		  </div>
		<meta http-equiv='refresh' content='1; url= order.php?orderid=".$orderid."'/>  ";
		} else { echo "<div class='alert alert-warning' align='center'>
			Produk gagal ditambahkan.
		  </div>
		 <meta http-equiv='refresh' content='1; url= order.php?orderid=".$orderid."'/> ";
		}
		
	};
	
	if(isset($_POST['simpanctt']))
	{
		$notes = $_POST['catatan'];
		$orderid = $_POST['orderids'];
			  
		$updatenotes = mysqli_query($conn,"update po set notes='$notes' where orderid='$orderid'");
		if($updatenotes){
		echo " <div class='alert alert-success' align='center'>
			Notes berhasil diperbarui.
		  </div>
		<meta http-equiv='refresh' content='1; url= order.php?orderid=".$orderid."'/>  ";
		} else { echo "<div class='alert alert-warning' align='center'>
			Notes gagal diperbarui.
		  </div>
		 <meta http-equiv='refresh' content='1; url= order.php?orderid=".$orderid."'/> ";
		}
		
	};
	
	if(isset($_POST['simpanstatus']))
	{
		$statusorder = $_POST['statusorder'];
		$orderid = $_POST['orderids'];
			  
		$updatestatus = mysqli_query($conn,"update po set status='$statusorder' where orderid='$orderid'");
		if($updatestatus){
		echo " <div class='alert alert-success' align='center'>
			Status berhasil diperbarui.
		  </div>
		<meta http-equiv='refresh' content='1; url= order.php?orderid=".$orderid."'/>  ";
		} else { echo "<div class='alert alert-warning' align='center'>
			Status gagal diperbarui.
		  </div>
		 <meta http-equiv='refresh' content='1; url= order.php?orderid=".$orderid."'/> ";
		}
		
	};
	
	if(isset($_POST['updateorder']))
	{
		$qtybrg = $_POST['qtybrg'];
		$idbrg = $_POST['idbrg'];
		$idorder = $checkdb['orderid'];
		
		$lihatqtydetpo  = mysqli_query($conn,"select * from detpo where id='$idbrg' and orderid='$idorder'");
		$fstock = mysqli_fetch_array($lihatqtydetpo);
		
		$lihatstock  = mysqli_query($conn,"select * from stock_brg where id='$idbrg'");
		$dstock = mysqli_fetch_array($lihatstock);
		
		if($qtybrg<$fstock['qty']){
		$selisihminus = $fstock['qty'] - $qtybrg;
		$arrayplus = $dstock['stock'] + $selisihminus;
		
		$updatedetpo = mysqli_query($conn,"update detpo set qty='$qtybrg' where orderid='$idorder' and id='$idbrg'");
		$updatedatakeluar = mysqli_query($conn,"update brg_keluar set jumlah='$qtybrg' where penerima='$idorder' and idbarang='$idbrg'");
		$tambahinstock = mysqli_query($conn,"update stock_brg set stock='$arrayplus' where id='$idbrg'");
			if($updatedetpo&&$updatedatakeluar&&$tambahinstock){
			echo " <div class='alert alert-success' align='center'>
				Data berhasil diperbarui.
			  </div>
			<meta http-equiv='refresh' content='1; url= order.php?orderid=".$idorder."'/>  ";
			} else { echo "<div class='alert alert-warning' align='center'>
				Data gagal diperbarui.
			  </div>
			 <meta http-equiv='refresh' content='1; url= order.php?orderid=".$idorder."'/> ";
			}
		
		} else {
			$selisihplus = $qtybrg - $fstock['qty'];
			$arraymin = $dstock['stock'] - $selisihplus;
			
			$updatedetpo1 = mysqli_query($conn,"update detpo set qty='$qtybrg' where orderid='$idorder'");
			$updatedatakeluar1 = mysqli_query($conn,"update brg_keluar set jumlah='$qtybrg' where penerima='$idorder' and idbarang='$idbrg'");
			$kuranginstock = mysqli_query($conn,"update stock_brg set stock='$arraymin' where id='$idbrg'");
				if($updatedetpo1&&$updatedatakeluar1&&$kuranginstock){
				echo " <div class='alert alert-success' align='center'>
					Data berhasil diperbarui.
				  </div>
				<meta http-equiv='refresh' content='1; url= order.php?orderid=".$idorder."'/>  ";
				} else { echo "<div class='alert alert-warning' align='center'>
					Data gagal diperbarui.
				  </div>
				 <meta http-equiv='refresh' content='1; url= order.php?orderid=".$idorder."'/> ";
				}
		}
		
	};
	
	if(isset($_POST['deletebarang']))
	{
		$idbarangdel = $_POST['idbarangdel'];
		$idorderdel = $_POST['idorderdel'];
		$lihatqtydetpo1  = mysqli_query($conn,"select * from detpo where id='$idbarangdel' and orderid='$idorderdel'");
		$fstock1 = mysqli_fetch_array($lihatqtydetpo1);
		$lihatstockbrg  = mysqli_query($conn,"select * from stock_brg where id='$idbarangdel'");
		$dstock1 = mysqli_fetch_array($lihatstockbrg);
		
		$balikin = $dstock1['stock'] + $fstock1['qty'];
			  
		$updatestockbaru = mysqli_query($conn,"update stock_brg set stock='$balikin' where id='$idbarangdel'");
		$hapusbrgkeluar = mysqli_query($conn,"delete from brg_keluar where penerima='$idorderdel' and idbarang='$idbarangdel'");
		$hapusdetpo = mysqli_query($conn,"delete from detpo where orderid='$idorderdel' and id='$idbarangdel'");
		if($updatestockbaru&&$hapusbrgkeluar&&$hapusdetpo){
		echo " <div class='alert alert-success' align='center'>
			Status berhasil diperbarui.
		  </div>
		<meta http-equiv='refresh' content='1; url= order.php?orderid=".$idorderdel."'/>  ";
		} else { echo "<div class='alert alert-warning' align='center'>
			Status gagal diperbarui.
		  </div>
		 <meta http-equiv='refresh' content='1; url= order.php?orderid=".$idorderdel."'/> ";
		}
		
	};
	
	if(isset($_POST['simpanpayment']))
	{
		$payment = $_POST['payment'];
		$orderid = $_POST['orderids'];
			  
		$updatepay = mysqli_query($conn,"update po set payment='$payment' where orderid='$orderid'");
		if($updatepay){
		echo " <div class='alert alert-success' align='center'>
			Notes berhasil diperbarui.
		  </div>
		<meta http-equiv='refresh' content='1; url= order.php?orderid=".$orderid."'/>  ";
		} else { echo "<div class='alert alert-warning' align='center'>
			Notes gagal diperbarui.
		  </div>
		 <meta http-equiv='refresh' content='1; url= order.php?orderid=".$orderid."'/> ";
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
    <title>Order</title>
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
							<li class="active">
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
			
			
            <!-- page title area end -->
            <div class="main-content-inner">
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h3>Order id : #<?php echo $orderids ?></h3>
									
								</div>
                                   <p><?php echo $checkdb['customername']; ?> (<?php echo $checkdb['customeraddress']; ?>)</p>
								<p>Waktu order : <?php echo $checkdb['tglorder']; ?></p>
									
									<?php
									if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
									echo '
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#inputbarang" class="btn btn-info col-md-2">Input Produk</button>
									';
									} else {
										
									}
									?>
								   <div class="data-tables datatable-dark">
										 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>Produk</th>
												<th>Jumlah</th>
												<th>Harga</th>
												<th>Total</th>
												
												<?php
												if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
												echo '
												<th>Opsi</th>
												';
												} else {
													
												}
												?>
												
												
												
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from detpo dp, stock_brg sb where orderid='$orderids' and sb.id=dp.id order by detid ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												$total = $p['qty']*$p['harga'];
												
												$result = mysqli_query($conn,"SELECT SUM(d.qty*s.harga) AS count FROM detpo d, stock_brg s where orderid='$orderids' and s.id=d.id order by d.id ASC");
												$row = mysqli_fetch_assoc($result);
												$cekrow = mysqli_num_rows($result);
												$count = $row['count'];
												
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['nama'] ?> <?php echo $p['jenis'] ?></td>
													<td><?php echo $p['qty'] ?></td>
													<td>Rp<?php echo number_format($p['harga']) ?></td>
													<td>Rp<?php echo number_format($total) ?></td>
													
													<?php
													if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
													echo "
													<td>
													<form method='post'>
													<a class='btn btn-info' data-toggle='modal' data-target='#person".$p['id']."'><div class='icon'><i class='fa fa-cog'></i></div></a>
													<input type='hidden' name='idbarangdel' value='".$p['id']."' \>
													<input type='hidden' name='idorderdel' value='".$p['orderid']."' \>
													<button name='deletebarang' type='submit' class='btn btn-danger' alt='Delete'><div class='icon'><i class='fa fa-trash'></i></div></button>
													</form>
													</td>
													";
													} else {
														
													}
													?>
														
												</tr>
												
												<!-- modal input -->
														<div id="person<?php echo $p['id'];?>" class="modal fade">
															<div class="modal-dialog modal-sm">
																<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title"><?php echo $p['nama'] ?></h4>
																	</div>
																	<div class="modal-body">
																		<form method="post">
																			<div class="form-group">
																				<label>Nama Barang</label>
																				<input name="namabrg" type="text" class="form-control" value="<?php echo $p['nama'] ?>" disabled>
																			</div>
																			<div class="form-group">
																				<label>Jumlah</label>
																				<input name="qtybrg" type="number" class="form-control" value="<?php echo $p['qty'] ?>">
																			</div>
																			<input type="hidden" name="idbrg" value="<?php echo $p['id'];?>">
																			
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
																			<input name="updateorder" type="submit" class="btn btn-primary" value="Update">
																		</div>
																		</form>
																</div>
															</div>
														</div>
												
												<?php 
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="4" style="text-align:right">Total:</th>
												<th>Rp<?php 
												
												$result1 = mysqli_query($conn,"SELECT SUM(d.qty*s.harga) AS count FROM detpo d, stock_brg s where orderid='$orderids' and s.id=d.id order by d.id ASC");
												$cekrow = mysqli_num_rows($result1);
												$row1 = mysqli_fetch_assoc($result1);
												$count = $row1['count'];
												if($cekrow > 0){
													echo number_format($count);
													} else {
														echo 'No data';
													}?></th>
											</tr>
										</tfoot>
										</table>
										
                                    </div>
									<a href="datadet.php?orderid=<?php echo $orderids ?>" target="_blank" class="btn btn-info">Export Data</a>
                                </div>
						
                            </div>
                        </div>
                    </div>
					
					
					<!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
									<h4>Notes (Jika ada)</h4>
									<?php
									if($checkdb['notes']==""){
										echo 'Silakan isi notes';
										?>
										<form method="post">
										<div class="row">
										<div class="col">
										<div class="form-group">
										<input type="text" name="catatan" class="form-control" placeholder="Ketik disini">
										</div>
										<input type="hidden" name="orderids" class="form-control" value="<?php echo $orderids ?>" \>
										</div>
										<div class="col">


										<?php
										if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
										echo '
										<div class="form-group">
										<button type="submit" name="simpanctt" class="btn btn-primary">Simpan Notes</button>
										</div>
										';
										} else {
											
										}
										?>
										
										</div>
										</div>
										
										
										</form>
										<?php
									} else 
									{
										?>
										<form method="post">
										<div class="row">
										<div class="col">
										<div class="form-group">
										<input type="text" name="catatan" class="form-control" value="<?php echo $checkdb['notes'] ?>">
										</div>
										<input type="hidden" name="orderids" class="form-control" value="<?php echo $orderids ?>" \>
										</div>
										<div class="col">
										
										<?php
										if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
										echo '
										<div class="form-group">
										<button type="submit" name="simpanctt" class="btn btn-primary"\>Simpan Notes</button>
										</div>
										';
										} else {
											
										}
										?>
										
										</div>
										</div>
										
										</form>
										<?php
									}
									?>
									
									<br \>
									<br \>
									<h4>Status : <?php echo $checkdb['status'] ?></h4>
									
									
									<form method="post">
										<div class="row">
										<div class="col">
										<div class="form-group">
											<select name="statusorder" class="form-control">
											<?php 
											
											$liatrow = mysqli_num_rows($brgs);

											$stat = $checkdb['status'];
											if($stat=='Ordered'){ echo '
											<option value="Processed">Diproses</option>
											<option value="Completed">Selesai</option>
											';
												if($liatrow < 1){
												echo '
												<option value="Canceled">Dibatalkan</option>
												';
												}
											} else if($stat=='Processed'){
												echo '
												<option value="Completed">Selesai</option>
												';
												if($liatrow < 1){
												echo '
												<option value="Canceled">Dibatalkan</option>
												';
												}
											}
											?>
											</select>
											<p>Jika Anda ingin membatalkan, Anda harus mengosongkan item pesanan</p>
										</div>
										<input type="hidden" name="orderids" class="form-control" value="<?php echo $orderids ?>" \>
										</div>
										<div class="col">
										
										<?php
										if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
										echo '
										<div class="form-group">
										<button type="submit" name="simpanstatus" class="btn btn-primary"\>Update Status</button>
										</div>
										';
										} else {
											
										}
										?>
										
										</div>
										</div>
										
										</form>
										
										
										<br \>
									<br \>
									<h4>Metode Pembayaran</h4>
									<form method="post">
										<div class="row">
										<div class="col">
										<div class="form-group">
										<input type="text" name="payment" class="form-control" value="<?php echo $checkdb['payment'] ?>">
										</div>
										<input type="hidden" name="orderids" class="form-control" value="<?php echo $orderids ?>" \>
										</div>
										<div class="col">
										
										<?php
										if($checkdb['status']!='Canceled'&&$checkdb['status']!='Completed'){
										echo '
										<div class="form-group">
										<button type="submit" name="simpanpayment" class="btn btn-primary"\>Simpan Payment</button>
										</div>
										';
										} else {
											
										}
										?>
										
										
										
										</div>
										</div>
										
										</form>
									
									
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
                Copyright &copy;<script>document.write(new Date().getFullYear());</script><b>Irwan Plastik</b></a>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
	
	<!-- Tambah Customer Baru -->
			<div id="inputbarang" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Input Produk</h4>
						</div>
						<div class="modal-body">
							<form method="post">
								<div class="form-group">
									<label>Produk</label>
									<select name="produk" class="custom-select form-control">
									<option selected>Pilih Produk</option>
									<?php
									$det=mysqli_query($conn,"select * from stock_brg where id not in (select id from detpo where orderid='$orderids') order by id ASC")or die(mysqli_error());
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['id'] ?>"><?php echo $d['nama'] ?> <?php echo $d['jenis'] ?> ( Stock : <?php echo $d['stock'] ?>) | Rp<?php echo number_format($d['harga']) ?></option>
										<?php
								}
								?>		
									</select>
									
								</div>
								<div class="form-group">
									<label>Jumlah</label>
									<input name="qty" type="number" min="0" class="form-control" placeholder="Qty">
								</div>
								<input type="hidden" name="idpesanan" value="<?php echo $orderids ?>" \>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
								<input name="adddetailorder" type="submit" class="btn btn-primary" value="Simpan">
							</div>
						</form>
					</div>
				</div>
			</div>
	
	
	<script type="text/javascript">
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
	 <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
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
