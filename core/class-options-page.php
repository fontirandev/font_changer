<?php

/**
 * Class Fontiran_Options_Page.
 */
class Fontiran_Options_Page extends WP_Fontiran_Admin_Page {


	public function on_load() {
		$this->check_change_data();
		$this->send_notices();
	}

	protected function render_inner_content() {

		$this->view( $this->slug . '-page');
	}

	protected function set_notices($ms = array()) {
		$i = count($this->upload_report);
		return $this->upload_report[$i] = $ms;
		
	}
	
	protected function send_notices() {		
		return $this->set_all_notices($this->upload_report);
	}
	
	protected function bytes_to_mb($bytes) {
		return round(($bytes / 1048576), 2);
	}

	
	public function check_change_data() {
		$fi_reset =$_POST['fi_reset']; 
		$fi_reset=sanitize_html_class($fi_reset);
		if(isset($fi_reset))  {
			
			if (!isset($_POST['fiwp_nonce']) || !wp_verify_nonce($_POST['fiwp_nonce'], 'fiwp'))
				return $this->set_notices( array('type'=>'error', 'ms'=> 'یک چیزی درست نیست!') );	
			
			update_option('fontiran_default_options','1');
			return $this->set_notices( array('type'=>'success', 'ms'=> 'پیکربندی فونت ها بازنشانی شد.') );	
		}
			
		
	}

}