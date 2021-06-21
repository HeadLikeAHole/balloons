<?php

include 'header.php';
include 'includes/classes/CategoryModel.php';
include 'includes/classes/ProductModel.php';

try {
    $category_id = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);

    $category = (new CategoryModel)->get('id', $category_id);

    $products = (new ProductModel)->getAll(['category_id' => $category_id], ['orderBy' => '-id']);
} catch (PDOException $e) {
    displayDbError();
}

?>

<?php if ($products): ?>
    <h3 class="mb-4 text-center">Категория: <span class="text-lowercase fst-italic"><?= $category->name ?></span></h3>
    <?php foreach ($products as $product): ?>
        <div class="card mx-auto mb-4" style="max-width: 40rem;">
            <img src="<?= $product->getImageUrl() ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $product->title ?></h5>
                <p class="card-text"><?= $product->description ?></p>
                <?php if ($user): ?>
                    <a href="/product-form?id=<?= $product->id ?>"><button type="button" class="btn btn-warning btn-sm me-1">Изменить</button></a>
                    <a href="/product-confirm-delete?id=<?= $product->id ?>"><button type="button" class="btn btn-danger btn-sm">Удалить</button></a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center">
            <h3 class="card-title mb-4">В данной категории ничего нет.</h3>
            <a href="/" class="text-decoration-none text-uppercase">← вернуться назад</a>
        </div>
    </div>
<?php endif; ?>

<?php include 'footer.php' ?>