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
	include("funcions_mostrar.php");

	if ($HTTP_GET_VARS['flag']==1){echo "<P>L'idioma <B>".  changeslashbar($HTTP_GET_VARS['idioma_nom']). "</b> ha estat esborrat";}
	
	if ($HTTP_GET_VARS['flag']==2){echo "<P>L'idioma <B>".   changeslashbar($HTTP_GET_VARS['idioma_nom']). "</b> ha estat incorporat a la base de dades";}

	if ($HTTP_GET_VARS['flag']==3){echo "<P>El nom de l'idioma <B>".   changeslashbar($HTTP_GET_VARS['idioma_nom']). "</b> s'ha editat correctament";}
	
?>		

	<P>Aquesta llista s'utilitza per descriure l'idioma utilitzat a la copia del llibre que tenim i per l'idioma
	normalment utilitzat per l'autor/a.
	<p>La llista de les diferents idiomes que hi ha a la base de dades és el següent:
	
	<table  border="1"> 
			<TR>
				<TD><B>Idiomes</B></td>
			</TR>
		
<?php
	include("common_variables.php");
	
	$resultats=mysql_query("SELECT * from idiomes ORDER BY idioma_nom", $link_ID);
	
	while ($els_resultats=mysql_fetch_row($resultats)){
		echo "<TR>";
		echo "<TD><a href=\"editar_idioma.php?validacio=". $validacio ."&idioma_ID=". $els_resultats[0]. "\">". $els_resultats[1]."</a></td>";
		echo "</TR>";		
	}	
			
	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
		echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
	}
				
?>	
	
</TABLE>		
	
<P>Picant sobre l'idioma en questió, podeu accedir a una pàgina on podreu editar-lo o esborrar-lo.	

<?php
	include("peu2.txt");
?>