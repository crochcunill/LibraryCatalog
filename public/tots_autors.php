<?php

	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera.txt");
		
	include("common_variables.php");	
	$my_query="SELECT autor_ID,autor_nom,autor_cognoms,idioma_nom,autor_biografia from autors,idiomes where autor_idioma_ID=idioma_ID ORDER BY autor_nom";							
	$resultats=mysql_query($my_query, $link_ID);			
	$num_entrades=mysql_num_rows($resultats);
	$numero_pagines=ceil($num_entrades/$tamany_pagina);
    $pagina_actual=$_GET['pagina_actual'];	
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
					echo "<A HREF=./tots_autors.php?pagina_actual=".$i.">".$i."</A>";
					}
				}
			else{
				if ($i==$pagina_actual){
					echo " | ".$i;}
				else{
					echo " | ". "<A HREF=./tots_autors.php?pagina_actual=".$i.">".$i."</A>";
					}
				}
			}		

?>
	
	<table width="65%" border="1"> 
						<TR class="normal_table">
						<TD width=25%><B>Nom</B></td>
						<TD width=25%><B>Cognoms</B></td>
						<TD width=15%><B>Llengua</B></td>
						<TD colspan=2><B>Detalls</b></td>
						</TR>
		
<?php				$limit_query=" LIMIT ". ($pagina_actual-1) * $tamany_pagina . ", $tamany_pagina";
				$my_query=$my_query.$limit_query;
				$resultats=mysql_query($my_query, $link_ID);
								
				$color_flag=1;
				while ($els_resultats=mysql_fetch_row($resultats)){
						
						if ($color_flag==1){				
								echo "<TR class=\"normal\">";
								$color_flag=2;
							}
						else{	
								echo "<TR bgcolor=\"ffffaa\" class=\"normal\" >";
								$color_flag=1;
							}
						
						echo "<TD>". $els_resultats[1]. "</td>";
						echo "<TD>". $els_resultats[2]. "</td>";
						echo "<TD>". $els_resultats[3]. "</td>";
						
						echo "	<TD  align=center >";
						echo "		<FORM action=\"detalls_autor.php\" method=POST id=form1 name=form1>";						echo "			<INPUT type=\"hidden\" value=1 name=\"pagina_actual\">";										
						echo "			<INPUT type=\"hidden\" value=\"".$els_resultats[0]."\"  name=\"autor_ID\">";						echo "			<INPUT  class=\"petit\" type=\"submit\" value=\"De l'autor\" id=submit1 name=submit1>";
						echo "		</FORM>";					
					
						echo "	</TD>";				

			
						echo "</TR>";
						
				}//end while
		
		
				$MYSQL_ERRNO=mysql_errno($link_ID);
				$MYSQL_ERROR=mysql_error($link_ID);
				
				if (!empty($MYSQL_ERROR)){
							echo "2===> $MYSQL_ERRNO:    $MYSQL_ERROR  <BR>";
						}
				
?>	
	
	</TABLE>	

<?php
	include("peu.txt");
?>