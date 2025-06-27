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
			
	//At least the editorial name must exists!
	if (checklenght($_POST['editorial_nom'])=="false" || checkvalues($_POST['editorial_nom'])=="false" || checkvalues($_POST['editorial_colleccio'])=="false" || checkvalues($_POST['editorial_adreca'])=="false" || checkvalues($_POST['editorial_extra'])=="false") {
		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		echo "<P>Hi han caràcters no valids en la combinacio <I>Nom de l'editorial/Col.lecció/Adreça/Altre Informació</I>. Intenteu de nou";				include("peu2.txt");					
		}	
	else{
		include("common_variables.php");			
		$query_string="INSERT INTO editorials (editorial_nom,editorial_colleccio,editorial_adreca,editorial_extra) VALUES ('" . $_POST['editorial_nom']. "','" . $_POST['editorial_colleccio'] . "','" .$_POST['editorial_adreca']. "','" .$_POST['editorial_extra']. "')";	
		$resultats=mysqli_query($link_ID,$query_string, 1);
									
		$mysqli_error=mysqli_error($link_ID);							
		if (!empty($mysqli_error)){	
			echo "<BR>query string ".$query_string;	
			echo "===> $mysqli_error<BR>";
			}
		else{
			header("Location: ./totes_editorials_nom.php?validacio=".$validacio."&flag=2&editorials_nom=".$_POST['editorials_nom']. "&editorials_cognoms=" . $_POST['editorials_cognoms']); /* Redirect browser */
			exit;
			}		
				
		} //end else (checklenght($_POST['editorial....		

?>			