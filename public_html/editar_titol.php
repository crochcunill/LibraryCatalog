<?php
	session_start();
	$validacio=$_POST['validacio'];

	if ($validacio!=session_id()){
		session_destroy();
		header("Location: ./Error.php?error=1"); /* Redirect browser */
		exit;
		} 

	//Aquest es la capcalera dels fitxers en HTML
	//En aquest cas no podem incloure la capçalera, ja que a la 
	// <BODY onload="dropdown(1,medis);"> hi apareix una crida a la funcio dropdown
	
	//include("capcalera2.txt");
		
	include("common_variables.php");
	
	$query_string="SELECT * FROM titols,autors,idiomes WHERE titol_id=".$_POST['titol_ID'];
	

	$resultats=mysqli_query($link_ID,$query_string, 1);
		
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
				$titol_any=$els_resultats[11];
				}	
				
		$mysqli_error=mysqli_error($link_ID);
		if (!empty($$mysqli_error)){
				echo "===> $mysqli_error<BR>";
				}		
?>		



		
<HTML>
<HEAD>

	<style type="text/css">
<!--
   
a { text-decoration: none;
	font-family: Verdana, Arial, Helvetica, sans-serif;
  color: #ff0000;
  }

A:Hover  {
	color: #00ff00;
	text-decoration: underline

    }


P {
		font-family: Verdana, Arial, Helvetica, sans-serif;
	}

LI {
		font-family: Verdana, Arial, Helvetica, sans-serif;
	}


H1 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		color=#FF0000;
	}	

H2 {	
		font-size=22;
		font-family: Verdana, Arial, Helvetica, sans-serif;
		color=#FF0000;
	}		


.petit {
		text-decoration: bold;
		font-size=10;
		color=#ff0000;
		font-family: Verdana, Arial, Helvetica, sans-serif;
	}

.normal {
		font-size=12;
		color=#000000;
		font-family: Verdana, Arial, Helvetica, sans-serif;
	}

-->

</style>
<TITLE>Editar Títol</TITLE>

<SCRIPT language=JavaScript type=text/javascript>
//Nota: Les funcions son lleugerament differents de les que utilitzo per 
//entrar les dades, ja que vull que apareixin els valors pre-sel.leccionats del medi i


function update(e, dd,selection2)
{
	for (j=1; j < dd.length; j++)
	{
		dd[j][0] = true;
	}

	for (j=1; j < dd[0].length; j++)
	{
		for (i=1; i < dd.length; i++)
		{
			current = dd[i][j].split("|");
			value = current[0];
			choice = current[0];
			if (current.length == 2) choice = current[1];
			if (value != document[dd[0][0]][dd[0][j]][document[dd[0][0]][dd[0][j]].selectedIndex].value) dd[i][0] = false;
		}
		if (e == document[dd[0][0]][dd[0][j]])
		{
			dropdown(j+1,dd,"",selection2);
			//dropdown(j+1,dd);
			for (k=j+2; k < dd[0].length; k++)
			{
				document[dd[0][0]][dd[0][k]].length = 0;
			}
			break;
		}
	}
}

function dropdown(item,dd,selection1,selection2)
{
	var pre1 = "";
	var j = 1;
	document[dd[0][0]][dd[0][item]].options.length = 0;

	document[dd[0][0]][dd[0][item]].options[0] = new Option('Select ' + dd[0][item], '');
	document[dd[0][0]][dd[0][item]].options[0].selected = true;
	
	if (item==1 && selection1!="") selection=selection1;
	if (item==2 && selection2!="") selection=selection2;
	
	for (i=1; i < dd.length; i++)
	{
	
		if (dd[i][0] || item == 1)		
		{		
				current = dd[i][item].split("|");
				value = current[0];
				choice = current[0];
				
				MyValue=current[0];
				
				if (current.length == 2) choice = current[1];
				if (value != pre1)
				{
					var op = new Option(choice, value);
					document[dd[0][0]][dd[0][item]].options[j] = op;
					if (MyValue==selection && selection!="")
					{
						document[dd[0][0]][dd[0][item]].options[j].selected = true;					
					}
					
					j++;
					pre1 = value;
				}
			
		}	
	}
	if (selection1!="")
	{	
		update(document[dd[0][0]][dd[0][1]],medis,selection2)	
	}
	
}

</SCRIPT>

<?php		
		$resultats=mysqli_query($link_ID,"SELECT categoria_nom,categoria_ID,medi_nom,medi_ID FROM categories, medis WHERE categoria_medi_ID=medi_ID order by categoria_medi_ID,categoria_nom", 1);		
					
		echo "<SCRIPT language=JavaScript type=text/javascript>";
		echo "var medis = new Array(";
		echo "new Array(\"form1\",\"medi\",\"categoria\")";
					
		while ($els_resultats=mysqli_fetch_row($resultats)){
					
				echo ",new Array(true,\"". $els_resultats[3] ."|". $els_resultats[2]."\",\"". $els_resultats[1]."|". $els_resultats[0]."\")";
						
			}//end while	

		echo ");";
		echo "</SCRIPT>";
					
		$mysqli_error=mysqli_error($link_ID);
		if (!empty($mysqli_error)){
			echo "===> $mysqli_error<BR>";
			}
?>


</HEAD>
<BODY onload="dropdown(1,medis,<?echo $titol_medi_ID?>,<?echo $titol_categoria_ID?>);">

<table width="100%">
<tr> 
 <td><IMG height=100 src="./pictures/noulogo.gif" width=110 align=center></td>
 <td valign="bottom" align="left" class="Text"><H1>Administraciô de la Biblioteca del Casal Català de Vancouver</H1></td>
</tr>
</table>    
	 
<table width="100%" border="0">  
  <tr bgcolor="#ffffaa"> 
    <td colspan="3" height="18"     
    align="left" bgcolor=#ffffaa class="petit"> 
     
<A href="index.php?validacio=<?php echo $validacio ?>">Menu principal </a>| 
<A href="gestor_autors.php?validacio=<?php echo $validacio ?>" >Gestor Autors</A> | 
<A href="gestor_titols.php?validacio=<?php echo $validacio ?>" >Gestor titols</A> | 
<A href="gestor_editorials.php?validacio=<?php echo $validacio ?>" >Gestor Editorials</A> | 
<A href="gestor_detalls.php?validacio=<?php echo $validacio ?>" >Gestor de detalls</A> | 
<A href="www.casalcatala.ca/biblioteca.htm" >Pàgina Biblioteca</A> 
 

    </td>     

  </tr>
</table> 





<p>En aquesta pàgina podeu editar o esborrar aquest títol
	
	
<P>Per editar el contingut, modifiqueu les entrades, i després premeu <I>Entrar</I>	
<FORM action="editar_titol2.php" method=POST id=form1 name=form1>

<table bgcolor="ffffaa" class="normal">
		<TR>			<TD>
				<P>Títol <font size=-2>(requerit)</font>:&nbsp; <INPUT type="text" id=text1 name="titol_nom" value="<?php echo $titol_nom ?>" size=45>			</TD>			<TD>
				<P>Publicat a l'any:&nbsp; <INPUT type="text" id=text1 name="titol_any" value="<?php echo $titol_any ?>" size=5>			</TD>			
		</TR>		<TR>
			<TD>					<P>Autor/a <font size=-2>(ordenat per cognoms)</font>:
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
						echo "===> $mysqli_error<BR>";
						}
				?>			
				</TD>			
				<TD>Medi:
					<select onchange="update(this,medis);" size="1" name="medi">            
                              <option></option>
					</select>
                			</TD>
			
		</TR>			
		<TR>
			<TD>Categoria:					<select size="1" name="categoria">
						<option selected>Seleccioneu categoria</option>
					</select>				</TD>
			<TD>
				<P>Procedéncia:				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from procedencies ORDER BY procedencia_descripcio", 1);

					echo "<SELECT id=select1 name=titol_procedencia_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]==$titol_procedencia_ID){									
							echo "<OPTION value=" . $els_resultats[0]." SELECTED>" . $els_resultats[1] . "</OPTION>";
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
			<TD>Nombre de pàgines <font size=-2>(requerit)</font>:
				<BR><INPUT type="text" name="titol_pagines" size=5 value="<?php echo $titol_pagines ?>">			</TD>
			<TD>ISBN:
				<BR><INPUT type="text" name="titol_ISBN" size=20 value="<?php echo $titol_ISBN ?>" >			</TD>

		</tr>			<TR>
			<TD colspan=2>
				Sinopsis:				<BR><TEXTAREA rows=5 cols=60 id=textarea1 name="titol_sinopsis"><?php echo $titol_sinopsis ?></TEXTAREA>			</TD>
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