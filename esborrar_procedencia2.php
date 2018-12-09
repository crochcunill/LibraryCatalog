<?php
		session_start();

		$validacio=$HTTP_POST_VARS['validacio'];
		$procedencia_nom=$HTTP_POST_VARS['procedencia_descripcio'];
	
                                         include("common_variables.php");
if ($validacio!=session_id()){
		session_destroy();
		//header("Location: ./Error.php?error=1"); /* Redirect browser */
echo "<P>validacio  " .$validacio;
echo "<P>session_id()  " .session_id();


		exit;
		} 

else{

	//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");
				
	//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
	
	$query_string="DELETE FROM procedencies WHERE procedencia_ID=".$HTTP_POST_VARS['procedencia_ID'];
			
	$resultats=mysql_query($query_string, $link_ID);
				
		
	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}	
		
	else {
		header("Location: ./totes_procedencies.php?validacio=$validacio&flag=1&procedencia_descripcio=$procedencia_descripcio"); /* Redirect browser */
		}	
		
}//for the else		
?>		

