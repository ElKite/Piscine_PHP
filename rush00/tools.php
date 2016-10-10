<?php

function getPanier($login)
{
	if (file_exists("../private/panier"))
	{
		$tab = unserialize(file_get_contents("../private/panier"));
		foreach($tab as $elem)
		{
			if ($elem['login'] == $login)
			{
				return ($elem['panier']);
			}
		}
	}
	return (-1);
}

function getStatus($login) //return true si admin
{
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		foreach($tab as $elem)
		{
			if ($elem['login'] == $login)
			{
			
				if ($elem['status'] == "admin")
				return (TRUE);
			}
		}
	}
	return (FALSE);
}

function delete($login)
{
	session_start();
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		foreach($tab as $key => $elem)
		{
			if ($elem['login'] == $login && $login != "admin")
			{
				unset($tab[$key]);
				if ($_SESSION['loggued_on_user'] == $login)
					$_SESSION['loggued_on_user'] = "";
				file_put_contents("../private/members", serialize($tab));
			}
		}
	}
	return ;
}

function createMerchandiseFile()
{
	if (file_exists("../private")== FALSE)
		mkdir("../private");
//	$merchandise = array("id" => 0, "name" => '', "price" => '', "desc" => '', "img" => '', "stock" => '', "categories" => '');
	file_put_contents("../private/merchandise", NULL);
}

function createAMerchandise($merchandise)
{
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		if (checkIfIdAlreadyExist($merchandise['id']) == TRUE) {
			$merchandise['id'] += 1;
			createAMerchandise($merchandise);
		}

	}

	$tab[] = $merchandise;
	file_put_contents("../private/merchandise", serialize($tab));
}

function checkIfIdAlreadyExist($id)
{
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		if (is_array($tab) || is_object($tab))
		{
			foreach($tab as $key => $elem)
			{
				if ($elem['id'] == $id)
				{
					return TRUE;
				}
			}
		}
		return FALSE;
	}
}

function editAMerchandise($merchandise)
{
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		foreach($tab as $key => $elem)
		{
			if ($elem['id'] == $merchandise['id'])
			{
				$tab[$key] = $merchandise;
				file_put_contents("../private/merchandise", serialize($tab));
			}
		}
		//echo "Error, id doesn't exist"."\n";
	}
}

function editACategorie($id, $categorie)
{
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		foreach($tab as $key => $elem)
		{
			if ($elem['id'] == $id)
			{
				if (strstr($elem['categories'], $categorie) == FALSE)
				{
					$elem['categories'] = $elem['categories']." ".$categorie;
				}
				else {
					if ($elem['categories'] != trim($categorie))
						$elem['categories'] = str_replace($categorie, "", $elem['categories']);
				}
				$tab[$key] = $elem;
				file_put_contents("../private/merchandise", serialize($tab));
				exit(0);
			}
		}
		echo "Error, id doesn't exist"."\n";
	}
}

function getCategoriesFrom($id)
{
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		foreach($tab as $key => $elem)
		{
			if ($elem['id'] == $id)
			{
				return $elem['categories'];
			}
		}
		echo "Error, id doesn't exist"."\n";
	}
}

function getAllCategories()
{
	$res = array();
	if (file_exists('../private/merchandise'))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		foreach ($tab as $key => $elem) {
			$s = explode(" ", $elem['categories']);
			foreach ($s as $skey => $selem) {
				if (array_search($selem, $res) == FALSE)
					$res[] = $selem;
			}
		}
		return $res;
	}
}

function deleteAMerchandise($id)
{
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		foreach($tab as $key => $elem)
		{
			if ($elem['id'] == $id)
			{
				unset($tab[$key]);
				file_put_contents("../private/merchandise", serialize($tab));
				exit(0);
			}
		}
		echo "Error, id doesn't exist"."\n";
	}
	return ;
}

function addAPurchaseToPanier($purchase)
{
	$panier = unserialize($_COOKIE['panier']);
	if (is_array($panier) || is_object($panier))
	{
		foreach ($panier as $key => $elem) {
			if ($elem['id'] == $purchase['id'])
			{
				increasePurchaseQuantities($purchase['id']);
				header("Location: index.php");
				exit(0);
			}
		}
	}
	$panier[] = $purchase;
	setcookie("panier", serialize($panier), time() + 3600);
}

function removeAPurchaseFromPanier($id)
{
	$panier = unserialize($_COOKIE['panier']);
	foreach ($panier as $key => $elem) {
		if ($elem['id'] == $id)
		{
			unset($panier[$key]);
			setcookie("panier", serialize($panier), time() + 3600);
		}
	}
}

function increasePurchaseQuantities($id)
{
	$panier = unserialize($_COOKIE['panier']);
	foreach ($panier as $key => $elem) {
		if ($elem['id'] == $id)
		{
			$elem['quantity'] += 1;
			$panier[$key] = $elem;
			setcookie("panier", serialize($panier), time() + 3600);
		}
	}
}

function decreasePurchaseQuantities($id)
{
	$panier = unserialize($_COOKIE['panier']);
	if (is_array($panier) || is_object($panier))
	{
		foreach ($panier as $key => $elem) {
			if ($elem['id'] == $id)
			{
				$elem['quantity'] -= 1;
				if ($elem['quantity'] <= 0)
					removeAPurchaseFromPanier($id);
				else 
				{
					$panier[$key] = $elem;
					setcookie("panier", serialize($panier), time() + 3600);
				}
			}
		}
	}
}

function getNbrOfDifferentMerchandise()
{
	$tab = unserialize(file_get_contents("../private/merchandise"));
	return count($tab);
}

function getAllPurchases()
{
	$panier = unserialize($_COOKIE['panier']);
	return $panier;
}

function getAllMerchandises()
{
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		return $tab;
	}
}

function getAllMerchandisesFrom($categorie)
{
	$res = array();
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		foreach($tab as $key => $elem)
		{
			if (strstr($elem['categories'], $categorie))
			{
				$res[] = $elem;
			}
		}
		return $res;
	}
}

function getAMerchandiseFromId($id)
{
	if (file_exists("../private/merchandise"))
	{
		$tab = unserialize(file_get_contents("../private/merchandise"));
		foreach($tab as $key => $elem)
		{
			if ($elem['id'] == $id)
			{
				return $elem;
			}
		}
		echo "Error, id doesn't exist"."\n";
	}
	return ;
}

function createPurchaseFromId($id)
{
	$merchandise = getAMerchandiseFromId($id);
	if ($merchandise['stock'] == 0)
		$purchase = NULL;
	else		
		$purchase = array('id' => $merchandise['id'], 'price' => $merchandise['price'], 'name' => $merchandise['name'], 'quantity' => 1,
		'categories' => $merchandise['categories']);
	return $purchase;
}

function handleStock($id, $quantity)
{
	$merchandises = getAMerchandiseFromId($id);
	$merchandises['stock'] -= $quantity;
	if ($merchandises['stock'] <= 0)
		$merchandises['stock'] = 0;
	editAMerchandise($merchandises);
}

?>