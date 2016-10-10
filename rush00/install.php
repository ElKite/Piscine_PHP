<?php

include "tools.php";

function createAdmin()
{
	if (file_exists("../private") == FALSE)
		mkdir("../private");
	$newtab['login'] = "admin";
	$newtab['passwd'] = hash('whirlpool', "admin");
	$newtab['status'] = "admin";
	if (file_exists("../private/members"))
	{
		$tab = unserialize(file_get_contents("../private/members"));
		foreach($tab as $elem)
		{
			if ($elem['login'] == $newtab['login'])
			{
				echo "ERROR login already exist\n";
				exit(0);
			}
		}
	}
	$tab[] = $newtab;
	file_put_contents("../private/members", serialize($tab));
}

function insertMerchandise()
{

createMerchandiseFile();

createAMerchandise(array("id" => 1, "name" => 'Poney', "price" => '100', "desc" => 'C\'est petit poney', "img" => 'http://upload.wikimedia.org/wikipedia/commons/1/17/Shtland_pony_-_Postbridge.jpg', "stock" => '4', "categories" => 'Animal'));
createAMerchandise(array("id" => getNbrOfDifferentMerchandise() +1, "name" => 'Licorne', "price" => '200', "desc" => 'C\'est une licorne', "img" => 'http://lacerisesurlenuage.fr/c/57-category_default/licornes.jpg', "stock" => '2', "categories" => 'Bizarre'));
createAMerchandise(array("id" => getNbrOfDifferentMerchandise() +1, "name" => 'Gorille', "price" => '5000', "desc" => 'C\'est un gros gorille', "img" => 'http://buzzly.fr/uploads/thumb/960/php5iSJas.jpg', "stock" => '12', "categories" => 'Zoo'));
createAMerchandise(array("id" => getNbrOfDifferentMerchandise() +1, "name" => 'Titi', "price" => '250', "desc" => 'C\'est titi', "img" => 'http://www.snut.fr/wp-content/uploads/2015/11/image-de-titi.gif', "stock" => '2', "categories" => 'Toons'));
createAMerchandise(array("id" => getNbrOfDifferentMerchandise() +1, "name" => 'Gros Minet', "price" => '2000', "desc" => 'Un vilain gros minet', "img" => 'http://www.wingsunfurled-web.com/da/titi/images/grosminet-heureux.jpg', "stock" => '12', "categories" => 'Toons'));
createAMerchandise(array("id" => getNbrOfDifferentMerchandise() +1, "name" => 'Meme', "price" => '2000000', "desc" => 'C\'est meme !', "img" => 'http://www.dvdseries.net/images/test/7278-image-1241649130.jpg', "stock" => '1', "categories" => 'Toons'));
createAMerchandise(array("id" => getNbrOfDifferentMerchandise() +1, "name" => 'Cailloux magiques', "price" => '55', "desc" => 'Des cailloux magiques', "img" => 'http://www.confiseriethermale.com/140-thickbox_default/caillou-chocolat.jpg', "stock" => '72', "categories" => 'Magie'));
createAMerchandise(array("id" => getNbrOfDifferentMerchandise() +1, "name" => 'Livre magique', "price" => '120', "desc" => 'edition d\'origine', "img" => 'http://vignette3.wikia.nocookie.net/harrypotter/images/e/e4/Livre_magique.png/revision/latest?cb=20140121235922&path-prefix=fr', "stock" => '4', "categories" => 'Magie'));
createAMerchandise(array("id" => getNbrOfDifferentMerchandise() +1, "name" => 'Tout seul', "price" => '1', "desc" => 'Tout seul oklm dans sa categorie', "img" => 'http://s2.lemde.fr/image/2008/10/14/534x267/1106883_3_5001_raymond-domenech-ici-en-octobre-2008-a_02c3c64a39aeeebd20af8549d374f8bd.jpg', "stock" => '2', "categories" => 'ToutSeul'));
}

createAdmin();
insertMerchandise();
header("Location: index.php")

?>