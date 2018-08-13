<?php defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('templates/_parts/preview_master_header_view'); ?>
<iframe src="<?= base_url('preview/'.trim($the_view_content)); ?>" style="position:fixed;top:0;left:0;overflow:auto;width:100%;height:100%;border:none"></iframe>