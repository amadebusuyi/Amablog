<?php
function makeRand($len, $type = "alpha-num"){
	$result = "";
    $chars = "0123456789abcdefghijklmnpqrstuvwABCDEFGHIJKLMNPQRST";
    if($type === "num")
        $chars = '0123456789';
     if($type === "upper-num")
        $chars       = 'ABCDEFGHIJKLMNPQRSTUVWXYZ0123456789';
     if($type === "lower-num")
        $chars       = 'abcdefghijklmnopqrstuvwxyz0123456789';
     if($type === "upper")
        $chars       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
     if($type === "lower")
        $chars       = 'abcdefghijklmnopqrstuvwxyz';
     if($type === "alpha")
        $chars       = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}

function is_present($arr, $keyword) {
    foreach($arr as $index => $string) {
        if (strpos(strtolower($string), strtolower($keyword)) !== FALSE)
            return $index;
    }
}

function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function fetch_page($path){
  if(file_exists($path)){
    return $path;
  }

  else{
    error_page();
  }
}

function load_page($page, $title){
  $title = "AMABLOG | ".$title;

    include "inc/header.php";

    require $page;

    include "inc/footer.php";
}


function error_page(){
  $title = "404 page";
  load_page("404.php", $title, "404");
}