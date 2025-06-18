<?php
	session_start();

	$validacio=$_POST['validacio'];
                    include("common_variables.php");
	if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		}  
	
	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************

	//At least the editorial name must exists!
	if (checklenght($_POST['editorial_nom'])=="false" || checkvalues($_POST['editorial_nom'])=="false" || checkvalues($_POST['editorial_colleccio'])=="false" || checkvalues($_POST['editorial_adreca'])=="false" || checkvalues($_POST['editorial_extra'])=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracters no valids en la combinacio <I>Nom de l'editorial/Col.lecció/Adreça/Altre Informació</I>. Intenteu de nou";		
			include("peu2.txt");
			$PerformQuery=0;					
			}		
	else{
			//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");						
			//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
			$query_string="UPDATE editorials set  editorial_nom='" . escapeComma($_POST['editorial_nom']). "',editorial_colleccio='" . $_POST['editorial_colleccio'] . "',editorial_adreca='".escapeComma($_POST['editorial_adreca'])."',editorial_extra='" .escapeComma($_POST['editorial_extra']). "' where editorial_ID=".$_POST['editorial_ID'];	
			$resultats=mysqli_query($link_ID,$query_string, 1);
			
			$mysqli_error=mysqli_error($link_ID);
					
			if (!empty($mysqli_error)){
					echo "<BR>query string ".$query_string;	
					echo "===> $mysqli_error<BR>";
					}
			else{
					header("Location: ./totes_editorials_nom.php?validacio=".$validacio."&flag=3&editorial_nom=".$_POST['editorial_nom']. "&editorial_colleccio=" . $_POST['editorial_colleccio']); /* Redirect browser */
					exit;
					}
				
		} //end else (checklenght($_POST['editorial....		

	
?>			
