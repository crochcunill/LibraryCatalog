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
			
include("common_variables.php");	$query_string="SELECT * from idiomes WHERE idioma_ID=".$HTTP_GET_VARS['idioma_ID'];			
$resultats=mysql_query($query_string, $link_ID);
		
while ($els_resultats=mysql_fetch_row($resultats)){
	$idioma_nom=$els_resultats[1];
}	
		
$MYSQL_ERRNO=mysql_errno($link_ID);
$MYSQL_ERROR=mysql_error($link_ID);
				
if (!empty($MYSQL_ERROR)){
	echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
}		
?>		


	<p>En aquesta pàgina podeu editar o esborrar aquest idioma
	
	
	<P>Per editar el contingut, modifiqueu les entrades, i després premeu <I>Editar</I>	
	<FORM action="editar_idioma2.php" method=POST id=form1 name=form1>

		<P>Nom de l'idioma:		<INPUT type="text" name="idioma_nom" value="<?php echo  $idioma_nom?>" >
	
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="idioma_ID" value="<?php echo $HTTP_GET_VARS['idioma_ID']?>" >

		<P>
		<INPUT type="submit" value="Editar" id=submit1 name=submit1>
	</FORM>	



	<P>Per <B>esborrar</B> aquest idioma de la base de dades premeu el boto <i>Esborrar</I>
	<FORM action="esborrar_idioma.php" method=POST id=form1 name=form1>

		<INPUT type="hidden" name="idioma_nom" value="<?php echo   $idioma_nom?>" >
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="idioma_ID" value="<?php echo $HTTP_GET_VARS['idioma_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php
include("peu2.txt");
?>