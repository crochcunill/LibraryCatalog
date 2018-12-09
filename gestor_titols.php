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


	<p>En aquesta pàgina podeu gestionar les entrades dels diferents títols que
	que tenim a la Biblioteca.
	
	<P>Per entrar un nou títol, ha d'existir un autor/a i l'editorial. Si aquests
	no existeixen, heu d'introduir-los abans d'entrar el títol. Encara que no canvien massa sovint,
	el mateix es pot aplicar al medi (llibre, revista, CD-ROM...), a la categoria (novel.la, poesia, assaig...)
	o a la procedència (compra, donació...).
		
	<UL>
		<LI>Veure la llista  de títols ordenada<A href="tots_titols_nom.php?validacio=<?php echo $validacio ?>&pagina_actual=1"> títols</A>
		<LI><A href="entrar_titol.php?validacio=<?php echo $validacio ?>">Entrar un nou títol</a>

	</UL>
	
	<P>Per esborrar o modificar les entrades d'un títol, primer heu 
	de seleccionar un títol utilitzant la opció de veure la llista
	d'títols, o utilitzant el cercador.
	
	<P>Podeu cercar nomes utilizant una sola paraula o tros de paraula que estigui inclosa en el titol, o bé
	utilitzant el nom o el cognom de l'autor/a. Per exemple si introduiu <b><i>bert</i></b> en el títol 
	trobareu <i>Cap al cel o<b>bert</B></I>
	
	<FORM action="cercar_titols.php" method=POST id=form1 name=form1>		<P>Títol:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT type="text" id=text1 name="titol_nom" size=65>
		
		<P>Nom:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT type="text" id=text1 name="autor_nom">		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Cognoms: <INPUT type="text" name="autor_cognoms">
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio ?>" >
		<INPUT type="hidden" name="pagina_actual" value="1" >
		<P><INPUT type="submit" value="Entrar" id=submit1 name=submit1>
	</FORM>				
		
	

<?php
	include("peu2.txt");
?>