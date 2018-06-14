<form action="float.php" method="POST" name="Botones" align="center">
	<input type="submit" name="biseccion" value="Biseccion">
	<input type="submit" name="falsa" value="Falsa Posicion">
	<input type="submit" name="newton" value="Newton-Raphson">
	<input type="submit" name="secante" value="Secante">
	<input type="submit" name="decimal" value="Arturo's method">
</form>
<br>
<?php

function biseccion($a,$b){

	return ($a+$b)/2;

}
function Falsa($a,$b){
		
	$c=($a*F($b)-$b*F($a))/(F($b)-F($a));
	return $c;

}
function Newton($x0){
	$x1=$x0-(F($x0)/Fd($x0));
	return $x1;
}
function Secante($x0,$x1){

	$x2=$x1-F($x1)*(($x1-$x0)/(F($x1)-F($x0)));
	return $x2;

}
function F($x){

	$y=5*pow($x,3)+4*pow($x,2)-5*$x;
	return $y;

}
function Fd($x){

	$y=15*pow($x,2)+8*$x-5;
	return $y;

}
function Decimal($a,$b,$e)
{
	for ($i=$a; $i <= $b; $i+=$e) { 
		$aaux=$i;$baux=$i+$e;
		if(F($aaux)*F($baux)<0){
			$a=$aaux;
			return $a;
		}	
	}
}


if (isset($_POST['biseccion'])) {

	?>
	<form action="float.php" method="POST" name="accionarb" align="center">
		<input type="text"   name="a"      placeholder="a">
		<input type="text"   name="b"      placeholder="b">
		<input type="text"   name="max"    placeholder="epsilon">
		<input type="submit" name="actionb" value="action">
	</form>
	<?php

}
if (isset($_POST['falsa'])) {

	?>
	<form action="float.php" method="POST" name="accionarf" align="center">
		<input type="text"   name="a"      placeholder="a">
		<input type="text"   name="b"      placeholder="b">
		<input type="text"   name="max"    placeholder="epsilon">
		<input type="submit" name="actionf" value="action">
	</form>
	<?php

}
if (isset($_POST['newton'])) {

	?>
	<form action="float.php" method="POST" name="accionarn" align="center">
		<input type="text"   name="X0"      placeholder="x0">
		<input type="text"   name="max"    placeholder="epsilon">
		<input type="submit" name="actionn" value="action">
	</form>
	<?php

}
if (isset($_POST['secante'])) {

	?>
	<form action="float.php" method="POST" name="accionars" align="center">
		<input type="text"   name="X0"      placeholder="x0">
		<input type="text"   name="X1"      placeholder="x1">
		<input type="text"   name="max"    placeholder="epsilon">
		<input type="submit" name="actions" value="action">
	</form>
	<?php
}


if (isset($_POST['decimal'])) {
	?>
	<form action="float.php" method="POST" name="accionard" align="center">
		<input type="text"   name="a"      placeholder="a">
		<input type="text"   name="b"      placeholder="b">
		<input type="text"   name="max"    placeholder="epsilon">
		<input type="submit" name="actiond" value="action">
	</form>
	<?php
}






if (isset($_POST['actionb']) || isset($_POST['actionf'])) {

	$a=$_POST['a'];$b=$_POST['b'];$max=$_POST['max'];
	echo "<table border=1 cellspacing=0 cellpadding=2 bordercolor=\"#000\" align='center'>";
	?>
	<tr>
		<td>i</td>
		<td>a</td>
		<td>b</td>
		<td>c</td>
		<td>F(a)</td>
		<td>F(b)</td>
		<td>F(c)</td>
		<td>Ea(%)</td>
		<td>F(a)*F(c)</td>
	</tr>
	<?php
	$aant=$a;
	$i=1;
	do {
		if (isset($_POST['actionb'])) {
			$c=biseccion($a,$b);
		}elseif (isset($_POST['actionf'])) {
			$c=Falsa($a,$b);
		}
		$error=abs(($c-$aant)/$c)*100;
		echo "<tr>
				<td>$i</td>
				<td>$a</td>
				<td>$b</td>
				<td>$c</td>
				<td>".F($a)."</td>
				<td>".F($b)."</td>
				<td>".F($c)."</td>
				<td>$error</td>
				<td>".F($a)*F($c)."</td>";
		if (F($a)*F($c)<0) {
			$b=$c;
		}else{
			$a=$c;
		}
		echo "</tr>";
		$i++;
		$aant=$c;
	} while (abs(F($c)) > $max);

	echo "</table>";
	echo "<br> la raiz es $c";

}

if (isset($_POST['actionn'])) {

	$x0=$_POST['X0'];$max=$_POST['max'];
	echo "<table border=1 cellspacing=0 cellpadding=2 bordercolor=\"#000\" align='center'>";
	?>
	<tr>
		<td>i</td>
		<td>x0</td>
		<td>F(x0)</td>
		<td>F’(x0)</td>
		<td>x1</td>
		<td>F(x1)</td>
		<td>Ea(%)</td>
	</tr>
	<?php
	$xant=$x0;
	$i=1;
	do {
		$x1=Newton($x0);
		$error=abs(($x1-$xant)/$x1)*100;
		echo "<tr>
				<td>$i</td>
				<td>$x0</td>
				<td>".F($x0)."</td>
				<td>".Fd($x0)."</td>
				<td>$x1</td>
				<td>".F($x1)."</td>
				<td>$error</td>";
		$x0=$x1;
		echo "</tr>";
		$i++;
		$xant=$x1;
	} while (abs(F($x1)) > $max);
		echo "</table>";
		echo "<br> la raiz es $x1";

}


if (isset($_POST['actions'])) {

	$x0=$_POST['X0'];$max=$_POST['max'];$x1=$_POST['X1'];
	echo "<table border=1 cellspacing=0 cellpadding=2 bordercolor=\"#000\" align='center'>";
	?>
	<tr>
		<td>i</td>
		<td>x0</td>
		<td>F(x0)</td>
		<td>x1</td>
		<td>F(x1)</td>
		<td>x2</td>
		<td>F(x2)</td>
		<td>Ea(%)</td>
	</tr>
	<?php
	$i=1;
	$xant=$x1;
	do {
		$x2=Secante($x0,$x1);
		$error=abs(($x2-$xant)/$x2)*100;
		echo "<tr>
				<td>$i</td>
				<td>$x0</td>
				<td>".F($x0)."</td>
				<td>$x1</td>
				<td>".F($x1)."</td>
				<td>$x2</td>
				<td>".F($x2)."</td>
				<td>$error</td>";
		$x0=$x1;
		$x1=$x2;
		$xant=$x2;
		echo "</tr>";
		$i++;
	} while (abs(F($x1)) > $max);
		echo "</table>";
		echo "<br> <div align='center'>la raiz es $x2 </div>";

}

if (isset($_POST['actiond'])) {
	$a=$_POST['a'];$b=$_POST['b'];$max=$_POST['max'];
	$e=1;
	echo "<table border=1 cellspacing=0 cellpadding=2 bordercolor=\"#000\" align='center'>";
	?>
	<tr>
		<td>a</td>
		<td>F(a)</td>
		<td>b</td>
		<td>F(b)</td>
		<td>F(a)*F(b)</td>
	</tr>
	<?php
do {
	$e=$e/10;
	echo "<tr>
			<td>$a</td>
			<td>".F($a)."</td>
			<td>$b</td>
			<td>".F($b)."</td>
			<td>".F($a)*F($b)."</td>";
	$a=Decimal($a,$b,$e);
	$b=$a+$e;
	} while ($e>$max);
	echo "</table>";
	echo "<br> <div align='center'>la raiz es $a </div>";
	}
	?>

