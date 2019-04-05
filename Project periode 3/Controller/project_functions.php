<!-- project_functions.php -->
<?php

function get_pag(){
	$pag_get = ""; 

	if(isset($_GET['p'])){
	$pag_get = $_GET['p'];
	}
	return $pag_get;
}


function post_pag(){
	$pag_post = ""; 

	if(isset($_POST['p'])){
	$pag_post = $_POST['p'];
	}
	return $pag_post;
}

?>