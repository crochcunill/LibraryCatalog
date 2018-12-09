<?php
		session_start();

		$validacio=$HTTP_GET_VARS['validacio'];

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 


	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera2.txt");


	if ($HTTP_GET_VARS['flag']==1){echo "<P>El medi <B>".  $HTTP_GET_VARS['medi_nom']. "</b> ha estat esborrat";}
	
	if ($HTTP_GET_VARS['flag']==2){echo "<P>El medi <B>".  $HTTP_GET_VARS['medi_nom']. "</b> ha estat incorporat a la base de dades";}

	if ($HTTP_GET_VARS['flag']==3){echo "<P>El nom del medi <B>".  $HTTP_GET_VARS['medi_nom']. "</b> s'ha editat correctament";}
	
?>		

	<p>La llista de les diferents medis que hi ha a la base de dades és el següent:
	
	<table width="100%" border="1"> 
			<TR>
				<TD><B>Medis</B></td>
			</TR>
		
<?php

	include("common_variables.php");			
	$resultats=mysql_query("SELECT * from medis ORDER BY medi_nom", $link_ID);

	while ($els_resultats=mysql_fetch_row($resultats)){	
			echo "<TR>";
			echo "<TD><a href=\"editar_medi.php?validacio=". $validacio ."&medi_ID=". $els_resultats[0]. "\">". $els_resultats[1]."</a></td>";
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
?>