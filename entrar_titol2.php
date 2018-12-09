<?php
	session_start();
	$validacio=$HTTP_POST_VARS['validacio'];

	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************

	if ($validacio!=session_id()){
			session_destroy();
			header("Location: ./Error.php?error=1"); /* Redirect browser */
			exit;
			} 
	
	$titol_nom_res=checkvalues($HTTP_POST_VARS['titol_nom']);
	$titol_sinopsis_res=checkvalues($HTTP_POST_VARS['titol_sinopsis']);
	
	//if (checklenght($HTTP_POST_VARS['titol_nom'])=="false" || checkvalues($HTTP_POST_VARS['titol_nom'])[0]=="false") {
	if (checklenght($HTTP_POST_VARS['titol_nom'])=="false" ||$titol_nom_res[0]=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracter <B>".$titol_nom_res[1][0]."</B> no valid en el <I>títol</I>.";
				
			echo"<P>Piqueu <A href=\"entrar_titol.php?validacio=".$validacio."&titol_nom=".$HTTP_POST_VARS['titol_nom']."&titol_any=".$HTTP_POST_VARS['titol_any']."&titol_pagines=".$HTTP_POST_VARS['titol_pagines']."&titol_ISBN=".$HTTP_POST_VARS['titol_ISBN']."&titol_sinopsis=".$HTTP_POST_VARS['titol_sinopsis']."\">aquí</a> per tornar enderrere";	
		
	
			include("peu2.txt");					
			}
	else if((checklenght($HTTP_POST_VARS['titol_pagines'])=="false") || (isnumber($HTTP_POST_VARS['titol_pagines'])=="false") ){ 
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Heu d'entrar el nombre de pagines";
			echo"<P>Piqueu <A href=\"entrar_titol.php?validacio=".$validacio."&titol_nom=".$HTTP_POST_VARS['titol_nom']."&titol_any=".$HTTP_POST_VARS['titol_any']."&titol_pagines=".$HTTP_POST_VARS['titol_pagines']."&titol_ISBN=".$HTTP_POST_VARS['titol_ISBN']."&titol_sinopsis=".$HTTP_POST_VARS['titol_sinopsis']."\">aquí</a> per tornar enderrere";	
		
			include("peu2.txt");
			}
	else if((checklenght($HTTP_POST_VARS['titol_any'])!="false") && (isnumber($HTTP_POST_VARS['titol_any'])=="false") ){ 
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Si entreu l'any, heu d'entrar un numero.";
			echo"<P>Piqueu <A href=\"entrar_titol.php?validacio=".$validacio."&titol_nom=".$HTTP_POST_VARS['titol_nom']."&titol_any=".$HTTP_POST_VARS['titol_any']."&titol_pagines=".$HTTP_POST_VARS['titol_pagines']."&titol_ISBN=".$HTTP_POST_VARS['titol_ISBN']."&titol_sinopsis=".$HTTP_POST_VARS['titol_sinopsis']."\">aquí</a> per tornar enderrere";	
		
			include("peu2.txt");
			}		
	//else if(checkvalues($HTTP_POST_VARS['titol_sinopsis'])[0]=="false"){
	else if($titol_sinopsis_res[0]=="false"){ 
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Heu entrat caracter <B>".$titol_sinopsis_res[1][0]."</B> no valid a la <I>sinopsis</I>.";
			echo"<P>Piqueu <A href=\"entrar_titol.php?validacio=".$validacio."&titol_nom=".$HTTP_POST_VARS['titol_nom']."&titol_any=".$HTTP_POST_VARS['titol_any']."&titol_pagines=".$HTTP_POST_VARS['titol_pagines']."&titol_ISBN=".$HTTP_POST_VARS['titol_ISBN']."&titol_sinopsis=".$HTTP_POST_VARS['titol_sinopsis']."\">aquí</a> per tornar enderrere";	
		
			include("peu2.txt");		
	
			}
	else if(isnumber($categoria)=="false" || isnumber($medi)=="false"){ 
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Heu entrat el medi utilitzat i la categoria a la que escau.";
			echo"<P>Piqueu <A href=\"entrar_titol.php?validacio=".$validacio."&titol_nom=".$HTTP_POST_VARS['titol_nom']."&titol_any=".$HTTP_POST_VARS['titol_any']."&titol_pagines=".$HTTP_POST_VARS['titol_pagines']."&titol_ISBN=".$HTTP_POST_VARS['titol_ISBN']."&titol_sinopsis=".$HTTP_POST_VARS['titol_sinopsis']."\">aquí</a> per tornar enderrere";	
		
			include("peu2.txt");		
	
			}		
			
						
	else{	
			include("common_variables.php");						
			$query_string="INSERT INTO titols (titol_nom,titol_autor_ID,titol_editorial_ID,titol_procedencia_ID,titol_ISBN,titol_pagines,titol_categoria_ID,titol_medi_ID,titol_sinopsis,titol_idioma_ID,titol_any)"; 
			
			$query_string=$query_string." VALUES ('";
			
			$query_string=$query_string.$HTTP_POST_VARS['titol_nom'] . "','";
			$query_string=$query_string.$HTTP_POST_VARS['titol_autor_ID']."','";
			$query_string=$query_string. $HTTP_POST_VARS['titol_editorial_ID'] . "','";
			$query_string=$query_string.$HTTP_POST_VARS['titol_procedencia_ID'] . "','";
			$query_string=$query_string.$HTTP_POST_VARS['titol_ISBN'] . "','";
			$query_string=$query_string.$HTTP_POST_VARS['titol_pagines'] . "','";
			$query_string=$query_string.$HTTP_POST_VARS['categoria'] ."','"; //Hauria de ser titols_categoria_ID, pero degut al JavaScript, es millor utilitzar nomes categoria, ja que el programa utilitza aquesta etiqueta per informar a l'usuari
			$query_string=$query_string.$HTTP_POST_VARS['medi'] . "','";//Hauria de ser titol_medi_ID per la mateixa rao que abans
			$query_string=$query_string.$HTTP_POST_VARS['titol_sinopsis'] . "','";
			$query_string=$query_string.$HTTP_POST_VARS['titol_idioma_ID']."','";
			$query_string=$query_string.$HTTP_POST_VARS['titol_any']."')";	
						
			$resultats=mysql_query($query_string, $link_ID);
					
			$MYSQL_ERRNO=mysql_errno($link_ID);
			$MYSQL_ERROR=mysql_error($link_ID);
			
			// echo "<BR>query string ".$query_string;							
						if (!empty($MYSQL_ERROR)){		
					echo "<BR>query string ".$query_string;	
					echo "<BR>2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
					}
			else{
				header("Location: ./tots_titols_nom.php?validacio=".$validacio."&flag=2&medi_nom=".$HTTP_POST_VARS['medi_nom']."&pagina_actual=1"); /* Redirect browser */
					exit;
					}	
				
		} //end else (checklenght($HTTP_POST_VARS['editorial....		

?>			