<?php
   include 'config.php';
   include 'globalvariables.php';
   
function isSuperUser() {
    if (in_array($_SESSION['user']['username'], $config['SUPER_USERS'])) {
        return true;
    } else {
        return false;
    }
}

function mapNames($mapnames) {
    $arrlength=count($mapnames);
    for($x=0;$x<$arrlength;$x++)
      {
      echo "<option>";
      echo $mapnames[$x];
      echo "</option>";
      }
}

function sanitize($input){
    if(get_magic_quotes_qpc($input)){

        $input = trim($input); // get rid of white space left and right
        $input = htmlentities($input); // convert symbols to html entities
        return $input;
    } else {

        $input = htmlentities($input); // convert symbols to html entities
        $input = addslashes($input); // server doesn't add slashes, so we will add them to escape ',",\,NULL
        $input = mysql_real_escape_string($input); // escapes \x00, \n, \r, \, ', " and \x1a
        return $input;
    }
}

?>

