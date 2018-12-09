<?php
	session_start();

	$validacio=$HTTP_POST_VARS['validacio'];
	$autor_nom=$HTTP_POST_VARS['autor_nom'];
	$autor_cognoms=$HTTP_POST_VARS['autor_cognoms'];

	if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

	include("common_variables.php");
	$query_string="Select count(*) FROM titols WHERE titol_autor_id=".$HTTP_POST_VARS['autor_ID'];			
	$resultats=mysql_query($query_string, $link_ID);
	$els_resultats=mysql_fetch_row($resultats);
	if ($els_resultats[0]>0){
		header("Location: ./tots_autors_nom.php?validacio=$validacio&flag=4&autor_nom=$autor_nom&autor_cognoms=$autor_cognoms&pagina_actual=1"); /* Redirect browser */
		exit;
		} 

	$query_string="DELETE FROM autors WHERE autor_id=".$HTTP_POST_VARS['autor_ID'];			
	$resultats=mysql_query($query_string, $link_ID);
				
		
	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}	
		
	else {
		//echo "Location: ./tots_autors_nom.php?validacio=$validacio&flag=1&autor_nom=$autor_nom&autor_cognoms=$autor_cognoms";	
		header("Location: ./tots_autors_nom.php?validacio=$validacio&flag=1&autor_nom=$autor_nom&autor_cognoms=$autor_cognoms&pagina_actual=1"); /* Redirect browser */
		}		
?>		
