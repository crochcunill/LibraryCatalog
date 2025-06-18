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
		
	if (checklenght($_POST['medi_nom'])=="false" || checkvalues($_POST['medi_nom'])=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracters no valids en el <I>nom del medi</I>. Intenteu de nou";
			include("peu2.txt");					
		}	
	else{	
			include("common_variables.php");			$query_string="INSERT INTO medis (medi_nom) VALUES ('" . $_POST['medi_nom'] . "')";	
			$resultats=mysqli_query($link_ID,$query_string);
					
			$mysqli_error=mysqli_error($link_ID);
							
			if (!empty($mysqli_error)){		
					echo "<BR>query string ".$query_string;	
					echo "===> $mysqli_error<BR>";
				}
			else{
					header("Location: ./tots_medis.php?validacio=".$validacio."&flag=2&medi_nom=".$_POST['medi_nom']); /* Redirect browser */
					exit;
				}	
				
		} //end else (checklenght($_POST['editorial....		

?>			