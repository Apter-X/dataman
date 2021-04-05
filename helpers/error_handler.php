<?php
//error handler function
function customError($errno, $errstr) {
    echo "<b>Error:</b> [$errno] $errstr";
    die();
}

//set error handler
set_error_handler("customError");
