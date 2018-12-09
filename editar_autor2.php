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

	$autor_nom_res=checkvalues($HTTP_POST_VARS['autor_nom']);
	$autor_cognoms_res=checkvalues($HTTP_POST_VARS['autor_cognoms']);
	$autor_biografia_res=checkvalues($HTTP_POST_VARS['autor_biografia']);
	

	if (checklenght($HTTP_POST_VARS['autor_nom'])=="false" || $autor_nom_res[0]=="false" ||$autor_cognoms_res[0]=="false" || $autor_biografia_res[0]=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi ha el caracter <B>".$autor_nom_res[1][0].$autor_cognoms_res[1][0].$autor_biografia_res[1][0]."</B> no valid en la combinacio <I>nom/cognoms/llengua/biografia</I>. Intenteu de nou";					include("peu2.txt");
			$PerformQuery=0;					
			}	
	else{		
			include("common_variables.php");
			
			$query_string="UPDATE autors set  autor_nom='" . $HTTP_POST_VARS['autor_nom']. "',autor_cognoms='" . $HTTP_POST_VARS['autor_cognoms'] . "',autor_idioma_ID='".$HTTP_POST_VARS['autor_idioma_ID']."',autor_biografia='" .$HTTP_POST_VARS['autor_biografia']. "' where autor_ID='".$HTTP_POST_VARS['autor_ID']."'";	
			$resultats=mysql_query($query_string, $link_ID);
			
			$MYSQL_ERRNO=mysql_errno($link_ID);
			$MYSQL_ERROR=mysql_error($link_ID);
							
			if (!empty($MYSQL_ERROR)){
					echo "<BR>query string ".$query_string;	
					echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
					}
			else{
					header("Location: ./tots_autors_nom.php?validacio=".$validacio."&flag=3&autor_nom=".$HTTP_POST_VARS['autor_nom']. "&autor_cognoms=" . $HTTP_POST_VARS['autor_cognoms']."&pagina_actual=".$HTTP_POST_VARS['pagina_actual']); /* Redirect browser */
					exit;
					}				
			} //end else (checklenght($HTTP_POST_VARS['editorial....		

		
?>			