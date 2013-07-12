<?php
class Media {
    function get_all_media() {
        $posts = array();
        $dom = new DOMDocument();
        if(isset($_GET['p'])) {
            if(is_numeric($_GET['p'])) {
                $page = $_GET['p'];
            }
        }
        @$dom->loadHTMLFile('http://www.dumpert.nl/' . @$page);

        // find all tables
        $tables = $dom->getElementsByTagName('section');
//        echo $tables->item(0)->nodeValue;
        // get all rows from the first table
        @$rows = $tables->item(1)->getElementsByTagName('a');
        //echo $rows->item(09)->nodeValue;
        foreach ($rows as $row) {
            $title = $row->getElementsByTagName('h1');
            @$test = $title->item(0)->nodeValue;
            if($test != null) {
                $date = $row->getElementsByTagName('date');
                $stats_desc = $row->getElementsByTagName('p');
                $link = $row->getAttribute('href');
                
                $med = new DOMDocument();
                @$med->loadHTMLFile($link);
                $tab = $med->getElementsByTagName('section');
                $linkvid = $tab->item(1)->getElementsByTagName('div');
                $vid = $linkvid->item(2)->getAttribute('data-vidurl');
                   
                @$obj['title'] = $title->item(0)->nodeValue;
                @$obj['date'] = $date->item(0)->nodeValue;
                @$obj['stats'] = $stats_desc->item(0)->nodeValue;
                @$obj['description'] = $stats_desc->item(1)->nodeValue;
                @$obj['link'] = $link;
                @$obj['video'] = $vid;
                $posts[] = $obj;
            }
        }
        return $posts;
    }
}