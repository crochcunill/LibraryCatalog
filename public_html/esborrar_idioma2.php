<?php
		session_start();

		$validacio=$_POST['validacio'];
		$idioma_nom=$_POST['idioma_nom'];
	

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

else{

	include("common_variables.php");	
	$query_string="DELETE FROM idiomes WHERE idioma_ID=".$_POST['idioma_ID'];			
	
	
	if (mysqli_query($link_ID,$query_string)){

			header("Location: ./tots_idiomes.php?validacio=$validacio&flag=1&idioma_nom=$idioma_nom"); /* Redirect browser */
	
	}
	else{
		$mysqli_error=mysqli_error($link_ID);
		echo "===> $mysqli_error <BR>";
	}
				
		
}//for the else		
?>		
