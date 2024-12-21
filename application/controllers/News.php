<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
    public function index() {
        $this->load->model('news_model');
        
        $data['news'] = $this->news_model->get_news();
        $data['title'] = 'News archive';

        for($i = 0; $i < count($data['news']); $i++){
            if($data['news'][$i]['importance'] === TRUE) $data['news'][$i]['classes'] = 'top-story';
            else $data['news'][$i]['classes'] = '';
        }

        $this->render($data, 'news');
    }
    public function view($slug = NULL) {
        $this->load->model('news_model');

        $data['news_item'] = $this->news_model->get_news($slug);

        if(empty($data['news_item'])) {
            show_404();
        }

        $data['title'] = $data['news_item']['title'];
        $data['text'] = $data['news_item']['text'];
        $this->render($data, $slug);
    }
    public function render($data, $location) {
        $data['nav_button'] = [
            ['name'=>'Home', 'location'=> '/home', 'class'=>''],
            ['name'=>'About', 'location'=> '/about', 'class'=>''],
            ['name'=>'News', 'location'=> '/news', 'class'=>''],
            ['name'=>'Contact', 'location'=> '/contact', 'class'=>'']
        ];
        for($i = 0; $i < count($data['nav_button']); $i++){
            if(!str_contains($data['nav_button'][$i]['location'], $location)){
                $data['nav_button'][$i]['class'] = "other-page-link";
            }
        }

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('templates/main_nav', $data);

        if($location === 'news') $this->parser->parse('news/index', $data);
        else $this->parser->parse('news/view', $data);
        
        $this->parser->parse('templates/footer', $data);
    }
}