<?php
	session_start();

	$validacio=$_POST['validacio'];
	$autor_nom=$_POST['autor_nom'];
	$autor_cognoms=$_POST['autor_cognoms'];

	if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

	include("common_variables.php");
	$query_string="Select count(*) FROM titols WHERE titol_autor_id=".$_POST['autor_ID'];			
	$resultats=mysqli_query($link_ID,$query_string, 1);
	$els_resultats=mysqli_fetch_row($resultats);
	if ($els_resultats[0]>0){
		header("Location: ./tots_autors_nom.php?validacio=$validacio&flag=4&autor_nom=$autor_nom&autor_cognoms=$autor_cognoms&pagina_actual=1"); /* Redirect browser */
		exit;
		} 

	mysqli_free_result($resultats);	
	
	$query_string="DELETE FROM autors WHERE autor_id=".$_POST['autor_ID'];				
	
	
	if (mysqli_query($link_ID,$query_string)){
		header("Location: ./tots_autors_nom.php?validacio=$validacio&flag=1&autor_nom=$autor_nom&autor_cognoms=$autor_cognoms&pagina_actual=1"); /* Redirect browser */
	}
	else{
		$mysqli_error=mysqli_error($link_ID);
		echo "===> $mysqli_error <BR>";
	}
		
?>		
