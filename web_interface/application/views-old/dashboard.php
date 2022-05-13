<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/toplinks.php'); ?>

    <style>
        /*******************************
* MODAL AS LEFT/RIGHT SIDEBAR
* Add "left" or "right" in modal parent div, after class="modal".
* Get free snippets on bootpen.com
*******************************/
	.modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
        right: 0;
		margin: auto;
		width: 420px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}

	.modal.left .modal-content,
	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}
	
	.modal.left .modal-body,
	.modal.right .modal-body {
		padding: 15px 15px 80px;
	}
        
/*Right*/
	.modal.right.fade .modal-dialog {
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}

/* ----- MODAL STYLE ----- */
	.modal-content {
		border-radius: 0;
		border: none;
	}

	.modal-header {
		border-bottom-color: #EEEEEE;
		background-color: #FAFAFA;
	}

    </style>

</head>

<body>
    <?php include('includes/navigation.php'); ?>


<!-- Content -->
<div class="main">
    <h1 class="text-center mt-4">Dashboard Owners</h1>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 col-md-12 border-right">

                <h1 class="text-center my-4">Vendors</h1>

                <table class="table table-fluid" id="vendors">
                    <thead>
                    <tr>
                        <th>Flea Market</th>
                        <th>No. of Vendors Applied</th>
                        <th>Date</th>
                        <th>List of Vendors Applied</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                    foreach($organizar as $m){ 
                        // echo "<pre>";
                        // print_r($m);
                        // echo "</pre>";
                        $k=$m['org_data'];
                        
                        ?>  
                    <tr>
                    <td><?php echo $k['market_name'] ?></td>
                      <td><?php echo $m['org_count'] ?> vendors</td>
                      <td><?php echo $k['date'] ?></td>
                      <td>
                        <a href="<?php echo base_url().'site/vendor/'.$m['org_id'] ?>" class="text-dark" >  
                            Click to see vendors list 
                        <i class="fa fa-eye fa-2x"></i> 
                    </a>    
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>



<div class="container demo">
	<!-- Modal -->
	<div class="modal fade right" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel2">Vendors List</h4>
					<button type="button" class="" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					
				</div>

				<div class="modal-body">
                    <p>Vendor A</p>
                    <p>Vendor A</p>
                    <p>Vendor A</p>
                    <p>Vendor A</p>
                    <p>Vendor A</p>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->
	
	
</div><!-- container -->






    <?php include('includes/footer.php'); ?>
    <?php include('includes/bottom_links.php'); ?>

    <script>
        $(document).ready( function () {
        $('#myTable').DataTable();
        $('#vendors').DataTable();
    });
        </script>

</body>

</html>