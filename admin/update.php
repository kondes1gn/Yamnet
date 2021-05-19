<?php
session_start();

if (!$_SESSION['user']) {
  header('Location: /');
}
if ($_SESSION['user']['user_group'] === '0') {
  header('Location: /');
}


require_once '../vendor/connect.php';
$claims = mysqli_query($connect, "SELECT * FROM `claims` ");
$id = $_GET['id'];
$claim = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `claims` WHERE `id` = $id"));

?>


<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <title> Update Claim - Admin Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="../assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <!-- Favicons -->

  <meta name="theme-color" content="#7952b3">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <style type="text/css">
    /* Chart.js */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0
    }
  </style>
</head>

<body>

  <!-- ШАПКА -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#">YAMnet</a>
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
                  <a class="nav-link" href="../admin/content.php">Админ панель</a>
                </li>
              ';
            };
            ?>
            <li class="nav-item">
              <a class="nav-link" href="../claims.php">Мои заявки</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../profile.php">Профиль</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../vendor/logout.php">Выход</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- / ШАПКА -->

  <div class="container-fluid">
    <div class="row">

      <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
        <div class="container" style="max-width: 900px">
          <div class="my-5 pb-5">
            <div class="my-4">
              <h3 class="my-0">Изменить заявку № <?= $id ?> (автор <?= $claim["author"] ?>)</h3>
            </div>
            <form method="POST" action="includes/save-claim.php" enctype="multipart/form-data">
              <input type="hidden" value="<?= $claim['id'] ?>" name="id">
              <div class="form-group">
                <label class="form-label">Название заявки</label>
                <input class="form-control" value='<?= $claim["title"] ?>' type="text" name="title" placeholder="Название заявки">
              </div>
              <div class="form-group">
                <label class="form-label">Статус заявки</label>
                <select id="data-type" name="status" class="form-control">
                  <option value="0" <?= $claim["status"] === '0' ? 'selected' : '' ?>>В обработке</option>
                  <option value="1" <?= $claim["status"] === '1' ? 'selected' : '' ?>>Устранено</option>
                </select>
              </div>

              <div class="form-group" id="image-form">
                <label class="form-label" for="imageBefore">Изображение до</label>
                <?php
                if ($claim["value"] !== '' && $claim["value"] !== NULL)
                  echo '
                  <div class="before-image-holder mb-2">
                    <img style="width:250px; object-fit:cover;" src="../' . $claim["value"] . '" alt="До">
                  </div>
                  ';
                ?>
                <button class="btn d-flex btn-info" type="button" data-toggle="collapse" data-target="#collapseEditImageBefore" aria-expanded="false" aria-controls="collapseEditImageBefore">
                  Изменить
                </button>
                <div class="collapse" id="collapseEditImageBefore">
                  <div class="py-3">
                    <input class="form-control" style="height: 43px;" name="imageBefore" type="file" accept="image/jpeg,image/png,image/gif">
                  </div>
                </div>
              </div>



              <div class="form-group" id="image-form">
                <label class="form-label" for="imageAfter">Изображение после</label>
                <?php
                if ($claim["newValue"] !== NULL && $claim["newValue"] !== '')
                  echo '
                  <div class="before-image-holder mb-2">
                    <img style="width:250px; object-fit:cover;" src="../' . $claim["newValue"] . '" alt="После">
                  </div>
                  ';
                ?>
                <button class="btn d-flex btn-info" type="button" data-toggle="collapse" data-target="#collapseEditImageAfter" aria-expanded="false" aria-controls="collapseEditImageAfter">
                  Изменить
                </button>
                <div class="collapse" id="collapseEditImageAfter">
                  <div class="py-3">
                    <input class="form-control" style="height: 43px;" name="imageAfter" type="file" accept="image/jpeg,image/png,image/gif">
                  </div>
                </div>
              </div>
              <div class="form-group mt-5">
                <button type="submit" class="btn btn-primary mr-2">Применить</button>
                <a href="content.php" class="btn btn-outline-secondary">Отменить</a>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>



  <script src="../assets/js/min/jquery.min.js"></script>
  <script src="../assets/js/min/popper.min.js"></script>
  <script src="../assets/js/min/bootstrap.min.js"></script>



</body>

</html>