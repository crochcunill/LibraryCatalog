<?php
		session_start();

		$validacio=$HTTP_POST_VARS['validacio'];
		$autor_nom=$HTTP_POST_VARS['autor_nom'];
		$autor_cognoms=$HTTP_POST_VARS['autor_cognoms'];
		$titol_ID=$HTTP_POST_VARS['titol_ID'];
		$titol_nom=$HTTP_POST_VARS['titol_nom'];

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

	include("common_variables.php");		$query_string="DELETE FROM titols WHERE titol_id=".$HTTP_POST_VARS['titol_ID'];			
	
	$resultats=mysql_query($query_string, $link_ID);
				
		
	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}	
		
	else {
		header("Location: ./tots_titols_nom.php?validacio=$validacio&flag=1&titol_nom=$titol_nom&autor_nom=$autor_nom&autor_cognoms=$autor_cognoms&pagina_actual=1"); /* Redirect browser */
		}	
		
	
?>		
