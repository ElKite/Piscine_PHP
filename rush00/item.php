<?php

include"tools.php";

if ($_POST['retour'] == "Retour")
{
	header("Location: index.php");
}

if ($_GET['categories'])
{
	echo ("<html><head>
	<link rel='stylesheet' type='text/css' href='item.css'/>
	</head>
	<body>
		<form action='panier.php'>
		<input type=submit name ='Panier' value='Panier'/>
		</form>
	 ");

		$tab = 	getAllMerchandisesFrom($_GET['categories']);
		foreach ($tab as $key => $merchandise) {
			echo ("<table><tr>");
		    echo("<th>".$merchandise['name']."</th>");
		    echo("<td> <b>Categories : </b>".$merchandise['categories']."</td>");
		    echo("</tr>");
		    echo("<tr>");
			echo("<th rowspan='3'>"."<img src=".$merchandise['img']." alt=".$merchandise['name']." style='width:304px;height:228px;'>"."</th>");
		    echo("<td>".$merchandise['desc']."</td>");
		    echo("</tr>");
		    echo("<tr>");
		    echo("<td><b> Prix : </b>".$merchandise['price']." € </td>");
		    echo("<td><form method='POST' action='index.php'>
	    			<button type='submit' value=".$merchandise['id']." name='submit'>Ajouter au Panier</button>
					</td>");
		    echo("</tr>");
		    echo("<tr>");
		    echo("<td><b> Stock : </b>".$merchandise['stock']."</td>");
		    echo("</tr>"."\n");
		    echo("</table>");
		    echo("<hr>");
		}
	echo ("<br/>
	    <input type=submit name ='retour' value='Retour' />
	    </form>
	</body>
	</html>");
}



?>