<?php

	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera.txt");

	
	include("common_variables.php");	
	$my_query="SELECT titol_ID,titol_nom,autor_nom,autor_cognoms,idioma_nom,autor_ID from titols,autors,idiomes where titol_autor_ID=autor_ID and titol_idioma_ID=idioma_ID and titol_medi_ID=4 ORDER BY titol_nom";
							
	$resultats=mysql_query($my_query, $link_ID);			
	$num_entrades=mysql_num_rows($resultats);
	$numero_pagines=ceil($num_entrades/$tamany_pagina);
    $pagina_actual=$_GET['pagina_actual'];	
?>	

	<p>Hi han <B><?php echo $num_entrades?></B> DVDs a la base de dades. Els trobareu
	ordenats pel seu <B>titol</B> i distribuits en <B><?php echo $numero_pagines?></B> p�gines. La 
	p�gina actual �s la <B><?php echo $pagina_actual ?> </B>. 


	
	<center class="normal">	
	
	<P>P�gina:	
<?php
		for ($i=1;$i<=$numero_pagines;$i++){
			if ($i==1){
				if ($i==$pagina_actual){
					echo $i;}
				else{
					echo "<A HREF=./tots_dvd.php?pagina_actual=".$i.">".$i."</A>";
					}
				}
			else{
				if ($i==$pagina_actual){
					echo " | ".$i;}
				else{
					echo " | ". "<A HREF=./tots_dvd.php?pagina_actual=".$i.">".$i."</A>";
					}
				}
			}		

?>	
<table width="85%" border="1"> 
	<TR class="normal_table">
		<TD width=30%><B>Titol</B></td>
		<TD width=25%><B>Autor/a</B></td>
		<TD width=10%><B>Llengua</B></td>
		<TD colspan=2><B>Detalls</b></td>

	</TR>
		
	<?php
		$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
		$my_query=$my_query.$limit_query;
		$resultats=mysql_query($my_query, $link_ID);
			
					
	
	$color_flag=1;	
	while ($els_resultats=mysql_fetch_row($resultats)){	
						
		if ($color_flag==1){				
			echo "<TR bgcolor=\"ffffaa\" class=\"normal\">";
			$color_flag=2;
			}
		else{	
			echo "<TR class=\"normal\">";
			$color_flag=1;
			}
							
		echo "	<TD>". $els_resultats[1]. "</td>";
		echo "	<TD>". $els_resultats[2]. " ".$els_resultats[3]."</td>";
		echo "	<TD>". $els_resultats[4]. "</td>";
		
		echo "	<TD align=center>";
			echo "		<FORM action=\"detalls_titol.php\" method=POST id=form1 name=form1>";
		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"titol_ID\">";
		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[2]."\"  name=\"autor_nom\">";		echo "				<INPUT type=\"hidden\" value=\"". $els_resultats[3]."\"  name=\"autor_cognoms\">";		
				echo "				<INPUT class=\"petit\" type=\"submit\" value=\"Del t�tol\" id=submit1 name=submit1>";
		echo "		</FORM>";					
					
		echo "	</TD>";
						
		echo "	<TD  align=center valign=center>";
		echo "		<FORM action=\"detalls_autor.php\" method=POST id=form1 name=form1>";
						
				echo "				<INPUT type=\"hidden\" value=1 name=\"pagina_actual\">";											
		echo "				<INPUT type=\"hidden\" value=\"".$els_resultats[5]."\"  name=\"autor_ID\">";		echo "				<INPUT class=\"petit\"  type=\"submit\" value=\"De l'autor\" id=submit1 name=submit1>";
		echo "		</FORM>";					
					
		echo "	</TD>";

		echo "</TR>";
			
		} //end while	
		
		
		$MYSQL_ERRNO=mysql_errno($link_ID);
		$MYSQL_ERROR=mysql_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){
			echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
		}
				
?>	
	
	</TABLE>		
</center>

<?php
	include("peu.txt");
?>