<?php
		session_start();

		$validacio=$HTTP_GET_VARS['validacio'];



if ($validacio!=session_id()){
		session_destroy();
//		header("Location: http://192.169.10.51/Error.php?error=1"); /* Redirect browser */
		header("Location: ./Error.php?error=1"); /* Redirect browser */

		exit;
		} 

else{

		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
?>		


	<p>En aquesta pàgina podeu gestionar les entrades dels diferents editorials que han 
	publicat el material (llibres, revistes, butlletins..) que tenim a la Biblioteca.
			
	<UL>
		<LI>Veure la llista d'editorials ordenada<A href="totes_editorials_nom.php?validacio=<?php echo $validacio ?>"> pel seu nom</A>
		<LI><A href="entrar_editorial.php?validacio=<?php echo $validacio ?>">Entrar una nova editorial</a>

	</UL>
	
	<P>Per esborrar o modificar les entrades d'un editorials, primer heu 
	de seleccionar un editorials utilitzant la opció de veure la llista
	d'editorialss, o utilitzant el cercador.
	
	<P>Podeu cercar nomes utilizant el nom de l'editorial o el nom d'una de les col.leccions
	publicades per l'editorial, o els dos.
	
	
	<FORM action="cercar_editorial.php" method=POST id=form1 name=form1>		<P>Nom Editorial:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <INPUT type="text" id=text1 name="editorial_nom">		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Col.lecció: <INPUT type="text" name="editorials_cognoms">
		<INPUT type="hidden" name="validacio" value="<?php echo $validacio ?>" >

		<P><INPUT type="submit" value="Entrar" id=submit1 name=submit1>
	</FORM>				
		
	

<?php

include("peu2.txt");

} //close the else

?>