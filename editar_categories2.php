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


	//At least the categoria name must exists!
	if (checklenght($HTTP_POST_VARS['categoria_nom'])=="false" || checkvalues($HTTP_POST_VARS['categoria_nom'])=="false" || checkvalues($HTTP_POST_VARS['categoria_descripcio'])=="false") {
			//Aquest es la capcalera dels fitxers en HTML
			include("capcalera2.txt");
			echo "<P>Hi han caracters no valids en la combinacio <I>Nom de la categoria/Descripció</I>. Intenteu de nou";		
			include("peu2.txt");
			$PerformQuery=0;					
			}		
	else{
			//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");						
			//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
			$query_string="UPDATE categories set  categoria_nom='" . $HTTP_POST_VARS['categoria_nom']. "',categoria_descripcio='" . $HTTP_POST_VARS['categoria_descripcio']. "',categoria_medi_ID='" . $HTTP_POST_VARS['categoria_medi_ID']."' where categoria_ID='".$HTTP_POST_VARS['categoria_ID']."'";	

			$resultats=mysql_query($query_string, $link_ID);
			
			$MYSQL_ERRNO=mysql_errno($link_ID);
			$MYSQL_ERROR=mysql_error($link_ID);
					
			if (!empty($MYSQL_ERROR)){
					echo "<BR>query string ".$query_string;	
					echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
					}
			else{
					header("Location: ./totes_categories.php?validacio=".$validacio."&flag=3&categoria_nom=".$HTTP_POST_VARS['categoria_nom']. "&categoria_descripcio=" . $HTTP_POST_VARS['categoria_descripcio']); /* Redirect browser */
					exit;
					}
				
			} //end else (checklenght($HTTP_POST_VARS['categoria....		


?>			

