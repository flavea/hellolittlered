<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/_parts/public_master_header_view'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
<script>
    $LAB.script("https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js").wait();
</script>
<div class="content-real">
	<div id="blog" style="float: none;margin: auto">
		<?= $the_view_content;?>
	</div>
</div>
<?php $this->load->view('templates/_parts/public_master_footer_view');?>