<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
require_once 'vendor/connect.php';


$author = $_SESSION['user']['login'];
$claims = mysqli_query($connect, "SELECT * FROM `claims` WHERE `author` = '$author'");


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Профиль</title>
    <link rel="icon" type="image/png" href="./images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<body>
    <!-- ШАПКА -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">YAMnet</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#" tabindex="-1" aria-disabled="true"> <?= $_SESSION['user']['login'] ?> </a>
            </li>
            <?php
            if ($_SESSION['user']['user_group'] === '1') {
              echo '
                <li class="nav-item">
                  <a class="nav-link" href="admin/content.php">Админ панель</a>
                </li>
              ';
            };
            ?>
            <li class="nav-item">
              <a class="nav-link" href="claims.php">Мои заявки</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profile.php">Профиль</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="vendor/logout.php">Выход</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- / ШАПКА -->
    <div class="container" style="max-width: 1200px">
        <main role="main" class="inner profile-body p-5 d-flex flex-wrap">
            <div class="d-flex align-center align-items-center mr-5">
                <div class="avatar">
                    <img src="<?= $_SESSION['user']['avatar'] ?>" alt="" />
                </div>
            </div>
            <div>
                <h1 class="cover-heading"><?= $_SESSION['user']['login'] ?></h1>
                <p class="lead"><?= $_SESSION['user']['full_name'] ?></p>
                <p class="lead"><?= $_SESSION['user']['email'] ?></p>
                <p class="lead">
                    <?php
                    if ($_SESSION['user']['user_group'] === '0') {
                        echo '<span>Пользователь</span>';
                    } else {
                        echo '<span style="color:red">Администратор</span>';
                    }

                    ?>
                </p>

                <p class="lead mt-5">
                    <a href="claims.php" class="btn btn-lg btn-dark">Мои заявки</a>
                    <a href="vendor/logout.php" class="btn btn-lg btn-outline-dark">Выход из аккаунта</a>
                </p>
            </div>
        </main>
    </div>

    <footer class="mastfoot mt-auto">
        <div class="inner">

        </div>
    </footer>



</body>

</html>