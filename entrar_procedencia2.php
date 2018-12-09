<?php
		session_start();

		$validacio=$HTTP_POST_VARS['validacio'];
                                         include("common_variables.php");

	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************


if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); // Redirect browser 
		exit;
		} 
		
if (checklenght($HTTP_POST_VARS['procedencia_descripcio'])=="false" || checkvalues($HTTP_POST_VARS['procedencia_descripcio'])=="false") {
		//Aquesta és la capçalera dels fitxers en HTML
		include("capcalera2.txt");
		echo "<P>Hi han caracters no valids a la <I>descripció</I>. Intenteu de nou";		
		include("peu2.txt");					
		}	
else{	
		//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");				
		//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
		$query_string="INSERT INTO procedencies (procedencia_descripcio) VALUES ('" . $HTTP_POST_VARS['procedencia_descripcio'] . "')";	
		$resultats=mysql_query($query_string, $link_ID);
				
		$MYSQL_ERRNO=mysql_errno($link_ID);
		$MYSQL_ERROR=mysql_error($link_ID);
						
		if (!empty($MYSQL_ERROR)){		
				echo "<BR>query string ".$query_string;	
				echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
				}
		else{
				header("Location: ./totes_procedencies.php?validacio=".$validacio."&flag=2&procedencia_descripcio=".$HTTP_POST_VARS['procedencia_descripcio']); // Redirect browser 
				exit;
				}	
			
	} //end else (checklenght($HTTP_POST_VARS['editorial....		

?>			
