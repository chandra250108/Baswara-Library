<?php
class Welcome extends CI_Controller {
    
    public function index() {
        redirect('auth/login');
    }
}
?>