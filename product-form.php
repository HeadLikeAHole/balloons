<?php

include 'header.php';
require_once 'inc/fns.inc.php';

$categories = getCategories();

?>

<div class="product-form mx-auto">
    <h1 class="display-4 text-center mb-4">Создать шарик</h1>

    <form action="inc/product.inc.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="image" class="form-label">Выберите изображение</label>
            <input class="form-control" type="file" id="image" name="image">
            <div class="mt-3">
                <img src="" alt="" id="image-preview" class="w-100">
            </div>
        </div>
        <div class="mb-4">
            <label for="title" class="form-label">Haзвание</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $_GET['title'] ?? '' ?>">
        </div>
        <div class="mb-4">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= $_GET['title'] ?? '' ?></textarea>
        </div>
        <div class="mb-4">
            <label for="category" class="form-label">Категория</label>
            <select class="form-select" id="category" name="category">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="product-submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

<?php include 'footer.php' ?>