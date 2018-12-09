<?php
		session_start();

		$validacio=$HTTP_POST_VARS['validacio'];
		$idioma_nom=$HTTP_POST_VARS['idioma_nom'];
	

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

else{

	include("common_variables.php");		$query_string="DELETE FROM idiomes WHERE idioma_ID=".$HTTP_POST_VARS['idioma_ID'];			
	$resultats=mysql_query($query_string, $link_ID);
				
		
	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}	
		
	else {
		header("Location: ./tots_idiomes.php?validacio=$validacio&flag=1&idioma_nom=$idioma_nom"); /* Redirect browser */
		}	
		
}//for the else		
?>		
