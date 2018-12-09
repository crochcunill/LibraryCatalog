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


		//Aquest es la capcalera dels fitxers en HTML
		include("capcalera2.txt");


	if ($HTTP_GET_VARS['flag']==1){echo "<P>El titol <B>".  $HTTP_GET_VARS['titol_nom']. "</b> de l'autor <B>". $HTTP_GET_VARS['autor_nom']." ". $HTTP_GET_VARS['autor_cognoms']."</B> ha estat esborrat";}
	
	if ($HTTP_GET_VARS['flag']==2){echo "<P>El titol <B>".  $HTTP_GET_VARS['titol_nom']. "</b> ha estat incorporat a la base de dades";}

	if ($HTTP_GET_VARS['flag']==3){echo "<P>Les dades del titol <B>".  $HTTP_GET_VARS['titol_nom']. "</b> s'han editat correctament";}
	
	include("common_variables.php");	
	$my_query="SELECT titol_ID,titol_nom,autor_nom,autor_cognoms,idioma_nom from titols,autors,idiomes where titol_autor_ID=autor_ID and titol_idioma_ID=idioma_ID ORDER BY titol_nom";
							
	$resultats=mysql_query($my_query, $link_ID);			
	$num_entrades=mysql_num_rows($resultats);
	$numero_pagines=ceil($num_entrades/$tamany_pagina);

?>	

	<p>Hi han <B><?php echo $num_entrades?></B> titols a la base de dades. Els trobareu
	ordenats pel seu <B>titol</B> i distribuits en <B><?php echo $numero_pagines?></B> pàgines. La 
	pàgina actual és la <B><?php echo $pagina_actual ?> </B>. 


	
	<center class="normal">	
	
	<P>Pàgina:	
<?php
		for ($i=1;$i<=$numero_pagines;$i++){
			if ($i==1){
				if ($i==$pagina_actual){
					echo $i;}
				else{
					echo "<A HREF=./tots_titols_nom.php?validacio=".$validacio."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			else{
				if ($i==$pagina_actual){
					echo " | ".$i;}
				else{
					echo " | ". "<A HREF=./tots_titols_nom.php?validacio=".$validacio."&pagina_actual=".$i.">".$i."</A>";
					}
				}
			}		

?>	
<table width="85%" border="1"> 
	<TR>
		<TD width=15%><B>Titol</B></td>
		<TD width=15%><B>Autor/a</B></td>
		<TD width=15%><B>Llengua</B></td>
		<TD colspan=2><B>Editar/Esborrar titols</b></td>
	</TR>
		
	<?php
		$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
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
		
						
			echo "<TD width=30%>". $els_resultats[1]. "</td>";
			echo "<TD width=15%>". $els_resultats[2]." ".$els_resultats[3]."</td>";
			echo "<TD width=15%>". $els_resultats[4]. "</td>";
			echo "<TD align=center>";
			echo "	<FORM action=\"editar_titol_bis.php\" method=POST id=form1 name=form1>";
			echo "		<INPUT type=\"hidden\" value=\"".$validacio."\"  name=\"validacio\">";			echo "		<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";			echo "		<INPUT type=\"hidden\" value=\"". $pagina_actual."\"  name=\"pagina_actual\">";		
			echo "		<INPUT type=\"submit\" value=\"Editar\" id=submit1 name=submit1>";
			echo "	</FORM>";					
					
			echo "</TD>";
						
			echo "<TD  align=center valign=center>";
			echo "	<FORM action=\"esborrar_titol.php\" method=POST id=form1 name=form1>";
			
			echo "		<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";		
			echo "		<INPUT type=\"hidden\" value=\"". $els_resultats[1]."\"  name=\"titol_nom\">";			echo "		<INPUT type=\"hidden\" value=\"". $els_resultats[2]."\"  name=\"autor_nom\">";
			echo "		<INPUT type=\"hidden\" value=\"". $els_resultats[3]."\"  name=\"autor_cognoms\">";			echo "		<INPUT type=\"hidden\" value=\"". $pagina_actual."\"  name=\"pagina_actual\">";												
			echo "		<INPUT type=\"hidden\" value=\"".$validacio."\"  name=\"validacio\">";			echo "		<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";			echo "		<INPUT type=\"submit\" value=\"Esborrar\" id=submit1 name=submit1>";
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
</center>

<?php
	include("peu2.txt");
?>