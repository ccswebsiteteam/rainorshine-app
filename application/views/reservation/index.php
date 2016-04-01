<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<link href="//cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" rel="stylesheet">
<link href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/css/reservation.css" rel="stylesheet">

<div class="container">
	<div class="row">
		<div class="col l12">
			<br/><br/>
			<table class="mdl-data-table" cellspacing="0" width="100%" id="rosrac-reservation-table">
		        <thead>
		          <tr>
		              <th data-field="id">ID</th>
		              <th data-field="name">Client Name</th>
		              <th data-field="car">Car Rented</th>
		              <th data-field="date">Date Rented</th>
		              <th data-field="status">Status</th>
		              <th data-field="action">Action</th>
		          </tr>
		        </thead>

		        <tbody>
		        <?php if($reservations) {
		        	for($i = 0; $i < count($reservations); ++$i) {
		       	?>
		          <tr class="rosrac-reservation-details-container" data-id="<?php echo $reservations[$i]->r_id ?>">
		            <td><?php echo $i + 1 ?></td>
		            <td><?php echo $reservations[$i]->full_name ?></td>
		            <td><?php echo $reservations[$i]->brand ?></td>
		            <td><?php echo date_format(new DateTime($reservations[$i]->rent_date), 'F d, Y H:i A'); ?></td>
		            <td><?php echo $reservations[$i]->st_type ?></td>
		            <td class="rosrac-reservation-action-btn-container">
		            	<?php switch ($reservations[$i]->status_type_id) {
		            		case '1': ?>
				            	<button class="btn-floating blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Approve" value="Approved"><i class="material-icons">thumb_up</i></button>
				            	<button class="btn-floating red tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reject" value="Rejected"><i class="material-icons">thumb_down</i></button>
				            	<button class="btn-floating yellow darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel" value="Cancelled"><i class="material-icons">block</i></button>
		            		<?php break;
		            		case '2': ?>
				            	<button class="btn-floating gray tooltipped" data-position="bottom" data-delay="50" data-tooltip="Pending" value="Pending"><i class="large material-icons">assignment</i></button>
				            	<button class="btn-floating red tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reject" value="Rejected"><i class="material-icons">thumb_down</i></button>
				            	<button class="btn-floating yellow darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel" value="Cancelled"><i class="material-icons">block</i></button>
		            		<?php break;
		            		case '3': ?>
				            	<button class="btn-floating gray tooltipped" data-position="bottom" data-delay="50" data-tooltip="Pending" value="Pending"><i class="large material-icons">assignment</i></button>
				            	<button class="btn-floating blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Approve" value="Approved"><i class="material-icons">thumb_up</i></button>
				            	<button class="btn-floating yellow darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cancel" value="Cancelled"><i class="material-icons">block</i></button>
		            		<?php break;
		            		case '4': ?>
				            	<button class="btn-floating gray tooltipped" data-position="bottom" data-delay="50" data-tooltip="Pending" value="Pending"><i class="large material-icons">assignment</i></button>
				            	<button class="btn-floating blue tooltipped" data-position="bottom" data-delay="50" data-tooltip="Approve" value="Approved"><i class="material-icons">thumb_up</i></button>
				            	<button class="btn-floating red tooltipped" data-position="bottom" data-delay="50" data-tooltip="Reject" value="Rejected"><i class="material-icons">thumb_down</i></button>
		            		<?php break; } ?>
		            </td>
		            <!-- <td><?php echo generate_reference_number($reservations[$i]->full_name) ?></td> -->
		          </tr>
		         <?php }} ?>
		        </tbody>
		    </table>
		</div>
	</div>
</div>

<script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.material.min.js"></script>
<script>
	$(function(){
		$('.rosrac-reservation-action-btn-container > button').click(function(){
			var tr = $(this).parents('.rosrac-reservation-details-container');
			var st_val = $(this).val();	// e.g. Pending, Approved,... 
			var res_id = tr.data('id');	// in db: reservation_details.id


			$.post('reservation/update_reservation_status', {res_id: res_id, st_val: st_val}, function(data){
				alert(1);
			});			
		});

		$('#rosrac-reservation-table').DataTable({
			"order": [[ 0, "asc" ]],
			"pagingType": "full_numbers",
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"columnDefs": [{ orderable: false, targets: [5] }],
			"stateSave": true
		});
	});
</script>