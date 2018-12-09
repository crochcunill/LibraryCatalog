<?php
	session_start();

	$validacio=$HTTP_POST_VARS['validacio'];

	if ($validacio!=session_id()){
			session_destroy();
			header("Location: ./Error.php?error=1"); /* Redirect browser */

			exit;
			} 


	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera2.txt");
	include("funcions_mostrar.php");
		
?>		


	<p>Esteu segur que voleu esborrar l'idioma
	<B><?php echo changeslashbar($HTTP_POST_VARS['idioma_nom'])?></B> 
	de la llista d'idiomes?
	
	
	<FORM action="esborrar_idioma2.php" method=POST id=form1 name=form1>
	
		<INPUT type="hidden" name="idioma_nom" value="<?php echo  $HTTP_POST_VARS['idioma_nom']?>" >
		
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="idioma_ID" value="<?php echo $HTTP_POST_VARS['idioma_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php
	include("peu2.txt");
?>