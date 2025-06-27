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

	$titol_nom_res=checkvalues($_POST['titol_nom']);
	$titol_sinopsis_res=checkvalues($_POST['titol_sinopsis']);
	
	//if (checklenght($_POST['titol_nom'])=="false" || checkvalues($_POST['titol_nom'])[0]=="false") {
	if (checklenght($_POST['titol_nom'])=="false" ||$titol_nom_res[0]=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracter <B>".$titol_nom_res[1][0]."</B> no valid en el <I>t�tol</I>. Torneu endarrera utilitzant el bot� del vostre navegador.";
			include("peu2.txt");					
			}
	else if((checklenght($_POST['titol_pagines'])=="false") || (isnumber($_POST['titol_pagines'])=="false") ){ 
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Heu d'entrar el nombre de pagines";
			include("peu2.txt");
			}
	else if((checklenght($_POST['titol_any'])!="false") && (isnumber($_POST['titol_any'])=="false") ){ 
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Si entreu l'any, heu d'entrar un numero.";
			include("peu2.txt");
			}		
	//else if(checkvalues($_POST['titol_sinopsis'])[0]=="false"){
	else if($titol_sinopsis_res[0]=="false"){ 
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Heu entrat caracter <B>".$titol_sinopsis_res[1][0]."</B> no valid a la <I>sinopsis</I>. Torneu endarrera utilitzant el bot� del vostre navegador.";
			include("peu2.txt");		
			}		
			
	else{		
			include("common_variables.php");
	
			$query_string="UPDATE titols SET titol_nom='".escapeComma($_POST['titol_nom'])."'";
			
			$query_string=$query_string.",titol_autor_ID='".$_POST['titol_autor_ID']."'";
			$query_string=$query_string.",titol_editorial_ID='".$_POST['titol_editorial_ID']."'";
			$query_string=$query_string.",titol_procedencia_ID='".$_POST['titol_procedencia_ID']."'";
			$query_string=$query_string.",titol_ISBN='".$_POST['titol_ISBN']."'";
			$query_string=$query_string.",titol_pagines='".$_POST['titol_pagines']."'";
			
			$query_string=$query_string.",titol_categoria_ID='".$_POST['categoria']."'";//Hauria de ser titols_categoria_ID, pero degut al JavaScript, es millor utilitzar nomes categoria, ja que el programa utilitza aquesta etiqueta per informar a l'usuari
			$query_string=$query_string.",titol_medi_ID='".$_POST['medi']."'";//Hauria de ser titol_medi_ID per la mateixa rao que abans
				
			$query_string=$query_string.",titol_sinopsis='".escapeComma($_POST['titol_sinopsis'])."'";
			$query_string=$query_string.",titol_idioma_ID='".$_POST['titol_idioma_ID']."'";
			$query_string=$query_string.",titol_any='".$_POST['titol_any']."'";
			$query_string=$query_string.",titol_cataleg='".$_POST['titol_cataleg']."'";
			$query_string=$query_string.",titol_status='".$_POST['titol_status']."'";			
			$query_string=$query_string." WHERE titol_ID='".$_POST['titol_ID']."'";


			$resultats=mysqli_query($link_ID,$query_string, 1);
			
			$mysqli_error=mysqli_error($link_ID);							
			if (!empty($mysqli_error)){
					echo "<BR>query string ".$query_string;	
					echo "===> $mysqli_error<BR>";
					}
			else{
					header("Location: ./tots_titols_nom.php?validacio=".$validacio."&flag=3&autor_nom=".$_POST['autor_nom']. "&autor_cognoms=" . $_POST['autor_cognoms']."&pagina_actual=".$_POST['pagina_actual']); /* Redirect browser */
					exit;
					}				
			} //end else (checklenght($_POST['editorial....		

		
?>			