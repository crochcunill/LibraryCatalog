<?php
	session_start();
	$validacio=$_POST['validacio'];

	if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

	//Aquest es la capcalera dels fitxers en HTML
	include("capcalera2.txt");
		
	include("common_variables.php");
	
	$query_string="SELECT * FROM titols,autors,idiomes WHERE titol_id=".$_POST['titol_ID'];
	

	$resultats=mysqli_query($link_ID,$query_string, $link_ID);
		
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
				}	
				
		$mysqli_error=mysqli_error($link_ID);
		$MYSQL_ERROR=mysql_error($link_ID);
				
		if (!empty($MYSQL_ERROR)){
				echo "2===> $mysqli_error:    $MYSQL_ERROR  <BR>";
				}		
?>		


	<p>En aquesta pàgina podeu editar o esborrar aquest autor
	
	
<P>Per editar el contingut, modifiqueu les entrades, i després premeu <I>Entrar</I>	
<FORM action="editar_titol2_bis.php" method=POST id=form1 name=form1>

<table bgcolor="ffffaa" class="normal">
		<TR>
			<TD colspan=2>
				<P>Títol <font size=-2>(requerit)</font>:&nbsp; <INPUT type="text" id=text1 name="titol_nom" value="<?php echo $titol_nom ?>" size=65>			</TD>
		</TR>
		<TR>
			<TD>
				<P>Autor/a <font size=-2>(ordenat per cognoms)</font>:
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from autors ORDER BY autor_cognoms", 1);		
			
					echo "<SELECT id=select1 name=titol_autor_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]==$titol_autor_ID){				
							echo "<OPTION value=" . $els_resultats[0]." selected>" . $els_resultats[2] . ", " .$els_resultats[1] . "</OPTION>";
							}
						else{
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[2] . ", " .$els_resultats[1] . "</OPTION>";	
							}
						}//end while	

					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);
				
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
						}
				?>
			</TD>

			<TD>					<P>Editorial/Col.lecció:
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from editorials ORDER BY editorial_nom", 1);
		
					echo "<SELECT id=select1 name=titol_editorial_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]==$titol_editorial_ID){									
							echo "<OPTION value=" . $els_resultats[0]." selected>" . $els_resultats[1]."/".$els_resultats[2] . "</OPTION>";
							}
						else{
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1]."/".$els_resultats[2] . "</OPTION>";
							}
					}//end while	

					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);		
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
						}
				?>			
			</TD>
		</TR>
		
		<TR>
			<TD>Llengua <font size=-2>(utilitzada en el titol)</font>:			
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from idiomes ORDER BY idioma_nom", 1);
		
					echo "<SELECT id=select1 name=titol_idioma_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]==$titol_idioma_ID){									
							echo "<OPTION value=" . $els_resultats[0]." selected>" . $els_resultats[1] . "</OPTION>";
							}
						else{	
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
							}
						}//end while	
					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error <BR>";
						}
				?>			
				</TD>
				<TD>Medi:
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from medis ORDER BY medi_nom",1);
			
					echo "<SELECT id=select1 name=titol_medi_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]==$titol_medi_ID){
							echo "<OPTION value=" . $els_resultats[0]." selected>" . $els_resultats[1] . "</OPTION>";
							}
						else{	
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
							}
						}//end while	
					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
						}
				?>				
			</TD>			
		</tr>			
		<TR>
			<TD>
				<P>Categoria:				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from categories ORDER BY categoria_nom", 1);

					echo "<SELECT id=select1 name=titol_categoria_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]==$titol_categoria_ID){									
							echo "<OPTION value=" . $els_resultats[0]." selected>" . $els_resultats[1] . "</OPTION>";
							}
						else{	
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
							}		
						}//end while	

					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);				
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
						}
				?>				
			</TD>
			<TD>
				<P>Procedéncia:				
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from procedencies ORDER BY procedencia_descripcio",1);

					echo "<SELECT id=select1 name=titol_procedencia_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]==$titol_procedencia_ID){									
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
							}
						else{	
							echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
							}
						}//end while	

					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
						}
				?>			
			</TD>
		</TR>			
		<TR>
			<TD>Numero de pàgines <font size=-2>(requerit)</font>:
				<BR><INPUT type="text" name="titol_pagines" size=5 value="<?php echo $titol_pagines ?>">			</TD>
			<TD>ISBN:
				<BR><INPUT type="text" name="titol_ISBN" size=20 value="<?php echo $titol_ISBN ?>" >			</TD>

		</tr>			<TR>
			<TD colspan=2>
				Sinopsis:
				<BR><TEXTAREA rows=5 cols=60 id=textarea1 name="titol_sinopsis">
					<?php echo $títol_sinopsis ?>
				</TEXTAREA>			
			</TD>
		</TR>	
		<TR>
			<TD colspan=2 align=left>				
				<INPUT type="hidden" name="titol_ID" value="<?php echo $_POST['titol_ID'] ?>" >
				<INPUT type="hidden" name="pagina_actual" value="<?php echo $pagina_actual ?>">	
				<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
				<INPUT type="submit" value="Entrar" id=submit1 name=submit1>		
			</TD>
		</tr>		
	</table>
</FORM>	
	




<?php
	include("peu2.txt");
?>