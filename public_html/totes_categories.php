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


	if ($_GET['flag']==1){echo "<P>La categoria <B>". $_GET['categoria_nom']. "</b> ha estat esborrada";}
	
	if ($_GET['flag']==2){echo "<P>La categoria <B>". $_GET['categoria_nom']. "</b> ha estat incorporat a la base de dades";}

	if ($_GET['flag']==3){echo "<P>Les dades de la categoria <B>". $_GET['categoria_nom']. "</b> s'han editat correctament";}
	
?>		

	<p>La llista de categories que hi ha a la base de dades és la següent:
	
	<table width="100%" border="1"> 
		<TR>
			<TD width=15%><B>Nom</B></td>
			<TD width=15%><B>Medi</B></td>
			<TD><B>Descripciô</B></td>
		</TR>
		
<?php
		include("common_variables.php");			
	
	$resultats=mysqli_query($link_ID,"SELECT categoria_ID,categoria_nom, medi_nom, categoria_descripcio from categories,medis WHERE categoria_medi_ID=medi_ID ORDER BY medi_nom,categoria_nom ");
	
	while ($els_resultats=mysqli_fetch_row($resultats)){			
			echo "<TR>";
			echo "<TD width=15%><a href=\"editar_categories.php?validacio=". $validacio ."&categoria_ID=". $els_resultats[0]. "\">". $els_resultats[1]."</a></td>";
			echo "<TD width=15%><a href=\"editar_categories.php?validacio=". $validacio ."&categoria_ID=". $els_resultats[0]. "\">". $els_resultats[2]."</a></td>";
			echo "<TD class=\"petit\"><a href=\"editar_categories.php?validacio=". $validacio ."&categoria_ID=". $els_resultats[0]. "\">". $els_resultats[3]."</a></td>";
			echo "</TR>";		
		}	
		
		
	$mysqli_error=mysqli_error($link_ID);

		if (!empty($mysqli_error)){
			echo "===>  $mysqli_error  <BR>";
		}
				
?>	
	
	</TABLE>		
	

<?php
	include("peu2.txt");
?>