<?php
	session_start();
	$validacio=$_GET['validacio'];

	if ($validacio!=session_id()){
			session_destroy();
			header("Location: ./Error.php?error=1"); /* Redirect browser */
			exit;
			} 
			
	
	//En aquest cas no podem incloure la capçalera("capcalera2.txt"), ja que a la 
	// <BODY onload="dropdown(1,medis);"> hi apareix una crida a la funcio dropdown


		
	include("common_variables.php");		
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
<TITLE>Pàgina d'autorització</TITLE>

<SCRIPT language=JavaScript type=text/javascript>
function update(e, dd)
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
			dropdown(j+1,dd);
			for (k=j+2; k < dd[0].length; k++)
			{
				document[dd[0][0]][dd[0][k]].length = 0;
			}
			break;
		}
	}
}

function dropdown(item,dd)
{
	var pre1 = "";
	var j = 1;
	document[dd[0][0]][dd[0][item]].options.length = 0;
	document[dd[0][0]][dd[0][item]].options[0] = new Option('Seleccioneu ' + dd[0][item], '');
	document[dd[0][0]][dd[0][item]].options[0].selected = true;
	for (i=1; i < dd.length; i++)
	{
		if (dd[i][0] || item == 1)
		{
			current = dd[i][item].split("|");
			value = current[0];
			choice = current[0];
			if (current.length == 2) choice = current[1];
			if (value != pre1)
			{
				var op = new Option(choice, value);
				document[dd[0][0]][dd[0][item]].options[j] = op;

				j++;
				pre1 = value;
			}
		}
	}
}

</SCRIPT>

<?php		
		$resultats=mysqli_query($link_ID,"SELECT categoria_nom,categoria_ID,medi_nom,medi_ID FROM categories, medis WHERE categoria_medi_ID=medi_ID order by categoria_medi_ID,categoria_nom");		
					
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
		mysqli_free_result($resultats);		
?>


</HEAD>
<BODY onload="dropdown(1,medis);">

<table width="100%">
<tr> 
 <td><IMG height=100 src="./pictures/noulogo.gif" width=110 align=center></td>
 <td valign="bottom" align="left" class="Text"><H1>Administració de la Biblioteca del Casal Català de Vancouver</H1></td>
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
<A href="adreces.htm" >Pàgina Biblioteca</A> 
 

    </td>     

  </tr>
</table> 

	<P>En aquesta pàgina podeu registrar a la base de dades un nou títol. El títol pot ser un llibre, 
	o un disc de música, o una pel.licula...:
	
	<FORM action="entrar_titol2.php" method=POST id=form1 name=form1>
	
	<table bgcolor="ffffaa" class="normal">
		<TR>			
			<TD>
				<P>Títol <font size=-2>(requerit)</font>:&nbsp; 
				<INPUT type="text" id=text1 name="titol_nom" size=45 value="<?php echo $titol_nom?>">			
			</TD>
			<TD>
				<P>Data d'aquesta edició:&nbsp; 
				<INPUT type="text" id=text1 name="titol_any" size=5 value="<?php echo $titol_any?>">			
			</TD>			
		</TR>
		<TR>
			<TD>
				<P>Autor/a <font size=-2>(ordenat per cognoms)</font>:
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from autors ORDER BY autor_cognoms");		
			
					echo "<SELECT id=select1 name=titol_autor_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[2] . ", " .$els_resultats[1] . "</OPTION>";
						}//end while	

					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);
				
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
					}
					mysqli_free_result($resultats);	
				?>
			</TD>
			<TD>
				<P>Editorial/Col.lecció:
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from editorials ORDER BY editorial_nom",1);
		
					echo "<SELECT id=select1 name=titol_editorial_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1]."/".$els_resultats[2] . "</OPTION>";
						}//end while	

					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
					}
					mysqli_free_result($resultats);	v
				?>
			</TD>
		</TR>
		
		<TR>
			<TD>Llengua <font size=-2>(utilitzada en el titol)</font>:			
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from idiomes ORDER BY idioma_nom",1);
		
					echo "<SELECT id=select1 name=titol_idioma_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						if ($els_resultats[0]=="1"){//escollim el Català com a llengua per defecte en aquesta opció
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
					mysqli_free_result($resultats);		
				?>			
				</TD>
				<TD>Seleccioneu medi:
					<select onchange="update(this,medis);" size="1" name="medi">            
                              <option></option>
                	</select>
                </TD>			
		</tr>			
		<TR>
			<TD>Seleccioneu categoria:

				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from categories ORDER BY categoria_nom",1);
		
					echo "<SELECT id=select1 name=categoria>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){	
						echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
							}	
					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);			
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error <BR>";
						}
					mysqli_free_result($resultats);		
				?>
			</TD>
			<TD>Procedéncia:
				<?php		
					$resultats=mysqli_query($link_ID,"SELECT * from procedencies ORDER BY procedencia_descripcio",1);

					echo "<SELECT id=select1 name=titol_procedencia_ID>";					
					while ($els_resultats=mysqli_fetch_row($resultats)){
						echo "<OPTION value=" . $els_resultats[0].">" . $els_resultats[1] . "</OPTION>";
						}//end while	

					echo "</SELECT>";
				
					$mysqli_error=mysqli_error($link_ID);
					if (!empty($mysqli_error)){
						echo "===> $mysqli_error<BR>";
						}
					mysqli_free_result($resultats);		
				?>			
			</TD>
		</TR>			
		<TR>
			<TD>Numero de pàgines <font size=-2>(requerit)</font>:
				<BR><INPUT type="text" name="titol_pagines" size=5 value="<?php echo $titol_pagines?>">			</TD>
			<TD>ISBN:
				<BR><INPUT type="text" name="titol_ISBN" size=20 value="<?php echo $titol_ISBN?>">			</TD>

		</tr>			
		<TR>
			<TD colspan=2>
				Sinopsis:
				<BR>
				<TEXTAREA rows=5 cols=75 id=textarea1 name="titol_sinopsis">Entreu una breu descripció del títol</TEXTAREA>	
				</TEXTAREA>
			</TD>
		</TR>	
		<TR>
			<TD colspan=2 align=left>
				<INPUT type="hidden" name="validacio" value="<?php echo $validacio?>" >
				<INPUT type="submit" value="Entrar" id=submit1 name=submit1>		
			</TD>
		</tr>		
	</table>
</FORM>	
	
<?php
	include("peu2.txt");
?>