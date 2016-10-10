<?php
include("tools.php");

session_start();

if ($_POST['submit'])
{
	$purchase = createPurchaseFromId($_POST['submit']);
	if (isset($purchase))
		addAPurchaseToPanier($purchase);
	else
		echo "Plus de stock";
}

$panier = array();
if (!$_COOKIE['panier'])
	setcookie("panier", serialize($panier), time() + 3600);
echo("
<html>
	<head>
		<link rel='stylesheet' type='text/css' href='index.css'>
	</head>
	<body>
			<div style='text-align: center; margin-top: 30px'>
			<div id='one'>
			<ul id='base' class='dropdown'>
<li class='nam'><b>Categories</b></li>");

echo("<ul class='mel dropdown-content'>");
$Categories = getAllCategories();
foreach ($Categories as $key => $value) {
	echo("<li class='highlight'><a href='item.php?categories=".$value."'>".$value."</a></li>");
}
				
echo("</ul></ul>");

if(empty($_SESSION['loggued_on_user'])){ 

?>
 
<html>
<body>
		<ul id="base" class="dropdown">
			<li class="nam"><a href="login.html"><b>Se connecter</b></a></li>
		</ul>
	</body>
</html>
 
<?php }?>

<?php

if(!empty($_SESSION['loggued_on_user'])) { 

?>
 
 <html>
 <body>

				<ul id="base" class="dropdown">
				<li class="nam"><b>Mon compte</b></li>
				<ul class="mel dropdown-content">
					<li class="highlight"><a href="logout.php">Se deconnecter</a></li>
					<li class="highlight"><a href="modif.html">Modifier son compte</a></li>
				</ul>
			</ul>
	</body>
</html>
 
<?php } ?>

<?php
if($_SESSION['loggued_on_user'] == "admin") { 
?>
 
 
<html>
	<body>
			<ul id="base" class="dropdown">
			<li class="nam"><b>Admin</b></li>
			<ul class="mel dropdown-content">
				<li class="highlight"><a href="admin.php">Users</a></li>
				<li class="highlight"><a href="merchandise.php">Marchandises</a></li>
			</ul>
			</ul>

	</body>
</html>

<?php } ?>

<html>
	<body>
		<ul id="base" class="dropdown">
			<li class="nam"><a href="panier.php"><b>Panier</b></a></li>
		</ul>
		</div>
		</div>
		</form>
	</body>
</html>
<?php
echo ("<html><head>
	<link rel='stylesheet' type='text/css' href='item.css'/>
	</head>
	<body>
	 ");
		$tab = getAllMerchandises();
		foreach ($tab as $key => $merchandise) {
			echo ("<table><tr>");
		    echo("<th>".$merchandise['name']."</th>");
		    echo("<td> <b>Categories : </b>".$merchandise['categories']."</td>");
		    echo("</tr>");
		    echo("<tr>");
			echo("<th rowspan='3'>"."<a href='item.php?categories=".$merchandise['categories']."'><img src=".$merchandise['img']." alt=".$merchandise['name']." style='width:304px;height:228px;'></a>"."</th>");
		    echo("<td>".$merchandise['desc']."</td>");
		    echo("</tr>");
		    echo("<tr>");
		    echo("<td><b> Prix : </b>".$merchandise['price']." € </td>");
		    echo("</tr>");
		    echo("<tr>");
		    echo("<td><b> Stock : </b>".$merchandise['stock']."</td>");
		    echo("</tr>"."\n");
		    echo("</table>");
		    echo("<hr>");
		}
	echo ("<br/>
	<br/></form></body>
	</html>");
?>