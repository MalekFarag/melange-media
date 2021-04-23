<?php

function redirect_to($location){
    if($location != null){
        header('Location: '.$location);
        exit;
    }
}

function getYTID($url){

    // parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
    // echo $my_array_of_vars['v='];

    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    $youtube_id = $match[1];

    echo $youtube_id;
}

function convertDate($date){

    $newDate = date("d.m.Y", strtotime($date));
    echo $newDate;
}

function displayTags($tags){

    
        $links = array();
        $parts = explode(',', $tags);
        $parts2 = str_ireplace("'",  "&apos;", $parts);
        foreach ($parts2 as $tag)
        {
            $newtag = trim($tag);
            

            //add prefix to var to link to proper area
            // $links[] = "<a class='tag' href='./tags?t=".$newtag."'>".$newtag."</a>";
            // $links[] = "$newtag $newtag";
            $links[] = "<span class='tag'>$newtag</span>";
        }

        //remove , to remove comma
        echo implode(" ", $links);
        // echo $links;
    

}

function displayTags2($tags){

    
    $links = array();
    $parts = explode(',', $tags);
    $parts2 = str_ireplace("'",  "&apos;", $parts);
    foreach ($parts2 as $tag)
    {
        $newtag = trim($tag);
        

        //add prefix to var to link to proper area
        $links[] = "<a class='tag' href='./tags?t=".$newtag."'>".$newtag."</a>";
        // $links[] = "$newtag $newtag";
        // $links[] = "<span class='tag'>$newtag</span>";
    }

    //remove , to remove comma
    echo implode(" ", $links);
    // echo $links;


}

