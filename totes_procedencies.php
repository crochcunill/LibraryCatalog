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
		include("funcions_mostrar.php");
                                        include("common_variables.php");


	if ($HTTP_GET_VARS['flag']==1){echo "<P>La procedència de l'procedencia <B>".  changeslashbar($HTTP_GET_VARS['procedencia_descripcio']). "</b> ha estat esborrada";}
	
	if ($HTTP_GET_VARS['flag']==2){echo "<P>La procedència <B>".  changeslashbar($HTTP_GET_VARS['procedencia_descripcio']). "</b> ha estat incorporada a la base de dades";}

	if ($HTTP_GET_VARS['flag']==3){echo "<P>Les dades de la procedència <B>".  changeslashbar($HTTP_GET_VARS['procedencia_descripcio']). "</b> s'han editat correctament";}
	
?>		

	<p>La llista de les diferents procedències que hi ha a la base de dades és la següent:
	
	<table width="100%" border="1"> 
			<TR>
				<TD><B>Descripció de la procedència</B></td>
			</TR>
		
<?php

	//$link_ID=mysql_connect("localhost:/tmp/mysql.sock","roch","");
				
				//$database_ID=mysql_select_db("Casal_Biblioteca",$link_ID);			
				$resultats=mysql_query("SELECT * from procedencies ORDER BY procedencia_descripcio", $link_ID);
				while ($els_resultats=mysql_fetch_row($resultats)){
						
						echo "<TR>";
						echo "<TD><a href=\"editar_procedencia.php?validacio=". $validacio ."&procedencia_ID=". $els_resultats[0]. "\">". $els_resultats[1]."</a></td>";
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
