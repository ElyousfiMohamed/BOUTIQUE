<?php
    ob_start();
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

  <link rel="stylesheet" href="../style/style.css">

  <title>Login</title>
</head>
<body>
        <nav>
            <ul>
                <li> ELYOUSFI Mohamed - BOUTIQUE  </li>
                <li> <a href="https://github.com/ElyousfiMohamed/BOUTIQUE" target="_blank"><i class="fab fa-github fa-lg"></i></a> </li>
                <li> <a href="https://youtu.be/DcMna3L-_e8" target="_blank"><i class="fab fa-youtube fa-lg"></i></i></a> </li>
            </ul>
        </nav>
        <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" id="SECONNECTE">CONNEXION</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="login.php">
                            
                         <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control input-sm"
                                           placeholder="Email Address" required>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <input type="password" name="password" id="password"
                                                   class="form-control input-sm" placeholder="Password" required>
                                        </div>
                                    </div>
                                </div>
                            <input type="submit" value="CONNECTE" class="btn btn-dark btn-block" name="connecte">
                            <center><a href="register.php">vous n'avez pas de compte ? cr??er un le ici</a></center>
                        </form>
                        <?php
                            if (isset($_POST['connecte'])) {
                                $email = trim($_POST['email']);
                                $password = trim($_POST['password']);
                                if (!$connect = mysqli_connect("localhost", "root", "")) {
                                    exit("Desol??, Connexion a localhost impossible");
                                }
                                if (!mysqli_select_db($connect, 'boutique')) {
                                    exit("Desol??, l'acces a la base boutique impossible");
                                }
                                $data = mysqli_query($connect, "SELECT * FROM utilisateur");
                                if ($data) {
                                    while ($ligne = mysqli_fetch_row($data)) {
                                        if ($email == $ligne[2] && $password == $ligne[3]) {
                                            session_start();
                                            $_SESSION['id_user'] = $ligne[0];
                                            $_SESSION['username'] = $ligne[1];
                                            $_SESSION['email'] = $ligne[2];
                                            echo "<script> window.location.replace(\"../index.php\"); </script>";
                                            exit;
                                        }
                                    }
                                    echo "<script>alert(\"Email ou password incorrect\")</script>";
                                    exit;
                                }

                            }
                            ?>
                    </div>
                </div>
</body>
</html>