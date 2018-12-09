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
			
	//At least the editorial name must exists!
	if (checklenght($HTTP_POST_VARS['editorial_nom'])=="false" || checkvalues($HTTP_POST_VARS['editorial_nom'])=="false" || checkvalues($HTTP_POST_VARS['editorial_colleccio'])=="false" || checkvalues($HTTP_POST_VARS['editorial_adreca'])=="false" || checkvalues($HTTP_POST_VARS['editorial_extra'])=="false") {
		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		echo "<P>Hi han caracters no valids en la combinacio <I>Nom de l'editorial/Col.lecció/Adreça/Altre Informació</I>. Intenteu de nou";				include("peu2.txt");					
		}	
	else{
		include("common_variables.php");			
		$query_string="INSERT INTO editorials (editorial_nom,editorial_colleccio,editorial_adreca,editorial_extra) VALUES ('" . $HTTP_POST_VARS['editorial_nom']. "','" . $HTTP_POST_VARS['editorial_colleccio'] . "','" .$HTTP_POST_VARS['editorial_adreca']. "','" .$HTTP_POST_VARS['editorial_extra']. "')";	
		$resultats=mysql_query($query_string, $link_ID);
									
		$MYSQL_ERRNO=mysql_errno($link_ID);
		$MYSQL_ERROR=mysql_error($link_ID);
							
		if (!empty($MYSQL_ERROR)){	
			echo "<BR>query string ".$query_string;	
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
			}
		else{
			header("Location: ./totes_editorials_nom.php?validacio=".$validacio."&flag=2&editorials_nom=".$HTTP_POST_VARS['editorials_nom']. "&editorials_cognoms=" . $HTTP_POST_VARS['editorials_cognoms']); /* Redirect browser */
			exit;
			}		
				
		} //end else (checklenght($HTTP_POST_VARS['editorial....		

?>			