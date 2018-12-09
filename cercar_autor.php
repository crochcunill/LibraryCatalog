<?php
	session_start();

//	$validacio=$HTTP_POST_VARS['validacio'];
//	$autor_nom=$HTTP_POST_VARS['autor_nom'];
//	$autor_cognoms=$HTTP_POST_VARS['autor_cognoms'];


	//******** FUNCIONS***********
	include("funcions_entrada.php");
	//****************************


	if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} //end if ($validacio!=session_id

	// Si no anem a la pagina d'error apareixera el que segueix:


		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");


	if (checkvalues($autor_nom)=="false" || checkvalues($autor_cognoms)=="false") {
		echo "<P>Hi han caracters no valids en la combinacio <I>nom/cognoms</I>. Intenteu de nou";				$PerformQuery=0;							}					
	else{					if ($autor_nom==""){
			if ($autor_cognoms==""){
				echo "<P>Heu d'entrar alguna cosa";
				$PerformQuery=0;
				}
			else{				$mevaquery="Select * from autors where autor_cognoms like '%".$autor_cognoms."%'";	
				$PerformQuery=1;
				}			}		else{
			if ($autor_cognoms==""){
				$mevaquery="Select * from autors where autor_nom like '%".$autor_nom."%'";				$PerformQuery=1;
				}										else{				$mevaquery="Select * from autors where autor_nom like '%".$autor_nom."%' or autor_cognoms like '%".$autor_cognoms."%'";				$PerformQuery=1;				}			
			}			
	}//end of else: if (checkvalues($autor_nom)
						
							
	if ($PerformQuery!=0){
	
	
		include("common_variables.php");	
		$my_query=$mevaquery;							
		$resultats=mysql_query($my_query, $link_ID);			
		$num_entrades=mysql_num_rows($resultats);
		$numero_pagines=ceil($num_entrades/$tamany_pagina);				
?>		
	<p>Hi han <B><?php echo $num_entrades?></B> autors/es a la base de dades que 
	 contenen <B>"<?php echo $autor_nom ?>"</B> en el nom i <B>"<?php echo $autor_cognoms ?>"</B> en el cognom . Els trobareu
	ordenats pel seu <B>nom</B> i distribuits en <B><?php echo $numero_pagines?></B> pàgines. La 
	pàgina actual és la <B><?php echo $pagina_actual ?> </B>. 

	
	<center class="normal">
	
	<P>Pàgina
	
<?php	
	for ($i=1;$i<=$numero_pagines;$i++){
			if ($i==1){
				if ($i==$pagina_actual){
					echo $i;}
				else{
					echo "<A HREF=./cercar_autor.php?validacio=".$validacio."&autor_nom=".$autor_nom."&autor_cognoms=".$autor_cognoms."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			else{
				if ($i==$pagina_actual){
					echo " | ".$i;}
				else{
					echo " | ". "<A HREF=./cercar_autor.php?validacio=".$validacio."&autor_nom=".$autor_nom."&autor_cognoms=".$autor_cognoms."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			}	
?>
	
	<table width="65%" border="1"> 
		<TR>
			<TD width=15%><B>Nom</B></td>
			<TD width=15%><B>Cognoms</B></td>
			<TD width=15%><B>Llengua</B></td>
			<TD colspan=2><B>Editar/Esborrar autors</b></td>
		</TR>
		
<?php
									include("common_variables.php");		$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
	$mevaquery=$mevaquery.$limit_query;					
	$resultats=mysql_query($mevaquery, $link_ID);
	$color_flag=1;	
	while ($els_resultats=mysql_fetch_row($resultats)){	
						
		if ($color_flag==1){				
			echo "<TR bgcolor=\"ffffaa\">";
			$color_flag=2;
			}
		else{	
			echo "<TR>";
			$color_flag=1;
			}
							
												
		echo "	<TD width=15%>". $els_resultats[1]. "</td>";
		echo "	<TD width=15%>". $els_resultats[2]. "</td>";
		echo "	<TD width=15%>". $els_resultats[3]. "</td>";
		echo "	<TD align=center>";
			echo "		<FORM action=\"editar_autor.php\" method=POST id=form1 name=form1>";
		echo "				<INPUT type=\"hidden\" value=\"".$validacio."\"  name=\"validacio\">";		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"autor_ID\">";		echo "				<INPUT type=\"submit\" value=\"Editar\" id=submit1 name=submit1>";
		echo "	</FORM>";					
					
		echo "</TD>";
						
		echo "<TD  align=center valign=center>";
		echo "	<FORM action=\"esborrar_autor.php\" method=POST id=form1 name=form1>";
						
		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[1]."\"  name=\"autor_nom\">";		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[2]."\"  name=\"autor_cognoms\">";											
		echo "				<INPUT type=\"hidden\" value=\"".$validacio."\"  name=\"validacio\">";		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"autor_ID\">";		echo "				<INPUT type=\"submit\" value=\"Esborrar\" id=submit1 name=submit1>";
		echo "	</FORM>";					
					
		echo "</TD>";

		echo "</TR>";
			
		} //end while	
		
		
	$MYSQL_ERRNO=mysql_errno($link_ID);
	$MYSQL_ERROR=mysql_error($link_ID);
				
	if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}
	
	echo "</TABLE>";
	echo "</center>";
	
		//echo "<P>$mevaquery";					
	} //end if ($PerformQuery!=0)	

			
include("peu2.txt");

?>