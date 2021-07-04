<?php

include 'header.php';
include 'includes/classes/CategoryModel.php';

try {
    if (isset($_GET['id'])) {
        $category = (new CategoryModel)->get('id', $_GET['id']);
        if (!$category) header('Location: /404');
    }
} catch (PDOException $e) {
    displayDbError();
}

?>

<div class="my-form mx-auto">
    <h1 class="display-4 text-center mb-5"><?= !isset($_GET['id']) ? 'Создать' : 'Изменить' ?> категорию</h1>

    <form action="/includes/category-submit" method="post">
        <input type="hidden" id="id" name="id" value="<?= $category->id ?? '' ?>">

        <div class="my-4">
            <label for="name" class="form-label">Название категории</label>
            <input type="text" class="form-control <?= isset($_GET['error']) && substr($_GET['error'], 0, strlen('name-')) === 'name-' ? 'is-invalid' : '' ?>" id="name" name="name" value="<?= $_GET['name'] ?? $category->name ?? '' ?>">
            <!-- display name field error (starts with "name-") -->
            <?php if (isset($_GET['error']) && substr($_GET['error'], 0, strlen('name-')) === 'name-'): ?>
                <div class="invalid-feedback"><?= $errors[$_GET['error']] ?></div>
            <?php endif; ?>
        </div>

        <div class="d-grid gap-3 d-md-block">
            <button type="submit" name="category-submit" class="btn btn-success me-md-1">Сохранить</button>
            <a href="/categories" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>

<?php include 'footer.php' ?>
