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

	$autor_nom_res=checkvalues($_POST['autor_nom']);
	$autor_cognoms_res=checkvalues($_POST['autor_cognoms']);
	$autor_biografia_res=checkvalues($_POST['autor_biografia']);
	

	if (checklenght($_POST['autor_nom'])=="false" || $autor_nom_res[0]=="false" ||$autor_cognoms_res[0]=="false" || $autor_biografia_res[0]=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi ha el caracter <B>".$autor_nom_res[1][0].$autor_cognoms_res[1][0].$autor_biografia_res[1][0]."</B> no valid en la combinacio <I>nom/cognoms/llengua/biografia</I>. Intenteu de nou";					include("peu2.txt");
			$PerformQuery=0;					
			}	
	else{		
			include("common_variables.php");
			
			$query_string="UPDATE autors set  autor_nom='" . $_POST['autor_nom']. "',autor_cognoms='" . $_POST['autor_cognoms'] . "',autor_idioma_ID='".$_POST['autor_idioma_ID']."',autor_biografia='" .$_POST['autor_biografia']. "' where autor_ID='".$_POST['autor_ID']."'";	
			$resultats=mysqli_query($link_ID,$query_string,1);
			
			$mysqli_error=mysqli_error($link_ID);
							
			if (!empty($mysqli_error)){
					echo "<BR>query string ".$query_string;	
					echo "===> $mysqli_error<BR>";
					}
			else{
					header("Location: ./tots_autors_nom.php?validacio=".$validacio."&flag=3&autor_nom=".$_POST['autor_nom']. "&autor_cognoms=" . $_POST['autor_cognoms']."&pagina_actual=".$_POST['pagina_actual']); /* Redirect browser */
					exit;
					}				
			} //end else (checklenght($_POST['editorial....		

		
?>			