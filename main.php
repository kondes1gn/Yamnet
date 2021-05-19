<?php
session_start();

if (!$_SESSION['user']) {
  header('Location: /');
}

require_once 'vendor/connect.php';
$claims = mysqli_query($connect, "SELECT * FROM `claims` ");


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <div class="page">

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
    <div class="content">
      <!-- ПРЕВЬЮ -->
      <section class="preview">
        <div class="preview-background"></div>
        <div class="container">
          <div class="preview-content d-flex flex-column justify-content-center" style="height: 300px">
            <div class="col-12 col-md-6">
              <h1 class="mb-4">Yamnet</h1>
              <div class="mb-5">
                <span>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla sed nesciunt necessitatibus in sit
                  aut recusandae blanditiis repellat voluptate repellendus qui ipsam fugiat modi voluptas dicta, illum
                  id eligendi amet.</span>
              </div>
              <div>
                <button type="button" class="btn btn-primary me-2">Заполнить заявку</button>
                <button type="button" class="btn btn-outline-primary">Мои заявки</button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- / ПРЕВЬЮ -->

      <main class="mt-4">
        <div class="container">
          <div style="margin: 3.5rem 0">
            <h2>Заявки</h2>
          </div>

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

          <div class="container">
          <div class="mt-5 mb-4">
            <h3 class="my-0">Добавить новую заявку</h3>
          </div>
          <form action="admin/includes/add-claim.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="form-label mt-2" for="image">Добавить название заявки</label>
              <input class="form-control text-white form_input_request bg-dark" type="text" name="title" placeholder="Название заявки">
            </div>
            <div class="form-group" id="image-form">
              <label class="form-label mt-2" for="image">Добавить изображение</label>
              <input class="text-white form-control form_input_request bg-dark" name="image" id="image" type="file" accept="image/jpeg,image/png,image/gif">
            </div>
            <div class="form-group my-4">
              <button name="submit" type="submit" class="btn btn-primary">Добавить заявку</button>
            </div>
          </form>
        </div>


        </div>
      </main>
    </div>
    <footer class="bg-dark py-3">
      <div class="container">
        Сайт сделан by <a style="text-decoration: none;" href="https://github.com/kondes1gn?tab=repositories">Костя</a>
      </div>
    </footer>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>