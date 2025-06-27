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
			
include("common_variables.php");	$query_string="SELECT * from idiomes WHERE idioma_ID=".$_GET['idioma_ID'];			
$resultats=mysqli_query($link_ID,$query_string,1);
		
while ($els_resultats=mysqli_fetch_row($resultats)){
	$idioma_nom=$els_resultats[1];
}	
		
$mysqli_error=mysqli_error($link_ID);
				
if (!empty($mysqli_error)){
	echo "===> $mysqli_error<BR>";
}		
?>		


	<p>En aquesta pàgina podeu editar o esborrar aquest idioma
	
	
	<P>Per editar el contingut, modifiqueu les entrades, i després premeu <I>Editar</I>	
	<FORM action="editar_idioma2.php" method=POST id=form1 name=form1>

		<P>Nom de l'idioma:		<INPUT type="text" name="idioma_nom" value="<?php echo  $idioma_nom?>" >
	
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="idioma_ID" value="<?php echo $_GET['idioma_ID']?>" >

		<P>
		<INPUT type="submit" value="Editar" id=submit1 name=submit1>
	</FORM>	



	<P>Per <B>esborrar</B> aquest idioma de la base de dades premeu el boto <i>Esborrar</I>
	<FORM action="esborrar_idioma.php" method=POST id=form1 name=form1>

		<INPUT type="hidden" name="idioma_nom" value="<?php echo   $idioma_nom?>" >
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="idioma_ID" value="<?php echo $_GET['idioma_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php
include("peu2.txt");
?>