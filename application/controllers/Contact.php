<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
    public function index() {
        $data['title'] = 'Contact';
        $data['nav_button'] = [
            ['name'=>'Home', 'location'=> '/home', 'class'=>''],
            ['name'=>'About', 'location'=> '/about', 'class'=>''],
            ['name'=>'News', 'location'=> '/news', 'class'=>''],
            ['name'=>'Contact', 'location'=> '/contact', 'class'=>'']
        ];
        for($i = 0; $i < count($data['nav_button']); $i++){
            if(!str_contains($data['nav_button'][$i]['location'], 'contact')){
                $data['nav_button'][$i]['class'] = "other-page-link";
            }
        }

        $data['spinner'] = $this->load->view('templates/loading_spinner', '', TRUE);

        $this->parser->parse('templates/header', $data);
        $this->parser->parse('templates/main_nav', $data);
        $this->parser->parse('contact/index', $data);
        $this->parser->parse('templates/footer', $data);
    }

    public function process_form() {
        $FROM = 'test@test.com';
        $subject = '(NewsGems)Inquery from ';
        $MAX_MESSAGE = 1000;
        $MAX_EMAIL = 64;

        if($this->input->is_ajax_request()){
            $result = ['test'=>'test'];
            $cleanedEmail = htmlspecialchars(trim(stripslashes($this->input->post("email"))));
            $cleanedMessage = htmlspecialchars(trim($this->input->post("message")));
            $cleanedEmail = filter_var($cleanedEmail, FILTER_VALIDATE_EMAIL);

            if(!$cleanedEmail || strlen($cleanedEmail) > $MAX_EMAIL) $result['error_email'] = true;
            if(strlen($cleanedMessage) == 0 || strlen($cleanedMessage) > $MAX_MESSAGE) $result['error_message'] = true;

            if(!key_exists('error_email', $result) && !key_exists('error_message', $result)){
                $subject .= $cleanedEmail;
                $data = [
                    'from' => $FROM,
                    'to' => $cleanedEmail,
                    'subject' => $subject, 
                    'message' => $cleanedMessage
                ];
                $this->load->model('email_model');
                $result['sent_email'] = $this->email_model->send_email($data);
            }

            echo json_encode($result);
        }
    }
}