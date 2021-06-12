<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        echo "<script> window.location.replace(\"Authentification/login.php\"); </script>";
    }

    if(isset($_REQUEST['add'])) {
        if(isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'],"product_id");
            if(in_array($_REQUEST['product_id'],$item_array_id)) {
                echo "<script>alert('produit déja dans le panier')</script>";
                echo "<script>window.location='index.php'</script>";
            }else {
                $count = count($_SESSION['cart']);
                $item_array = array (
                    'product_id'=>$_REQUEST['product_id']
                );
                $_SESSION['cart'][$count] = $item_array;
            }
        }else {
            $item_array = array (
                'product_id'=>$_REQUEST['product_id']
            );
            $_SESSION['cart'][0] = $item_array;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap cdn -->
  <link rel="stylesheet" 
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
  crossorigin="anonymous">

  <!-- fontawesome cdn -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
  integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <link rel="stylesheet" href="style/style.css">
  <title>Accueil</title>
</head>
<body>
        <?php
            require_once('header.php')
        ?>
        <!--<center><h3 style="color:white;margin-top:50px;padding:15px;border-radius:10px;background:#343a40;width :400px;">Liste des produits</h3></center>-->
        <div class="container2">
       <div class="row text-center py-5">
        <?php 
            if (!$connect = mysqli_connect("localhost", "root", "")) {
                exit("Desolé, Connexion a localhost impossible");
            }
            if (!mysqli_select_db($connect, 'boutique')) {
                exit("Desolé, l'acces a la base boutique impossible");
            }
            $data = mysqli_query($connect, "SELECT * FROM produits");
            while ($ligne = mysqli_fetch_row($data)) {
                echo "<div class=\"col-md-3 col-sm-3 my-1 my-md-0\">
                        <form action=\"index.php\" methode=\"post\">
                            <div>
                                <img src=".$ligne[4]." alt=\"image\" class=\"img-fluid card-img-top\">
                            </div>
                            <div class=\"card-body\">
                                <h5 class=\"card-title\">".$ligne[1]."</h5>
                                <p class=\"card-text\">".$ligne[2]."</p>
                                <h5>
                                    <small><s class=\"text-secondary\">".($ligne[3]-1)."$</s></small>
                                    <span class=\"price\">".$ligne[3]."$</span>
                                </h5>
                                <button type=\"submit\" name=\"add\" class=\"btn btn-warning my-3\">Ajouter au panier<i class=\"fas fa-shopping-cart\"></i></button>
                                <input type=\"hidden\" name=\"product_id\" value=\"$ligne[0]\">
                            </div>
                        </form>
                    </div>";} ?>
        </div>
        </div>
</body>
</html>