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
	include("funcions_mostrar.php");			
?>		

	<p>Esteu segur que voleu esborrar el títol <B><?php echo $_POST['titol_nom']?></B>  de l'autor <B><?php echo $_POST['autor_nom']?>  <?php $_POST['autor_cognoms']?></B> de la llista de titols?	
	
	<FORM action="esborrar_titol2.php" method=POST id=form1 name=form1>
	
		<INPUT type="hidden" name="autor_nom" value="<?php echo  $_POST['autor_nom']?>" >
		<INPUT type="hidden" name="autor_cognoms" value="<?php echo $_POST['autor_cognoms']?>" >	
		
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
		<INPUT type="hidden" name="titol_ID" value="<?php echo $_POST['titol_ID']?>" >
		<INPUT type="hidden" name="titol_nom" value="<?php echo $_POST['titol_nom']?>" >

		<P>
		<INPUT type="submit" value="Esborrar" id=submit1 name=submit1>
	</FORM>	


<?php
	include("peu2.txt");
?>