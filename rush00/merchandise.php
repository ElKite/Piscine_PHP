<?php
include "tools.php";

function displayAllMerchandise()
{
  $tab = getAllMerchandises();
  echo ("<html><head>
<link rel='stylesheet' type='text/css' href='merchandise.css'/>
</head>
<body>
<table>
  <tr>
    <th>id</th>
    <th>name</th>
    <th>categories</th> 
    <th>price</th>
    <th>description</th>
    <th>image</th>
    <th>stock</th>
  </tr>");
  if (count($tab) > 0)
  {
    foreach ($tab as $key => $merchandise) {
      echo("<tr><td>".$merchandise['id']."</td>");
      echo("<td>".$merchandise['name']."</td>");
      echo("<td>".$merchandise['categories']."</td>");
      echo("<td>".$merchandise['price']."</td>");
      echo("<td>".$merchandise['desc']."</td>");
      echo("<td>"."<img src=".$merchandise['img']." alt=".$merchandise['name']." style='width:304px;height:228px;'>"."</td>");
      echo("<td>".$merchandise['stock']."</td>");
      echo("</tr"."\n");
    }
  }
  echo("</table>

</body>
</html>");
}

session_start();
if (empty($_SESSION['loggued_on_user']) || (!empty($_SESSION['loggued_on_user']) && getStatus($_SESSION['loggued_on_user']) == FALSE))
{
  header("Location: index.php");
  echo ("Vous n'etes pas connecte / admin"."\n");
}
//DELETE A MERCHANDISE
if ($_POST['del_id'] && $_POST['submit'] == "OK")
{
  header("Refresh:0");
  deleteAMerchandise($_POST['del_id']);
}
//CREATE A MERCHANDISE
if ($_POST['name'] && $_POST['categories'] && $_POST['price'] && $_POST['description'] && $_POST['image'] && $_POST['stock'] && $_POST['create'] == "OK")
{
  if (is_numeric($_POST['price']) == TRUE && is_numeric($_POST['stock']) == TRUE)
  {
    header("Refresh:0");
    $merchandise = array("id" => getNbrOfDifferentMerchandise() + 1, "name" => $_POST['name'], "price" => $_POST['price'], "desc" => $_POST['description'], "img" => $_POST['image'], "stock" => $_POST['stock'], "categories" => $_POST['categories']);
    createAMerchandise($merchandise);
  } else
      echo "error price or stock isn't a numeric number ..."."\n";
}
//EDIT A MERCHANDISE
if (($_POST['edit_id'] && $_POST['edit_name'] && $_POST['edit_categories'] && $_POST['edit_price'] && $_POST['edit_description'] && $_POST['edit_image'] && $_POST['edit_stock'] && $_POST['edit'] == "OK"))
{
  if (is_numeric($_POST['edit_price']) == TRUE && is_numeric($_POST['edit_stock']) == TRUE)
  {
    header("Refresh:0");
    $merchandise = array("id" => $_POST['edit_id'] , "name" => $_POST['edit_name'], "price" => $_POST['edit_price'], "desc" => $_POST['edit_description'], "img" => $_POST['edit_image'], "stock" => $_POST['edit_stock'], "categories" => $_POST['edit_categories']);
    editAMerchandise($merchandise);
  } else
      echo "error price or stock isn't a numeric number ..."."\n";
}
 // edit categories only

if ($_POST['edit_id'] && $_POST['edit_categories'] && $_POST['edit'] == "OK")
{
  if (is_numeric($_POST['edit_id']) == TRUE)
  {
    header("Refresh:0");
    editACategorie($_POST['edit_id'], $_POST['edit_categories']);
  } else
    echo "error id isn't a numeric number ..."."\n";
}
displayAllMerchandise();


?>

<html><body>
<br/>
<form action="index.php">
    <input type="submit" value="Retour" />
</form>
<br/>
<form method="POST" action="merchandise.php">
  Creer une marchandise: <br/>
  name <input type="text" name="name"/><br/>
  categories <input type="text" name="categories"/><br/>
  price <input type="text" name="price"/><br/>
  description <input type="text" name="description"/><br/>
  image <input type="text" name="image"/><br/>
  stock <input type="text" name="stock"/><br/>
<input type="submit" name="create" value="OK"/><br/>
</form>
<hr>
<form method="POST" action="merchandise.php">
   Id de la marchandise a supprimer:<input type="text" name="del_id"/>
<input type="submit" name="submit" value="OK"/>
</form>
<br/><hr>
<form method="POST" action="merchandise.php">
  Modifier une marchandise: <br/>
  id <input type="text" name="edit_id"/><br/>
  name <input type="text" name="edit_name"/><br/>
  categories <input type="text" name="edit_categories"/><br/>
  price <input type="text" name="edit_price"/><br/>
  description <input type="text" name="edit_description"/><br/>
  image <input type="text" name="edit_image"/><br/>
  stock <input type="text" name="edit_stock"/><br/>
<input type="submit" name="edit" value="OK"/><br/>
</form>
<br/><hr>
</body></html>