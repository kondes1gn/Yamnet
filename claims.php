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
  <title>Мои заявки</title>
  <link rel="icon" type="image/png" href="./images/favicon.png" />
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body style="background-color: #f6f6f6;">
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

  <main role="main" class="inner mt-5">
    <div class="container" style="max-width: 1200px">
      <h3 class="my-4">Мои заявки</h3>
      <div class="row">
      <?php
            if (mysqli_num_rows($claims)) {

              while ($claim = mysqli_fetch_assoc($claims)) {
                $statusText = $claim["status"] === '1' ? 'Устранено' : 'В обработке';
                $statusClass = $claim["status"] === '1' ? 'status-open' : 'status-closed';
                $imageBeforeSrcRender = $claim["value"] === '' ? 'assets/images/noimage.png' : $claim["value"];
                $imageAfterSrcRender = $claim["newValue"] === '' ? 'assets/images/noimage.png' : $claim["newValue"];
                $renderSecondImage;

                if($claim["status"] === '1') {
                  $renderSecondImage = '
                  <div class="image-after w-100">
                      <div class="image-desc">После</div>
                      <img src="' . $imageAfterSrcRender . '"  class="card-img-top" style="height: 200px; width:100%; object-fit:cover" alt="">
                  </div>
                  ';
                } else {
                  $renderSecondImage = '';
                }; 

                echo '
                  <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="custom-card card h-100 text-white bg-dark" data-claim-id="' . $claim["id"] . '">
                      <div class="image-before  w-100">
                        <div class="image-desc">До</div>
                        <img src="' . $imageBeforeSrcRender . '"  class="card-img-top" style="height: 200px; width:100%; object-fit:cover" alt="">
                      </div>
                      ' . $renderSecondImage .'
                      <div class="card-body d-flex flex-column">
                        <h5>' . $claim["title"] . '</h5>
                        <div class="mt-auto"><p class="m-0">' . $claim["author"] . '</p></div>
                        <div class="' . $statusClass . '">' . $statusText . '</div>
                      </div>
                    </div>
                  </div>
                  ';
              }
            } else {
              echo 'Нет новых заявок';
            }

            ?>
      </div>
    </div>
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">

    </div>
  </footer>



</body>

</html>