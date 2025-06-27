<?php
		session_start();

		$validacio=$_POST['validacio'];
		$autor_nom=$_POST['autor_nom'];
		$autor_cognoms=$_POST['autor_cognoms'];
		$titol_ID=$_POST['titol_ID'];
		$titol_nom=$_POST['titol_nom'];

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

	include("common_variables.php");		
	$query_string="DELETE FROM titols WHERE titol_id=".$_POST['titol_ID'];			
	
	$resultats=mysqli_query($link_ID,$query_string, 1);
				
		
	$mysqli_error=mysqli_error($link_ID);			
	if (!empty($mysqli_error)){
			echo "===> $mysqli_error<BR>";
		}	
		
	else {
		header("Location: ./tots_titols_nom.php?validacio=$validacio&flag=1&titol_nom=$titol_nom&autor_nom=$autor_nom&autor_cognoms=$autor_cognoms&pagina_actual=1"); /* Redirect browser */
		}	
?>		
