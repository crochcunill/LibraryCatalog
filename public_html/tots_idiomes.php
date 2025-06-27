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
	include("funcions_mostrar.php");

	if ($_GET['flag']==1){echo "<P>L'idioma <B>".  changeslashbar($_GET['idioma_nom']). "</b> ha estat esborrat";}
	
	if ($_GET['flag']==2){echo "<P>L'idioma <B>".   changeslashbar($_GET['idioma_nom']). "</b> ha estat incorporat a la base de dades";}

	if ($_GET['flag']==3){echo "<P>El nom de l'idioma <B>".   changeslashbar($_GET['idioma_nom']). "</b> s'ha editat correctament";}
	
?>		

	<P>Aquesta llista s'utilitza per descriure l'idioma utilitzat a la copia del llibre que tenim i per l'idioma
	normalment utilitzat per l'autor/a.
	<p>La llista de les diferents idiomes que hi ha a la base de dades és la següent:
	
	<table  border="1"> 
			<TR>
				<TD><B>Idiomes</B></td>
			</TR>
		
<?php
	include("common_variables.php");
	
	$resultats=mysqli_query($link_ID,"SELECT * from idiomes ORDER BY idioma_nom");
		
	while ($els_resultats=mysqli_fetch_row($resultats)){
		echo "<TR>";
		echo "<TD><a href=\"editar_idioma.php?validacio=". $validacio ."&idioma_ID=". $els_resultats[0]. "\">". $els_resultats[1]."</a></td>";
		echo "</TR>";		
	}	
			
	$mysqli_error=mysqli_error($link_ID);
				
	if (!empty($mysqli_error)){
	}
				
?>	
	
</TABLE>		
	
<P>Picant sobre l'idioma podeu accedir a una pàgina on podreu editar-lo o esborrar-lo.	

<?php
	include("peu2.txt");
?>