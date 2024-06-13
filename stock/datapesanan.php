<!doctype html>
<html class="no-js" lang="en">

<?php 
	session_start();
	include 'cek.php';
	include '../dbconnect.php';
	date_default_timezone_set("Asia/Bangkok");
	$timenow = date("j-F-Y-h:i:s A");
	?>

<html>
<head>
<title>Data Pesanan per tanggal <?php echo $timenow ?></title>
<link rel="icon" 
      type="image/png" 
      href="favicon.png">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>


</head>

<body>
		<div class="container">
			<h2>Data Pesanan</h2>
			<p>Per tanggal <?php echo $timenow ?></p>
				<div class="data-tables datatable-dark">
					<table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
											<tr>
												<th>No</th>
												<th>ID Pesanan</th>
												<th>Nama Customer</th>
												<th>Tanggal Order</th>
												<th>Pembayaran</th>
												<th>Notes</th>
												<th>Status</th>
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from po p, customer c where p.customerid=c.customerid order by idid ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){

												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><a href="order.php?orderid=<?php echo $p['orderid'] ?>"><?php echo $p['orderid'] ?></a></td>
													<td><?php echo $p['customername'] ?></td>
													<td><?php echo $p['tglorder'] ?></td>
													<td><?php echo $p['payment'] ?></td>
													<td><?php echo $p['notes'] ?></td>
													<td><?php echo $p['status'] ?></td>
												</tr>		
												<?php 
											}
											?>
										</tbody>
										</table>
								</div>
						</div>
	
<script>
$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print',
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

	

</body>

</html>