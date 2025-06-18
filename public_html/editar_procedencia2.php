<?php
		session_start();

		$validacio=$_POST['validacio'];

	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************



if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		}  

//At least the procedencia description name must exists!
if (checklenght($_POST['procedencia_descripcio'])=="false" || checkvalues($_POST['procedencia_descripcio'])=="false") {
		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		echo "<P>Hi han caracters no valids en la <I>Descripci� de la proced�ncia</I>. Intenteu de nou";				include("peu2.txt");
		$PerformQuery=0;					
		}		
else{
		include("common_variables.php");
		$query_string="UPDATE procedencies set  procedencia_descripcio='" . $_POST['procedencia_descripcio']. "' where procedencia_ID=".$_POST['procedencia_ID'];	
		$resultats=mysqli_query($link_ID,$query_string,1);
		
		$mysqli_error=mysqli_error($link_ID);			
		if (!empty($mysqli_error)){				
			echo "<BR>query string ".$query_string;	
			echo "===> $mysqli_error<BR>";
			}
		else{
			header("Location: ./totes_procedencies.php?validacio=".$validacio."&flag=3&procedencia_descripcio=".$_POST['procedencia_descripcio']); /* Redirect browser */
			exit;
			}
			
	} //end else (checklenght($_POST['procedencia....		

	
?>			