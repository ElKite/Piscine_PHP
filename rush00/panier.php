<?php
include "tools.php";

session_start();

if ($_POST['retour'] == "Retour")
{
	header("Location: index.php");
}

if ($_POST['valider'] == "valider")
{
	$panier = getAllPurchases();
	foreach ($panier as $key => $elem) {
		handleStock($elem['id'], $elem['quantity']);
		unset($panier[$key]);
	}
	setcookie("panier", serialize($panier), time() + 3600);
	header("Location: panier.php");
}
function displayPanier()
{
  $tab = getAllPurchases();
  echo ("<html><head><link rel='stylesheet' type='text/css' href='panier.css'/></head><body><table><tr><th>id</th><th>name</th><th>categories</th><th>price</th><th>quantite</th></tr>");
  if (is_array($tab) || is_object($tab))
  {
  	$price = 0;
  	$nbrArticle = 0;
  	foreach ($tab as $key => $panier)
  	{
		echo("<tr><td>".$panier['id']."</td>");
		echo("<td>".$panier['name']."</td>");
		echo("<td>".$panier['categories']."</td>");
		echo("<td>".$panier['price']."</td>");
		echo("<td>".$panier['quantity']."</td>");
		echo("</tr"."\n");
		$price = $price + ($panier['price'] * $panier['quantity']);
		$nbrArticle = $nbrArticle + $panier['quantity'];
	}
  }
	echo("<tr><td></td>");
	echo("<td> TOTAL </td>");
	echo("<td></td>");
	echo("<td>Prix : ".$price."€</td>");
	echo("<td>Nbr Articles : ".$nbrArticle."</td>");
	echo("</tr></tr>"."\n");
  	echo("</table></body></html>");
}
	if ($_POST['id'] && $_POST['plus'] == "+")
	{
		increasePurchaseQuantities($_POST['id']);
		header("Location: panier.php");
	}
	else if ($_POST['id'] && $_POST['moins'] == "-")
	{
		decreasePurchaseQuantities($_POST['id']);
		header("Location: panier.php");
	}
	displayPanier();
?>

<html><body>
<form method="POST" action="panier.php">
   Id :<input type="text" name="id"/>
<input type="submit" name="plus" value="+"/>
<input type="submit" name="moins" value="-"/>
	<br />
<?php if(!empty($_SESSION['loggued_on_user'])) { ?>
	<input type="submit" name="valider" value="valider" /> 
<?php } ?>
    <input type="submit" name="retour" value="Retour" />
</form>
</body>
</html>