<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `action_list` where id = '{$_GET['id']}' and delete_flag = 0 ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }else{
		echo '<script>alert("Action ID is not valid."); location.replace("./?page=actions")</script>';
	}
}else{
	echo '<script>alert("Action ID is required."); location.replace("./?page=actions")</script>';
}
?>
<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>
<div class="container-fluid" id="printArea">
	<dl>
		<dt class="text-muted">Name</dt>
		<dd class="pl-4"><?= isset($name) ? $name : "" ?></dd>
		<dt class="text-muted">Status</dt>
		<dd class="pl-4">
			<?php if($status == 1): ?>
				<span class="badge badge-success px-3 rounded-pill">Active</span>
			<?php else: ?>
				<span class="badge badge-danger px-3 rounded-pill">Inactive</span>
			<?php endif; ?>
		</dd>
	</dl>
</div>
<hr class="mx-n3">
<div class="text-right pt-1">
	<button class="btn btn-sm btn-flat btn-light bg-gradient-light border" type="button" data-dismiss="modal">
		<i class="fa fa-times"></i> Close
	</button>
	<button class="btn btn-sm btn-flat btn-success" onclick="printContent()">
		<i class="fa fa-print"></i> Print
	</button>
</div>

<script>
	function printContent() {
		var printArea = document.getElementById('printArea').innerHTML;
		var originalContent = document.body.innerHTML;

		document.body.innerHTML = "<html><head><title>Print</title></head><body>" + printArea + "</body></html>";
		window.print();
		document.body.innerHTML = originalContent;
		location.reload(); // Reload page to restore content after print
	}
</script>
