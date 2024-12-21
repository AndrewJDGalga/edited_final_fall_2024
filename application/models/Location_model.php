<?php
class Location_model extends CI_Model {
    public function get_visitor_ip() {
        return $_SERVER['REMOTE_ADDR'];
    }
    public function ip_to_city($address = '1.1.1.1') {
        $data = false;
        $raw = $this->get_data($address);

        if(array_key_exists('city', $raw)) $data = $raw['city'];

        return $data;
    }
    //Roughly city-accurate positioning
    public function ip_to_pos($address = '1.1.1.1'){
        $data = false;
        $raw = $this->get_data($address);
        
        if(array_key_exists('loc', $raw)) $data = explode(',', $raw['loc']);
        
        return $data;
    }

    function get_data($address) {
        $success = [];
        $raw = @file_get_contents('https://ipinfo.io/' . $address . '{token}');
        if($raw !== false) $success = json_decode($raw, true);
        return $success;
    }
}