<?php include 'header.php' ?>

<h1 class="display-4 text-center mb-4">Вход на сайт</h1>

<form action="inc/login.inc.php" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Логин</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= $_GET['username'] ?? '' ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" name="login-submit" class="btn btn-primary">Войти</button>
</form>

<?php include 'footer.php' ?>