<?php 
/**
 * Languages
 *
 * @return void
 */
function getUserLanguage(){

    if(isset($_GET['lang']) && !empty($_GET['lang'])){

       $lang = str_secure(strtolower($_GET['lang']));
       $available = ['en','fr'];

       return (in_array($lang,$available)) ? $lang : DEFAULT_LANGUAGE;
        //    if(in_array($lang,$available)){

    //          return $lang;

    //    } 
    //    else {

    //     return DEFAULT_LANGUAGE;
    //    }

       require '../lang/'.$available.'/'.$_GET['lang'].'.php';

   
    }else {

        if(isset($_SESSION['lang']) && !empty($_SESSION['lang'])){

            return $_SESSION['lang'];
            require '../lang/' . $available . '/' . $_SESSION['lang'] . '.php';
        }

        else {

            return DEFAULT_LANGUAGE;
        }
    }
}

/**
 * recupere la langue de la page
 *
 * @param [type] $lang
 * @param [type] $pages
 * @return object
 */
function getPageLanguage($lang,$pages){

  $dataPage = [];

  foreach($pages as $p){

    $jsonString = file_get_contents('lang/'.$lang.'/'.$p.'.json');
    $json = json_decode($jsonString);
    $dataPage[$p] = $json;
  }

  return (object) $dataPage;

}


function lang($string)
{

    if($_SESSION['lang'] == "en" && !empty($_SESSION['lang'])){

          return $string .'-'.'English';
    }

    else if($_SESSION['lang'] == "fr" && !empty($_SESSION['lang'])) {

          return $string.'-'.'francais';
    }
    
    else{

        return $string;
    }

}
