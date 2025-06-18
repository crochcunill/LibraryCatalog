<?php
		session_start();

		$validacio=$_POST['validacio'];
		$editorial_nom=$_POST['editorial_nom'];
		$editorial_colleccio=$_POST['editorials_colleccio'];

		include("common_variables.php");

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */

		exit;
		} 

else{

	//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");
				
	//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
	
	$query_string="DELETE FROM editorials WHERE editorial_ID=".$_POST['editorial_ID'];			
	$resultats=mysqli_query($link_ID,$query_string, 1);
				
		
	$mysqli_error=mysqli_error($link_ID);
	if (!empty($mysqli_error)){
			echo "===> $mysqli_error<BR>";
		}	
		
	else {
		header("Location: ./totes_editorials_nom.php?validacio=$validacio&flag=1&editorial_nom=$editorial_nom&editorial_colleccio=$editorial_colleccio"); /* Redirect browser */
		}	
		
}//for the else		
?>		

