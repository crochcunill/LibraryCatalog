<?php
	session_start();

	$validacio=$HTTP_POST_VARS['validacio'];
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
	if (checklenght($HTTP_POST_VARS['editorial_nom'])=="false" || checkvalues($HTTP_POST_VARS['editorial_nom'])=="false" || checkvalues($HTTP_POST_VARS['editorial_colleccio'])=="false" || checkvalues($HTTP_POST_VARS['editorial_adreca'])=="false" || checkvalues($HTTP_POST_VARS['editorial_extra'])=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracters no valids en la combinacio <I>Nom de l'editorial/Col.lecció/Adreça/Altre Informació</I>. Intenteu de nou";		
			include("peu2.txt");
			$PerformQuery=0;					
			}		
	else{
			//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");						
			//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
			$query_string="UPDATE editorials set  editorial_nom='" . $HTTP_POST_VARS['editorial_nom']. "',editorial_colleccio='" . $HTTP_POST_VARS['editorial_colleccio'] . "',editorial_adreca='".$HTTP_POST_VARS['editorial_adreca']."',editorial_extra='" .$HTTP_POST_VARS['editorial_extra']. "' where editorial_ID=".$HTTP_POST_VARS['editorial_ID'];	
			$resultats=mysql_query($query_string, $link_ID);
			
			$MYSQL_ERRNO=mysql_errno($link_ID);
			$MYSQL_ERROR=mysql_error($link_ID);
					
			if (!empty($MYSQL_ERROR)){
					echo "<BR>query string ".$query_string;	
					echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
					}
			else{
					header("Location: ./totes_editorials_nom.php?validacio=".$validacio."&flag=3&editorial_nom=".$HTTP_POST_VARS['editorial_nom']. "&editorial_colleccio=" . $HTTP_POST_VARS['editorial_colleccio']); /* Redirect browser */
					exit;
					}
				
		} //end else (checklenght($HTTP_POST_VARS['editorial....		

	
?>			
