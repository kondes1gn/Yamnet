<?php
session_start();
if ($_SESSION['user']) {
  header('Location: main.php');
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Авторизация и регистрация</title>
  <!-- <link rel="stylesheet" href="assets/css/main.css"> -->
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>

<body>
  <!-- <div class="d-flex py-5">
    <form class="auth-form p-4 m-auto">
      <h2 style="margin-bottom: 2rem ">Регистрация</h2>
      <div class="alert alert-danger d-none my-3" role="alert"></div>
      <div class="form-group">
        <label>ФИО</label>
        <input type="text" class="form-control" name="full_name" placeholder="Введите полное имя">
      </div>
      <div class="form-group">
        <label>Логин</label>
        <input type="text" class="form-control" name="login" placeholder="Введите логин">
      </div>
      <div class="form-group">
        <label>Почта</label>
        <input type="email" class="form-control" name="email" placeholder="Введите адрес почты">
      </div>
      <div class="form-group">
        <label>Изображение профиля</label>
        <input type="file" style="height: 43px;" class="form-control" name="avatar" accept="image/jpeg,image/png,image/gif">
      </div>
      <div class="form-group">
        <label>Пароль</label>
        <input type="password" class="form-control" name="password" placeholder="Введите пароль">
      </div>
      <div class="form-group">
        <label>Подтверждение пароля</label>
        <input type="password"  class="form-control" name="password_confirm" placeholder="Подтвердите пароль">
      </div>
    
      <button type="submit" class="btn btn-primary btn-block register-btn">Зарегистрироваться</button>
      <div class="my-3 text-center">
        или
      </div>
      <a class="btn btn-outline-primary btn-block" href="/"> Войти </a>
    </form>
  </div> -->



  <div class="form_mg">
    <form class="auth-form form bg-dark">
    <div class="alert alert-danger d-none my-3" role="alert"></div>
      <h1 class="form_title">Регистрация</h1>
      <div class="form_grup">
        <div>
          <label class="form_label">ФИО</label>
        </div>
        <div>
          <input class="form_input for" type="text" name="full_name" placeholder="Ведите Ф.И.О">
        </div>
      </div>
      <div class="form_grup">
        <div>
          <label class="form_label">Логин</label>
        </div>
        <div>
          <input class="form_input for" type="text" name="login" placeholder="Введите логин" placeholder="Логин">
        </div>
      </div>
      <div class="form_grup">
        <div>
          <label class="form_label">Email</label>
        </div>
        <div>
          <input class="form_input for" name="email" type="text" placeholder="Email">
        </div>
      </div>
      <div class="form_grup">
        <div>
          <label class="form_label">Аватар</label>
        </div>
        <div>
          <input type="file" name="avatar" accept="image/jpeg,image/png,image/gif" class="form_input for" placeholder="Email">
        </div>
      </div>
      <div class="form_grup">
        <div>
          <label class="form_label">Пароль</label>
        </div>
        <div>
          <input class="form_input" type="password" name="password" placeholder="Пароль">
        </div>
      </div>
      <div class="form_grup">
        <div>
          <label class="form_label">Введите пароль повторно</label>
        </div>
        <div>
          <input class="form_input" type="password" name="password_confirm" placeholder="Введите пароль повторно">
        </div>
      </div>
      <div class="mt-4">
        <button type="submit" class="btn btn-primary register-btn">Зарегистрироваться</button>
        или
        <a href="index.php" class="btn btn-secondary" href="/"> Войти </a>
      </div>
    </form>
  </div>



  

  <script src="assets/js/min/jquery.min.js"></script>
  <script src="assets/js/auth.js"></script>
</body>

</html>