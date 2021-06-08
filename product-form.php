<?php

include 'header.php';
include 'includes/classes/ProductModel.php';
include 'includes/classes/CategoryModel.php';

if (isset($_GET['id'])) {
    $product = (new ProductModel)->get('id', $_GET['id']);
    if (!$product) header('Location: /404');
}

$categories = (new CategoryModel)->getAll([], ['order_by' => 'id']);

?>

<div class="product-form mx-auto">
    <h1 class="display-4 text-center mb-4">Создать шарик</h1>

    <form action="includes/product-submit" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?= $product->id ?? '' ?>">
        <input type="hidden" id="user_id" name="user_id" value="<?= $user->id ?>">
        <div class="mb-3">
            <label for="image" class="form-label">Выберите изображение</label>
            <input class="form-control" type="file" id="image" name="image">
            <div class="mt-3">
                <img src="<?= isset($product) ? $product->getImageUrl() : '' ?>" alt="" id="image-preview" class="w-100">
            </div>
        </div>
        <div class="mb-4">
            <label for="title" class="form-label">Haзвание</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $_GET['title'] ?? $product->title ?? '' ?>">
        </div>
        <div class="mb-4">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" rows="3"><?= $_GET['description'] ?? $product->description ?? '' ?></textarea>
        </div>
        <div class="mb-4">
            <label for="category_id" class="form-label">Категория</label>
            <select class="form-select" id="category_id" name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option
                        value="<?= $category->id ?>"
                        <?= isset($product->category_id) ? $product->category_id == $category->id ? 'selected' : '' : '' ?>
                    >
                        <?= $category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" name="product-submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

<?php include 'footer.php' ?>