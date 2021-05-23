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
$claimsCompletedLength = mysqli_query($connect,"SELECT `status` FROM `claims` WHERE status = 1");
$claimsProcessingLength = mysqli_query($connect,"SELECT `status` FROM `claims` WHERE status = 0");




?>


<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.80.0">
  <title>Admin Dashboard</title>

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

<body style="overflow-x:hidden">

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
        <div class="container" style="max-width: 1200px">
          <h1 class="my-5" style="color:red;">Админ панель</h1>
          <!-- Счётчик -->
          <div class="d-flex mt-5" data-counters="">
            <div class="c-me-8 vertical-stick">
              Всего: 
              <span style="font-weight: 700">
                <?= mysqli_num_rows($claims) ?>
              </span>
            </div>
            <div class="c-me-8 vertical-stick">
              Обработанных:
               <span style="color: green; font-weight: 700">
                <?= mysqli_num_rows($claimsCompletedLength)?>
               </span>
            </div>
            <div>
              Не обработанных:
               <span style="color: red; font-weight: 700">
                <?= mysqli_num_rows($claimsProcessingLength)?>
               </span>
            </div>
          </div>
          <!-- / Счётчик -->
          
          <h2 class="my-5">Заявки пользователей</h2>
          <div class="row">
    


            <?php
            if (mysqli_num_rows($claims)) {

              while ($claim = mysqli_fetch_assoc($claims)) {
                $statusText = $claim["status"] === '1' ? 'Устранено' : 'В обработке';
                $statusClass = $claim["status"] === '1' ? 'status-open' : 'status-closed';
                $imageBeforeSrcRender = $claim["value"] === '' ? 'assets/images/noimage.png' : $claim["value"];
                $imageAfterSrcRender = $claim["newValue"] === '' ? 'assets/images/noimage.png' : $claim["newValue"];
                $renderSecondImage;

                if ($claim["status"] === '1') {
                  $renderSecondImage = '
                  <div class="image-after w-100">
                      <div class="image-desc">После</div>
                      <img src="../' . $imageAfterSrcRender . '"  class="card-img-top" style="height: 200px; width:100%; object-fit:cover" alt="">
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
                        <img src="../' . $imageBeforeSrcRender . '"  class="card-img-top" style="height: 200px; width:100%; object-fit:cover" alt="">
                      </div>
                      ' . $renderSecondImage . '
                      <div class="card-body d-flex flex-column">
                        <h5>' . $claim["title"] . '</h5>
                        <div class="mt-auto"><p class="m-0">' . $claim["author"] . '</p></div>
                        <div class="' . $statusClass . '">' . $statusText . '</div>
                        <div class="d-flex mt-3">
                          <div class="me-2"><a class="btn btn-primary btn-sm" href="./update.php?id=' . $claim['id'] . '">Изменить</a></div>
                          <div><a class="btn btn-secondary btn-sm" href="includes/delete-claim.php?id=' . $claim['id'] . '">Удалить</a></div>
                        </div>
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
    </div>
  </div>


  <!-- <script>
    let select = document.getElementById("data-type");
    let textForm = document.getElementById("text-form");
    let imageForm = document.getElementById("image-form");


    select.addEventListener('change', function() {
      if (select && select.value == 1) {
        textForm.style.display = "block"
        imageForm.style.display = "none"
      } else if (select && select.value == 2) {
        textForm.style.display = "none"
        imageForm.style.display = "block"
      }
    })
  </script> -->

  <script src="../assets/js/min/jquery.min.js"></script>
  <script src="../assets/js/min/popper.min.js"></script>
  <script src="../assets/js/min/bootstrap.min.js"></script>

</body>

</html>