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
?>		
	<P>Aquesta es la pàgina on podeu registrar a la base de dades nous idiomas (llibre, casette, DVD, CD-ROM...):
	
	<FORM action="entrar_idioma2.php" method=POST id=form1 name=form1>		<P>Nom de l'idioma:		<BR><INPUT type="text" size=50 name="idioma_nom" >
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >

		<P>
		<INPUT type="submit" value="Entrar" id=submit1 name=submit1>
	</FORM>	


<?php
	include("peu2.txt");
?>