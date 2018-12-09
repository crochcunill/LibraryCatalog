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


	<p>En aquesta pàgina podeu gestionar les entrades d'autors/es a la base de
	dades de la Biblioteca del Casal Català de Vancouver.
	
	<UL>
		<LI>Veure la llista d'autors ordenat <A href="tots_autors_nom.php?validacio=<?php echo $validacio ?>&pagina_actual=1">nom</A> o 
		<A href="tots_autors_cognoms.php?validacio=<?php echo $validacio ?>&pagina_actual=1">cognom</A>
		<LI><A href="entrar_autor.php?validacio=<?php echo $validacio ?>">Entrar un nou autor</a>

	</UL>
	
	<P>Per esborrar o modificar les entrades d'un autor, primer heu 
	de seleccionar un autor utilitzant la opció de veure la llista
	d'autors, o utilitzant el cercador.
	
	<P>Podeu cercar nomes utilizant el nom, o el cognoms, o els dos.
	<P>Si teniu dos cognoms entreu nomes un dels dos.
	
	<FORM action="cercar_autor.php" method=POST id=form1 name=form1>		<P>Nom:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT type="text" id=text1 name="autor_nom">		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Cognoms: <INPUT type="text" name="autor_cognoms">
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio ?>" >
		<INPUT type="hidden" name="pagina_actual" value="1" >


		<P><INPUT type="submit" value="Entrar" id=submit1 name=submit1>
	</FORM>				
		

<?php
	include("peu2.txt");
?>