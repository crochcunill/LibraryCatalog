<?php
		session_start();

		$validacio=$_POST['validacio'];
		$procedencia_nom=$_POST['procedencia_descripcio'];
	
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
	
	$query_string="DELETE FROM procedencies WHERE procedencia_ID=".$_POST['procedencia_ID'];
			
	$resultats=mysqli_query($link_ID,$query_string, 1);
				
		
	$mysqli_error=mysqli_error($link_ID);		
	if (!empty($mysqli_error)){
		echo "2===> $mysqli_error<BR>";
		}	
		
	else {
		header("Location: ./totes_procedencies.php?validacio=$validacio&flag=1&procedencia_descripcio=$procedencia_descripcio"); /* Redirect browser */
		}	
		
}//for the else		
?>		

