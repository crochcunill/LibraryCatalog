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

	//At least the idioma description name must exists!
	if (checklenght($HTTP_POST_VARS['idioma_nom'])=="false" || checkvalues($HTTP_POST_VARS['idioma_nom'])=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracters no valids en la <I>nom</I> de l'idioma. Intenteu de nou";					include("peu2.txt");					
		}		
	else{
			include("common_variables.php");
						$query_string="UPDATE idiomes SET idioma_nom='" . $HTTP_POST_VARS['idioma_nom']. "' where idioma_ID=".$HTTP_POST_VARS['idioma_ID'];	
			$resultats=mysql_query($query_string, $link_ID);
			
			$MYSQL_ERRNO=mysql_errno($link_ID);
			$MYSQL_ERROR=mysql_error($link_ID);
					
			if (!empty($MYSQL_ERROR)){					echo "<BR>query string ".$query_string;	
					echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
				}
			else{
					header("Location: ./tots_idiomes.php?validacio=".$validacio."&flag=3&idioma_nom=".$HTTP_POST_VARS['idioma_nom']); /* Redirect browser */
					exit;
				}			
		} //end else (checklenght($HTTP_POST_VARS['idioma....		

	
?>			