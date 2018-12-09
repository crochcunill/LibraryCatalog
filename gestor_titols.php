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


	<p>En aquesta p�gina podeu gestionar les entrades dels diferents t�tols que
	que tenim a la Biblioteca.
	
	<P>Per entrar un nou t�tol, ha d'existir un autor/a i l'editorial. Si aquests
	no existeixen, heu d'introduir-los abans d'entrar el t�tol. Encara que no canvien massa sovint,
	el mateix es pot aplicar al medi (llibre, revista, CD-ROM...), a la categoria (novel.la, poesia, assaig...)
	o a la proced�ncia (compra, donaci�...).
		
	<UL>
		<LI>Veure la llista  de t�tols ordenada<A href="tots_titols_nom.php?validacio=<?php echo $validacio ?>&pagina_actual=1"> t�tols</A>
		<LI><A href="entrar_titol.php?validacio=<?php echo $validacio ?>">Entrar un nou t�tol</a>

	</UL>
	
	<P>Per esborrar o modificar les entrades d'un t�tol, primer heu 
	de seleccionar un t�tol utilitzant la opci� de veure la llista
	d't�tols, o utilitzant el cercador.
	
	<P>Podeu cercar nomes utilizant una sola paraula o tros de paraula que estigui inclosa en el titol, o b�
	utilitzant el nom o el cognom de l'autor/a. Per exemple si introduiu <b><i>bert</i></b> en el t�tol 
	trobareu <i>Cap al cel o<b>bert</B></I>
	
	<FORM action="cercar_titols.php" method=POST id=form1 name=form1>		<P>T�tol:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT type="text" id=text1 name="titol_nom" size=65>
		
		<P>Nom:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT type="text" id=text1 name="autor_nom">		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Cognoms: <INPUT type="text" name="autor_cognoms">
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio ?>" >
		<INPUT type="hidden" name="pagina_actual" value="1" >
		<P><INPUT type="submit" value="Entrar" id=submit1 name=submit1>
	</FORM>				
		
	

<?php
	include("peu2.txt");
?>