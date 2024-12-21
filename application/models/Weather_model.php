<?php
class Weather_model extends CI_Model {
    public function get_temperature($latitude = 0, $longitude = 0){
        $data = false;
        $raw = $this->get_data($latitude, $longitude);
        
        if(array_key_exists('current', $raw) && array_key_exists('temperature_2m', $raw['current'])) $data = $raw['current']['temperature_2m'];
        
        return $data;
    }

    function get_data($latitude, $longitude) {
        $success = [];
        $raw = @file_get_contents('https://api.open-meteo.com/v1/forecast?latitude=' . $latitude . '&longitude=' . $longitude .'&current=temperature_2m&hourly=temperature_2m&temperature_unit=fahrenheit&timezone=GMT&forecast_days=1&forecast_hours=1&models=best_match');

        if($raw !== false) $success = json_decode($raw, true);

        return $success;
    }
}