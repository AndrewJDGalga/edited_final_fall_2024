<?php
class News_model extends CI_Model {
    public function get_news($slug = FALSE) {
        $url = '{supabase_url}';

        $temp = [];
        $news = [];
        $raw = @file_get_contents($url);
        if($raw !== false) $temp = json_decode($raw, true);

        if(!$slug) $news = $temp;
        else {
            for($i = 0; $i < count($temp); $i++){
                if($temp[$i]['slug'] === $slug) $news = $temp[$i]; 
            }
        }
        
        return $news;
    }

    public function get_top_stories(){
        $top = [];
        $news = $this->get_news();

        for($i = 0; $i < count($news); $i++){
            if($news[$i]['importance'] === TRUE) $top['news'][] = $news[$i]; 
        }
        
        return $top;
    }
}