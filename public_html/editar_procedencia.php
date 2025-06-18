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
		include("common_variables.php");
		
	
	$query_string="SELECT * from procedencies WHERE procedencia_ID=".$_GET['procedencia_ID'];			
	$resultats=mysqli_query($link_ID,$query_string,1);
		
	while ($els_resultats=mysqli_fetch_row($resultats)){
			$procedencia_descripcio=$els_resultats[1];
			}	
	$mysqli_error=mysqli_error($link_ID);
				
	if (!empty($mysqli_error)){
		echo "===> $mysqli_error<BR>";
		}		
?>		


	<p>En aquesta pàgina podeu editar o esborrar aquesta procedencia
	
	
	<P>Per editar el contingut, modifiqueu les entrades, i després premeu <I>Entrar</I>	
	<FORM action="editar_procedencia2.php" method=POST id=form1 name=form1>

		<P>Procedéncia:
		<BR><TEXTAREA rows=5 cols=50 id=textarea1 name="procedencia_descripcio" ><?php echo $procedencia_descripcio ?></TEXTAREA>
	
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="procedencia_ID" value="<?php echo $_GET['procedencia_ID']?>" >

		<P>
		<INPUT type="submit" value="Entrar" id=submit1 name=submit1>
	</FORM>	



	<P>Per <B>esborrar</B> aquest procedencias de la base de dades premeu el boto <i>Esborrar</I>
	<FORM action="esborrar_procedencia.php" method=POST id=form2 name=form2>

		<INPUT type="hidden" name="procedencia_descripcio" value="<?php echo  $procedencia_descripcio?>" >
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="procedencia_ID" value="<?php echo $_GET['procedencia_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php

include("peu2.txt");

} //close the else

?>
