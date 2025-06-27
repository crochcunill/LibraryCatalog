<?php
		session_start();

		$validacio=$_POST['validacio'];
		$medi_nom=$_POST['medi_nom'];
	                    include("common_variables.php");

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */

		exit;
		} 

else{

	//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");
				
	//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
	
	$query_string="DELETE FROM medis WHERE medi_ID=".$_POST['medi_ID'];
			
	$resultats=mysqli_query($link_ID,$query_string, 1);
				
		
	$mysqli_error=mysqli_error($link_ID);				
	if (!empty($mysqli_error)){
			echo "===> $mysqli_error<BR>";
		}	
		
	else {
		header("Location: ./tots_medis.php?validacio=$validacio&flag=1&medi_nom=$medi_nom"); /* Redirect browser */
		}	
		
}//for the else		
?>		

