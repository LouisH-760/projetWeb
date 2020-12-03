<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Vérification</title>
  <meta charset="utf-8" />
</head>

<body>
  <?php
  print_r($_POST);
  ?>
  <br>
  Login : <?php
          if (isset($_POST['login'])) {
            $login = trim($_POST['login']);
            echo $login;
          }
          ?>
  <br>
  Mot de passe : <?php
                  if (isset($_POST['passe'])) {
                    $passe = strtolower(trim($_POST['passe']));
                    echo $passe;
                  }
                  ?>
</body>

</html>