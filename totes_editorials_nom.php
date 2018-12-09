<?php
		session_start();

		$validacio=$HTTP_GET_VARS['validacio'];

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

else{
		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
                                include("common_variables.php");


	if ($HTTP_GET_VARS['flag']==1){echo "<P>La col.lecció <B>". $HTTP_GET_VARS['editorial_colleccio']." </B> de l'editorial <B>".  $HTTP_GET_VARS['editorial_nom']. "</b> ha estat esborrada";}
	
	if ($HTTP_GET_VARS['flag']==2){echo "<P>La col.lecció <B>". $HTTP_GET_VARS['editorial_colleccio']." </B> de l'editorial <B>".  $HTTP_GET_VARS['editorial_nom']. "</b> ha estat incorporat a la base de dades";}

	if ($HTTP_GET_VARS['flag']==3){echo "<P>Les dades de l'editorials/a <B>".  $HTTP_GET_VARS['editorial_nom']." ". $HTTP_GET_VARS['editorial_colleccio']. "</b> s'han editat correctament";}
	
?>		

	<p>La llista d'editorials que hi ha a la base de dades és la següent:
	
	<table width="100%" border="1"> 
						<TR>
						<TD width=15%><B>Nom</B></td>
						<TD width=15%><B>Col.lecció</B></td>
						<TD width=15%><B>Adreça</B></td>
						<TD><B>Altre informació</B></td>
						</TR>
		
<?php

	//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");
				
	//			$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);
				
				$resultats=mysql_query("SELECT * from editorials ORDER BY editorial_nom", $link_ID);
		
				while ($els_resultats=mysql_fetch_row($resultats)){
						
						echo "<TR>";
						echo "<TD width=15%><a href=\"editar_editorials.php?validacio=". $validacio ."&editorial_ID=". $els_resultats[0]. "\">". $els_resultats[1]."</a></td>";
						echo "<TD width=15%><a href=\"editar_editorials.php?validacio=". $validacio ."&editorial_ID=". $els_resultats[0]. "\">". $els_resultats[2]."</a></td>";
						echo "<TD width=15%><a href=\"editar_editorials.php?validacio=". $validacio ."&editorial_ID=". $els_resultats[0]. "\">". $els_resultats[3]."</a></td>";
						echo "<TD><a href=\"editar_editorials.php?validacio=". $validacio ."&editorial_ID=". $els_resultats[0]. "\">". $els_resultats[4]."</a></td>";
						echo "</TR>";
						
						}	
		
		
				$MYSQL_ERRNO=mysql_errno($link_ID);
				$MYSQL_ERROR=mysql_error($link_ID);
				
				if (!empty($MYSQL_ERROR)){
							echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
						}
				
?>	
	
	</TABLE>		
	

<?php

include("peu2.txt");

} //close the else

?>
