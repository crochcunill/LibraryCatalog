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

//At least the procedencia description name must exists!
if (checklenght($HTTP_POST_VARS['procedencia_descripcio'])=="false" || checkvalues($HTTP_POST_VARS['procedencia_descripcio'])=="false") {
		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		echo "<P>Hi han caracters no valids en la <I>Descripció de la procedència</I>. Intenteu de nou";				include("peu2.txt");
		$PerformQuery=0;					
		}		
else{
		$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");						
		$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);		$query_string="UPDATE procedencies set  procedencia_descripcio='" . $HTTP_POST_VARS['procedencia_descripcio']. "' where procedencia_ID=".$HTTP_POST_VARS['procedencia_ID'];	
		$resultats=mysql_query($query_string, $link_ID);
		
		$MYSQL_ERRNO=mysql_errno($link_ID);
		$MYSQL_ERROR=mysql_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){				echo "<BR>query string ".$query_string;	
				echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
				}
		else{
				header("Location: ./totes_procedencies.php?validacio=".$validacio."&flag=3&procedencia_descripcio=".$HTTP_POST_VARS['procedencia_descripcio']); /* Redirect browser */
				exit;
				}
			
	} //end else (checklenght($HTTP_POST_VARS['procedencia....		

	
?>			