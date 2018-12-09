<?php
	session_start();

//	//$validacio=$HTTP_POST_VARS['validacio'];
//	//$autor_nom=$HTTP_POST_VARS['autor_nom'];
//	//$autor_cognoms=$HTTP_POST_VARS['autor_cognoms'];


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


	if (checkvalues($autor_nom)=="false" || checkvalues($autor_cognoms)=="false" || checkvalues($titol_nom)=="false") {
		echo "<P>Hi han caracters no valids en la combinacio <I>nom/cognoms</I>. Intenteu de nou";				$PerformQuery=0;							}
	elseif (checklenght($autor_nom)=="false" && checklenght($autor_cognoms)=="false" && checklenght($titol_nom)=="false") {		echo "<P>Heu d'entrar alguna cosa en el titol, o en el nom de l'autor o en el cognom de l'autor. Intenteu de nou";				$PerformQuery=0;							}
//***********************************		else{
		$begin_query="Select titol_ID,titol_nom,autor_nom,autor_cognoms from titols,autors where";
		$end_query=" AND titol_autor_ID=autor_ID";					
		$PerformQuery=1;//Sabem que hi ha d'haver algun caracter en algun lloc!
				if ($autor_nom==""){			echo "mevaquery= ".$PerformQuery;
			if ($autor_cognoms==""){				$mevaquery=$begin_query." titol_nom like '%".trim($titol_nom)."%'". $end_query;			
							}
			else{
				$mevaquery=$begin_query." titol_nom like '%".trim($titol_nom)."%' AND autor_cognom like '%".trim($autor_cognom)."%'". $end_query;	
				}							}			else{
			if ($autor_cognoms==""){				if ($titol_nom=""){					$mevaquery=$begin_query." autor_nom like '%".trim($autor_nom)."%'".$end_query;					}				else{	
					$mevaquery=$begin_query." autor_nom like '%".trim($autor_nom)."%' AND titol_nom like '%".trim($titol_nom)."%' ".$end_query;
					}
				}											else{				if ($titol_nom=""){					$mevaquery=$begin_query." autor_nom like '%".trim($autor_nom)."%' AND autor_cognom like '%".trim($autor_cognom)."%' ".$end_query;					}				else{	
					$mevaquery=$begin_query." autor_nom like '%".trim($autor_nom)."%' AND titol_nom like '%".trim($titol_nom)."%' AND autor_cognom like '%".trim($autor_cognom)."%'".$end_query;
					}				}			
			}			
		}//end of else: if (checkvalues($autor_nom)
					//echo "<B>".$mevaquery."</B>";	//***********************************									
							
	if ($PerformQuery!=0){
	
	
		include("common_variables.php");	
		$my_query=$mevaquery;							
		$resultats=mysql_query($my_query, $link_ID);			
		$num_entrades=mysql_num_rows($resultats);
		$numero_pagines=ceil($num_entrades/$tamany_pagina);				
?>		
	<p>Hi han <B><?php echo $num_entrades?></B> autors/es a la base de dades que 
	 contenen <B>"<?php echo $titol_nom ?>"</B> en el títol, <B>"<?php echo $autor_nom ?>"</B> en el nom i <B>"<?php echo $autor_cognoms ?>"</B> en el cognom . Els trobareu
	ordenats pel seu <B>titol</B> i distribuits en <B><?php echo $numero_pagines?></B> pàgines. La 
	pàgina actual és la <B><?php echo $pagina_actual ?> </B>. 

	
	<center class="normal">
	
	
<P>Pàgina	
<?php	

	for ($i=1;$i<=$numero_pagines;$i++){
		if ($i==1){
			if ($i==$pagina_actual){
				echo $i;}
			else{
				echo "<A HREF=./cercar_titol.php?validacio=".$validacio."&titol_nom=".$titol_nom."&autor_nom=".$autor_nom."&autor_cognoms=".$autor_cognoms."&pagina_actual=".$i.">".$i."</A>";
				}
			}
		else{
			if ($i==$pagina_actual){
				echo " | ".$i;}
			else{
				echo " | ". "<A HREF=./cercar_autor.php?validacio=".$validacio."&titol_nom=".$titol_nom."&autor_nom=".$autor_nom."&autor_cognoms=".$autor_cognoms."&pagina_actual=".$i.">".$i."</A>";
				}
			}
		}	

	include("common_variables.php");		$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
	$mevaquery=$mevaquery.$limit_query;	//	echo "<P>Meva Query ".$mevaquery;

?>
	
	<table width="65%" border="1"> 
		<TR>
			<TD width=15%><B>Titol</B></td>
			<TD width=15%><B>Autor</B></td>

			<TD colspan=2><B>Editar/Esborrar autors</b></td>
		</TR>
		
<?php
											
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
		echo "	<TD width=15%>". $els_resultats[2]. " ".$els_resultats[3]."</td>";
	
		echo "	<TD align=center>";
			echo "		<FORM action=\"editar_titol.php\" method=POST id=form1 name=form1>";
		echo "				<INPUT type=\"hidden\" value=\"".$validacio."\"  name=\"validacio\">";		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";		echo "				<INPUT type=\"submit\" value=\"Editar\" id=submit1 name=submit1>";
		echo "	</FORM>";					
					
		echo "</TD>";
						
		echo "<TD  align=center valign=center>";
		echo "	<FORM action=\"esborrar_titol.php\" method=POST id=form1 name=form1>";
						
		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[1]."\"  name=\"autor_nom\">";		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[2]."\"  name=\"autor_cognoms\">";											
		echo "				<INPUT type=\"hidden\" value=\"".$validacio."\"  name=\"validacio\">";		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";		echo "				<INPUT type=\"submit\" value=\"Esborrar\" id=submit1 name=submit1>";
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