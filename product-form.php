<?php

include 'header.php';
include 'includes/classes/CategoryModel.php';

$categories = (new CategoryModel)->getAll([], ['order_by' => 'id']);

?>

<div class="product-form mx-auto">
    <h1 class="display-4 text-center mb-4">Создать шарик</h1>

    <form action="includes/product-submit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" id="user_id" name="user_id" value="<?= $user->id ?>">
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
            <textarea class="form-control" id="description" name="description" rows="3"><?= $_GET['description'] ?? '' ?></textarea>
        </div>
        <div class="mb-4">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-select" id="category_id" name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="product-submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

<?php include 'footer.php' ?>