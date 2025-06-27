<?php
	session_start();
	$validacio=$_POST['validacio'];

	if ($validacio!=session_id()){
			session_destroy();
			header("Location: ./Error.php?error=1"); /* Redirect browser */

			exit;
			} 



		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
		
?>		


	<p>Esteu segur que voleu esborrar <B><?php echo $_POST['autor_nom']?> <?php echo $_POST['autor_cognoms']?></B> de la llista d'autors?
	
	
	<FORM action="esborrar_autor2.php" method=POST id=form1 name=form1>
	
		<INPUT type="hidden" name="autor_nom" value="<?php echo  $_POST['autor_nom']?>" >
		<INPUT type="hidden" name="autor_cognoms" value="<?php echo $_POST['autor_cognoms']?>" >	
		
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="autor_ID" value="<?php echo $_POST['autor_ID']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php
	include("peu2.txt");
?>