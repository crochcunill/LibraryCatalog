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
	include("funcions_mostrar.php");

	if ($HTTP_GET_VARS['flag']==1){echo "<P>L'autor/a <B>".  changeslashbar($HTTP_GET_VARS['autor_nom'])." ". changeslashbar($HTTP_GET_VARS['autor_cognoms']). "</b> ha estat esborrat";}
	if ($HTTP_GET_VARS['flag']==2){echo "<P>L'autor/a <B>".  changeslashbar($HTTP_GET_VARS['autor_nom'])." ". changeslashbar($HTTP_GET_VARS['autor_cognoms']). "</b> ha estat incorporat a la base de dades";}
	if ($HTTP_GET_VARS['flag']==3){echo "<P>Les dades de l'autor/a <B>".  changeslashbar($HTTP_GET_VARS['autor_nom'])." ". changeslashbar($HTTP_GET_VARS['autor_cognoms']). "</b> s'han editat correctament";}		if ($HTTP_GET_VARS['flag']==4){
		echo "<P>L'autor/a <B>".  $HTTP_GET_VARS['autor_nom']." ". $HTTP_GET_VARS['autor_cognoms']. "</b> ";
		echo "té titols associats. Heu d'esborrar els titols a la base de dades abans de poder esborrar aquest autor/a";
		}					
	include("common_variables.php");	
	$my_query="SELECT autor_ID,autor_nom,autor_cognoms,idioma_nom,autor_biografia from autors,idiomes where autor_idioma_ID=idioma_ID ORDER BY autor_nom";							
	$resultats=mysql_query($my_query, $link_ID);			
	$num_entrades=mysql_num_rows($resultats);
	$numero_pagines=ceil($num_entrades/$tamany_pagina);
	$pagina_actual=$_GET['pagina_actual'];
	
	if ($pagina_actual=="") {$pagina_actual=1;}
	
	

?>		

	<p>Hi han <B><?php echo $num_entrades?></B> autors/es a la base de dades. Els trobareu
	ordenats pel seu <B>nom</B> i distribuits en <B><?php echo $numero_pagines?></B> pàgines. La 
	pàgina actual és la <B><?php echo $pagina_actual ?> </B>. 


	
	<center class="normal">	
	
	<P>Pàgina:	
<?php
		for ($i=1;$i<=$numero_pagines;$i++){
			if ($i==1){
				if ($i==$pagina_actual){
					echo $i;}
				else{
					echo "<A HREF=./tots_autors_nom.php?validacio=".$validacio."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			else{
				if ($i==$pagina_actual){
					echo " | ".$i;}
				else{
					echo " | ". "<A HREF=./tots_autors_nom.php?validacio=".$validacio."&pagina_actual=".$i.">".$i."</A>";
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
		
<?php				$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
				$my_query=$my_query.$limit_query;
				$resultats=mysql_query($my_query, $link_ID);
								
				$color_flag=1;
				while ($els_resultats=mysql_fetch_row($resultats)){
						
						if ($color_flag==1){				
								echo "<TR>";
								$color_flag=2;
							}
						else{	
								echo "<TR bgcolor=\"ffffaa\">";
								$color_flag=1;
							}
						
						echo "<TD width=15%>". $els_resultats[1]. "</td>";
						echo "<TD width=15%>". $els_resultats[2]. "</td>";
						echo "<TD width=15%>". $els_resultats[3]. "</td>";
						echo "<TD align=center>";
						echo "	<FORM action=\"editar_autor.php\" method=POST id=form1 name=form1>";
						echo "		<INPUT type=\"hidden\" value=\"".$validacio."\"  name=\"validacio\">";						echo "		<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"autor_ID\">";						echo "		<INPUT type=\"hidden\" value=\"". $pagina_actual."\"  name=\"pagina_actual\">";		
						echo "		<INPUT type=\"submit\" value=\"Editar\" id=submit1 name=submit1>";
						echo "	</FORM>";					
					
						echo "</TD>";
						
						echo "<TD  align=center valign=center>";
						echo "	<FORM action=\"esborrar_autor.php\" method=POST id=form1 name=form1>";
						
						echo "		<INPUT type=\"hidden\" value=\"". $els_resultats[1]."\"  name=\"autor_nom\">";						echo "		<INPUT type=\"hidden\" value=\"". $els_resultats[2]."\"  name=\"autor_cognoms\">";						
						echo "		<INPUT type=\"hidden\" value=\"". $pagina_actual."\"  name=\"pagina_actual\">";
						echo "		<INPUT type=\"hidden\" value=\"".$validacio."\"  name=\"validacio\">";						echo "		<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"autor_ID\">";						echo "		<INPUT type=\"submit\" value=\"Esborrar\" id=submit1 name=submit1>";
						echo "	</FORM>";					
					
						echo "</TD>";
		
			
						echo "</TR>";
						
				}//end while
		
		
				$MYSQL_ERRNO=mysql_errno($link_ID);
				$MYSQL_ERROR=mysql_error($link_ID);
				
				if (!empty($MYSQL_ERROR)){
							echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
						}
				
?>	
	
	</TABLE>	
	
	<P>Per esborrar un autor/a, primer heu d'esborrar tots els titols associats a l'autor/a.	
</center>

<?php


include("peu2.txt");

?>