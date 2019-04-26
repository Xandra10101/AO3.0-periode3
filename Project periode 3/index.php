<?php
    include('Controller/project_functions.php');
$pag_get = get_pag();
$pag_post = post_pag();
if($pag_post == "register"){
  include("Model/Databases/connection_database.php");
}
if($pag_get == "register"){
    include("View/register.php");
}else{
    include("View/inlog.php");
}

include('View/signup.php');


?>
