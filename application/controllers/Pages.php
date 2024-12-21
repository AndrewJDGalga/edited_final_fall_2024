<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
    public function view($page = 'home') {
        if( ! file_exists(APPPATH.'views/pages/'.$page.'.php')) {
            show_404();
        }
        
        $this->load->model('news_model');
        $data['news'] = $this->news_model->get_news();

        $top_stories = [
            'news' => []
        ];
        $top_stories = $this->news_model->get_top_stories();

        for($i = 0; $i < count($data['news']); $i++){
            if($data['news'][$i]['importance'] === '1') $top_stories['news'][] = $data['news'][$i];
        }

        $this->load->model('location_model');
        $ip = $this->location_model->get_visitor_ip();
        $loc = $this->location_model->ip_to_pos($ip);
        if($loc !== false){
            $this->load->model('weather_model');
            $data['weather'] = $this->weather_model->get_temperature($loc[0],$loc[1]);
            $data['ip'] = $ip;
            $data['measure'] = 'F';
        }

        $data['nav_button'] = [
            ['name'=>'Home', 'location'=> '/home', 'class'=>''],
            ['name'=>'About', 'location'=> '/about', 'class'=>''],
            ['name'=>'News', 'location'=> '/news', 'class'=>''],
            ['name'=>'Contact', 'location'=> '/contact', 'class'=>'']
        ];
        
        for($i = 0; $i < count($data['nav_button']); $i++){
            if(!str_contains($data['nav_button'][$i]['location'], $page)){
                $data['nav_button'][$i]['class'] = "other-page-link";
            } else {
                $data['title'] = $data['nav_button'][$i]['name'];
            }
        }

        $this->parser->parse('templates/header', $data);
        
        $this->load->view('templates/empty_div_start');
        $this->parser->parse('templates/main_nav', $data);
        if($ip && $loc) $this->parser->parse('templates/weather_ui', $data);
        $this->load->view('templates/empty_div_end');
        
        $this->parser->parse('pages/'.$page, $top_stories);
        $this->parser->parse('templates/footer', $data);
        
        
    }
}