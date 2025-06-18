<?php
	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera.txt");
		
	include("common_variables.php");
	
if (empty($_POST['titol_ID'])){
				$autor_ID=$_GET['titol_ID'];
				}
	 else {
				$autor_ID=$_POST['titol_ID'];
				}

	if (empty($_POST['pagina_actual'])){
				$pagina_actual=$_GET['autor_ID'];
				}
	 else {
				    $pagina_actual=$_POST['pagina_actual'];
				}

				

    $pagina_actual=$_POST['pagina_actual'];	

	$query_string="SELECT * FROM titols,autors,idiomes WHERE titol_id=".$_POST['titol_ID'];


	$resultats=mysqli_query($link_ID,$query_string);
		
		while ($els_resultats=mysqli_fetch_row($resultats)){
		

				$titol_nom=$els_resultats[1];
				$titol_autor_ID=$els_resultats[2];
				$titol_editorial_ID=$els_resultats[3];
				$titol_idioma_ID=$els_resultats[4];
				$titol_procedencia_ID=$els_resultats[5];
				$titol_ISBN=$els_resultats[6];
				$titol_pagines=$els_resultats[7];
				$titol_categoria_ID=$els_resultats[8];
				$titol_medi_ID=$els_resultats[9];
				$titol_sinopsis=$els_resultats[10];
				$titol_data=$els_resultats[11];
				$titol_cataleg=$els_resultats[12];
				$titol_status=$els_resultats[13];
				}	
				
		$mysqli_error=mysqli_error($link_ID);
		$MYSQL_ERROR=mysqli_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){
				echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
				}		
?>		
<P>
<table bgcolor="ffffaa" class="normal">
		<TR>			<TD>
				<B>Títol:  </B><?php echo $titol_nom ?> 			</TD>		
			<TD>
				<B>Data d'aquesta edició:  </B><?php echo	$titol_data ?> 			</TD>
		</TR>		<TR>
			<TD>		
				<B>Autor/a: </B>
					<A href="./detalls_autor.php?autor_ID=<?php echo $titol_autor_ID ?>&pagina_actual=1"> 
						<?php echo $_POST['autor_nom']." ". $_POST['autor_cognoms'] ?>	</A>
			</TD>

			<TD>								<?php		
					$editorial_query="SELECT * from editorials WHERE editorial_ID=".$titol_editorial_ID;	
					$resultats=mysqli_query($link_ID,$editorial_query);
					$els_resultats=mysqli_fetch_row($resultats);
					
					$mysqli_error=mysqli_error($link_ID);
					$MYSQL_ERROR=mysqli_error($link_ID);
				
					if (!empty($MYSQL_ERROR)){
						echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
						}
				?>
				<B>Editorial/Col.lecció: </B><?php echo $els_resultats[1]."/". $els_resultats[2] ?>										</TD>
		</TR>
		
		<TR>
			<TD>
				<?php					$idioma_query="SELECT * from idiomes WHERE idioma_ID='".$titol_idioma_ID."'";			
					$resultats=mysqli_query($link_ID,$idioma_query);
					$els_resultats=mysqli_fetch_row($resultats);
					
					$mysqli_error=mysqli_error($link_ID);
					$MYSQL_ERROR=mysqli_error($link_ID);
				
					if (!empty($MYSQL_ERROR)){
						echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
						}
				?>
				<B>Llengua <font size=-2>(utilitzada en el titol)</font>:</B> <?php echo $els_resultats[1] ?>

							</TD>			<TD>
				<?php						$medi_query="SELECT * from medis WHERE medi_ID='".$titol_medi_ID."'";			
					$resultats=mysqli_query($link_ID,$medi_query);
					$els_resultats=mysqli_fetch_row($resultats);
					
					$mysqli_error=mysqli_error($link_ID);
					$MYSQL_ERROR=mysqli_error($link_ID);
				
					if (!empty($MYSQL_ERROR)){
						echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
						}
				?>
				<B>Medi:	</B><?php echo $els_resultats[1] ?>			</TD>
			
		</tr>			
		<TR>
			<TD>
								<?php					$categoria_query="SELECT * from categories	WHERE categoria_ID='".$titol_categoria_ID."'";			
					$resultats=mysqli_query($link_ID,$categoria_query);
					$els_resultats=mysqli_fetch_row($resultats);
					
					$mysqli_error=mysqli_error($link_ID);
					$MYSQL_ERROR=mysqli_error($link_ID);
				
					if (!empty($MYSQL_ERROR)){
						echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
						}
				?>
					<B>Categoria:</B> <?php echo $els_resultats[1] ?>			</TD>
			<TD>	<?php 
					$procedencia_query="SELECT * from procedencies WHERE procedencia_ID='".$titol_procedencia_ID."'";					
					$resultats=mysqli_query($link_ID,$procedencia_query);
					$els_resultats=mysqli_fetch_row($resultats);

				
					$mysqli_error=mysqli_error($link_ID);
					$MYSQL_ERROR=mysqli_error($link_ID);
				
					if (!empty($MYSQL_ERROR)){
						echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
						}
				?>
					<B>Procedéncia: </B><?php echo $els_resultats[1] ?>			</TD>
		</TR>			
		<TR>
			
			<TD>
				<?php
				if ($els_resultats[1]='DVD'){echo "<B>Duració en minuts</B>";}
				else{echo "<B>Número de pàgines</B>";}
				?>
			
			
				<?php echo $titol_pagines ?>
 			</TD>
			
			<TD><B>ISBN: </B>
				<?php echo $titol_ISBN ?>
			</TD>


		</tr>


		<TR>
			
			<TD>
				<B>Número de catàleg</B> 
				<?php echo $titol_cataleg ?>
 			</TD>
			
			<TD><B>Status: </B>
				<?php echo $titol_status ?>
			</TD>


		</tr>


		<TR>
			<TD colspan=2>

				 <B>Sinopsis:</B>
				<BR><?php echo $titol_sinopsis ?>
			</TD>
		</TR>	
		</table>

<p class="petit">Piqueu sobre el nom de l'autor/a per veure detalls.	
<P>

<?php
	include("peu.txt");
?>