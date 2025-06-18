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

	//At least the idioma description name must exists!
	if (checklenght($_POST['idioma_nom'])=="false" || checkvalues($_POST['idioma_nom'])=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracters no valids en la <I>nom</I> de l'idioma. Intenteu de nou";					include("peu2.txt");					
		}		
	else{
			include("common_variables.php");
			$query_string="UPDATE idiomes SET idioma_nom='" . $_POST['idioma_nom']. "' where idioma_ID=".$_POST['idioma_ID'];	
			$resultats=mysqli_query($link_ID,$query_string,1);
			
			$mysqli_error=mysqli_error($link_ID);
					
			if (!empty($mysqli_error)){
					echo "<BR>query string ".$query_string;	
					echo "===> $mysqli_error<BR>";
				}
			else{
					header("Location: ./tots_idiomes.php?validacio=".$validacio."&flag=3&idioma_nom=".$_POST['idioma_nom']); /* Redirect browser */
					exit;
				}			
		} //end else (checklenght($_POST['idioma....		

	
?>			