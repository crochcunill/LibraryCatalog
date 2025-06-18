<?php
		session_start();

		$validacio=$_GET['validacio'];

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


	if ($_GET['flag']==1){echo "<P>La procedència de l'procedencia <B>".  changeslashbar($_GET['procedencia_descripcio']). "</b> ha estat esborrada";}
	
	if ($_GET['flag']==2){echo "<P>La procedència <B>".  changeslashbar($_GET['procedencia_descripcio']). "</b> ha estat incorporada a la base de dades";}

	if ($_GET['flag']==3){echo "<P>Les dades de la procedència <B>".  changeslashbar($_GET['procedencia_descripcio']). "</b> s'han editat correctament";}
	
?>		

	<p>La llista de les diferents procedències que hi ha a la base de dades és la següent:
	
	<table width="100%" border="1"> 
			<TR>
				<TD><B>Descripció de la procedència</B></td>
			</TR>
		
<?php

	include("common_variables.php");			
		
	$resultats=mysqli_query($link_ID,"SELECT * from procedencies ORDER BY procedencia_descripcio");

	while ($els_resultats=mysqli_fetch_row($resultats)){					
		echo "<TR>";
		echo "<TD><a href=\"editar_procedencia.php?validacio=". $validacio ."&procedencia_ID=". $els_resultats[0]. "\">". $els_resultats[1]."</a></td>";
		echo "</TR>";				
		}	
		
		$mysqli_error=mysqli_error($link_ID);
				
		if (!empty($mysqli_error)){
				echo "===> $mysqli_error<BR>";
				}
				
?>	
	
	</TABLE>		
	

<?php

include("peu2.txt");

} //close the else

?>
