<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verify extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if (ENVIRONMENT !== 'development' || $_SERVER['REMOTE_ADDR'] !== '10.21.1.100') {
            $this->load->helper('url');
            redirect('/');
        }
    }
    
    public function index() {
        $data['environment']     = ENVIRONMENT;
        $data['loaded_classes']  = $this->load->get_loaded_classes();
        $data['loaded_helpers']  = $this->load->get_loaded_helpers();
        $data['loaded_models']   = $this->load->get_loaded_models();
        $data['config']          = $this->config->config;
        $data['loaded_database'] = 'Database is not loaded';
        if (isset($this->db) && $this->db->conn_id !== FALSE) {
            $data['loaded_database'] = 'Database is loaded and connected';
            $data['db_settings']     = array(
                'dsn' => $this->db->dsn,
                'hostname' => $this->db->hostname,
                'port' => $this->db->port,
                'username' => '***',
                'password' => '***',
                'database' => '***',
                'driver' => $this->db->dbdriver,
                'dbprefix' => $this->db->dbprefix,
                'pconnect' => $this->db->pconnect,
                'db_debug' => $this->db->db_debug,
                'cache_on' => $this->db->cache_on,
                'cachedir' => $this->db->cachedir,
                'char_set' => $this->db->char_set,
                'dbcollat' => $this->db->dbcollat,
                'swap_pre' => $this->db->swap_pre,
                'autoinit' => $this->db->autoinit,
                'encrypt' => $this->db->encrypt,
                'compress' => $this->db->compress,
                'stricton' => $this->db->stricton,
                'failover' => $this->db->failover,
                'save_queries' => $this->db->save_queries
            );
        }
        $cache_path = ($this->config->item('cache_path') === '') ? APPPATH . 'cache/' : $this->config->item('cache_path');
        if (is_really_writable($cache_path)) {
            $data['writable_cache'] = TRUE;
        }
        $log_path = ($this->config->item('log_path') === '') ? APPPATH . 'logs/' : $this->config->item('log_path');
        if (is_really_writable($log_path)) {
            $data['writable_logs'] = TRUE;
        }
        
        $this->load->view('verify_view', $data);
    }
}