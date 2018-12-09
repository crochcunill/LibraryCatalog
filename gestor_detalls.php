<?php
		session_start();

		$validacio=$HTTP_GET_VARS['validacio'];

//echo "la session es ". session_start();
//echo "la validacio es ". $validacio;

if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

else{


		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");
?>		


	<p>En aquesta pàgina podeu gestionar les diferents categories, procedències i medis que utilitzem per
	classificar el material (llibres, revistes...) o idiomes del material que tenim a la Biblioteca.
			
	<UL>
		<LI>Veure la llista de les <A href="totes_categories.php?validacio=<?php echo $validacio ?>"> categories </A>existents.
		<LI><A href="entrar_categoria.php?validacio=<?php echo $validacio ?>">Entrar una nova categoria</a>

	</UL>
			
	<UL>
		<LI>Veure la llista de les <A href="totes_procedencies.php?validacio=<?php echo $validacio ?>"> procedències </A>existents.
		<LI><A href="entrar_procedencia.php?validacio=<?php echo $validacio ?>">Entrar una nova procedències</a>

	</UL>
	
	<UL>
		<LI>Veure la llista dels diferents les <A href="tots_medis.php?validacio=<?php echo $validacio ?>"> medis </A>existents.
		<LI><A href="entrar_medi.php?validacio=<?php echo $validacio ?>">Entrar una nou medi</a>

	</UL>	
	
	<UL>
		<LI>Veure la llista dels diferents  <A href="tots_idiomes.php?validacio=<?php echo $validacio ?>"> idiomes </A> utilitzats pels autors i en el que els llibres estan escrits.
		<LI><A href="entrar_idioma.php?validacio=<?php echo $validacio ?>">Entrar un nou idioma</a>

	</UL>

<P>Per editar/esborrar una categoria, procedència, medi o idioma, primer heu de seleccionar-lo. Per fer-ho heu
de llistar els elements de la categoria, procedència, media o idioma.

<?php

include("peu2.txt");

} //close the else

?>