<?php include 'header.php' ?>

<h1 class="display-4 text-center mb-4">Вход на сайт</h1>

<form action="includes/login-submit.php" method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Логин</label>
        <input type="text" class="form-control <?= isset($_GET['error']) && substr($_GET['error'], 0, strlen('username-')) === 'username-' ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= $_GET['username'] ?? '' ?>">
        <!-- display file field error (starts with "image-") -->
        <?php if (isset($_GET['error']) && substr($_GET['error'], 0, strlen('username-')) === 'username-'): ?>
            <div class="invalid-feedback"><?= $errors[$_GET['error']] ?></div>
        <?php endif; ?>
    </div>
    <div class="mb-5">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control <?= isset($_GET['error']) && substr($_GET['error'], 0, strlen('password-')) === 'password-' ? 'is-invalid' : '' ?>" id="password" name="password">
        <?php if (isset($_GET['error']) && substr($_GET['error'], 0, strlen('password-')) === 'password-'): ?>
            <div class="invalid-feedback"><?= $errors[$_GET['error']] ?></div>
        <?php endif; ?>
    </div>

    <div class="d-grid gap-3 d-md-block">
            <button type="submit" name="login-submit" class="btn btn-success me-md-1">Войти</button>
            <a href="/" class="btn btn-secondary">Отмена</a>
        </div>
</form>

<?php include 'footer.php' ?>