<?php
class Email_model extends CI_Model {
    public function send_email($data){
        $success = true;

        $headers = "From: ". $data['from'] ."\r\n";
        $headers .= "Reply-To: ". $data['from'] ."\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        if(!mail($data['to'], $data['subject'], $data['message'], $headers)) $success = false;
        
        return $success;
    }
}