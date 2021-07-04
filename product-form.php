<?php

include 'header.php';
include 'includes/classes/ProductModel.php';
include 'includes/classes/CategoryModel.php';

try {
    if (isset($_GET['id'])) {
        $product = (new ProductModel)->get('id', $_GET['id']);
        if (!$product) header('Location: /404');
    }

    $categories = (new CategoryModel)->getAll([], ['order_by' => 'id']);
} catch (PDOException $e) {
    displayDbError();
}

?>

<div class="mx-auto">
    <h1 class="display-4 text-center mb-5"><?= !isset($_GET['id']) ? 'Создать' : 'Изменить' ?> товар</h1>

    <form action="/includes/product-submit" method="post" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?= $product->id ?? '' ?>">

        <input type="hidden" id="user_id" name="user_id" value="<?= $user->id ?>">

        <div class="mb-3">
            <label for="image" class="form-label">Выберите изображение</label>
            <input class="form-control <?= isset($_GET['error']) && substr($_GET['error'], 0, strlen('image-')) === 'image-' ? 'is-invalid' : '' ?>" type="file" id="image" name="image">
            <!-- display file field error (starts with "image-") -->
            <?php if (isset($_GET['error']) && substr($_GET['error'], 0, strlen('image-')) === 'image-'): ?>
                <div class="invalid-feedback"><?= $errors[$_GET['error']] ?></div>
            <?php endif; ?>
            <div class="mt-4">
                <img src="<?= isset($product) ? $product->getImageUrl() : '' ?>" alt="" id="image-preview" class="<?= $_GET['id'] ?? 'd-none' ?> w-100">
            </div>
        </div>

        <div class="my-4">
            <label for="title" class="form-label">Haзвание</label>
            <input type="text" class="form-control <?= isset($_GET['error']) && substr($_GET['error'], 0, strlen('title-')) === 'title-' ? 'is-invalid' : '' ?>" id="title" name="title" value="<?= $_GET['title'] ?? $product->title ?? '' ?>">
            <!-- display title field error (starts with "title-") -->
            <?php if (isset($_GET['error']) && substr($_GET['error'], 0, strlen('title-')) === 'title-'): ?>
                <div class="invalid-feedback"><?= $errors[$_GET['error']] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-4">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control <?= isset($_GET['error']) && substr($_GET['error'], 0, strlen('description-')) === 'description-' ? 'is-invalid' : '' ?>" id="description" name="description" rows="3"><?= $_GET['description'] ?? $product->description ?? '' ?></textarea>
            <!-- display description field error (starts with "image-") -->
            <?php if (isset($_GET['error']) && substr($_GET['error'], 0, strlen('description-')) === 'description-'): ?>
                <div class="invalid-feedback"><?= $errors[$_GET['error']] ?></div>
            <?php endif; ?>
        </div>

        <div class="mb-5">
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

        <div class="d-grid gap-3 d-md-block">
            <button type="submit" name="product-submit" class="btn btn-success me-md-1">Сохранить</button>
            <a href="<?= isset($_GET['prev']) ? urldecode($_GET['prev']) : '/' ?>" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>

<?php include 'footer.php' ?>
