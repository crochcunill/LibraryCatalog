<?php
		session_start();
		$validacio=$_POST['validacio'];
		$categoria_nom=$_POST['categoria_nom'];
	                    include("common_variables.php");

	if ($validacio!=session_id()){
			session_destroy();
			header("Location: ./Error.php?error=1"); /* Redirect browser */
			exit;
			} 

	//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");
				
	//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
	
	$query_string="DELETE FROM categories WHERE categoria_ID=".$_POST['categoria_ID'];
			
	$resultats=mysqli_query($link_ID,$query_string, 1);
				
		
	$mysqli_error=mysqli_error($link_ID);
	if (!empty($mysqli_error)){
		echo "===> $mysqli_error<BR>";
		}			
	else {
		header("Location: ./totes_categories.php?validacio=$validacio&flag=1&categoria_nom=$categoria_nom"); /* Redirect browser */
		}	
		
?>		

