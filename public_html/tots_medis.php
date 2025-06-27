<?php
		session_start();

		$validacio=$_GET['validacio'];

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 


	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera2.txt");


	if ($_GET['flag']==1){echo "<P>El medi <B>".  $_GET['medi_nom']. "</b> ha estat esborrat";}
	
	if ($_GET['flag']==2){echo "<P>El medi <B>".  $_GET['medi_nom']. "</b> ha estat incorporat a la base de dades";}

	if ($_GET['flag']==3){echo "<P>El nom del medi <B>".  $_GET['medi_nom']. "</b> s'ha editat correctament";}
	
?>		

	<p>La llista de les diferents medis que hi ha a la base de dades és la següent:
	
	<table width="100%" border="1"> 
			<TR>
				<TD><B>Medis</B></td>
			</TR>
		
<?php

	include("common_variables.php");			
	$resultats=mysqli_query($link_ID,"SELECT * from medis ORDER BY medi_nom");

	while ($els_resultats=mysqli_fetch_row($resultats)){	
			echo "<TR>";
			echo "<TD><a href=\"editar_medi.php?validacio=". $validacio ."&medi_ID=". $els_resultats[0]. "\">". $els_resultats[1]."</a></td>";
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
?>