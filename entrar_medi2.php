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
		
	if (checklenght($HTTP_POST_VARS['medi_nom'])=="false" || checkvalues($HTTP_POST_VARS['medi_nom'])=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracters no valids en el <I>nom del medi</I>. Intenteu de nou";
			include("peu2.txt");					
		}	
	else{	
			include("common_variables.php");			$query_string="INSERT INTO medis (medi_nom) VALUES ('" . $HTTP_POST_VARS['medi_nom'] . "')";	
			$resultats=mysql_query($query_string, $link_ID);
					
			$MYSQL_ERRNO=mysql_errno($link_ID);
			$MYSQL_ERROR=mysql_error($link_ID);
							
			if (!empty($MYSQL_ERROR)){		
					echo "<BR>query string ".$query_string;	
					echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
				}
			else{
					header("Location: ./tots_medis.php?validacio=".$validacio."&flag=2&medi_nom=".$HTTP_POST_VARS['medi_nom']); /* Redirect browser */
					exit;
				}	
				
		} //end else (checklenght($HTTP_POST_VARS['editorial....		

?>			