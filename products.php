<?php

include 'header.php';
include 'includes/classes/ProductModel.php';

$category_id = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_NUMBER_INT);

$products = (new ProductModel)->getAll(['category_id' => $category_id], ['orderBy' => '-id']);

?>

<?php if ($products): ?>
    <?php foreach ($products as $product): ?>
        <div class="card w-100" style="width: 18rem;">
            <img src="<?= $product->getImageUrl() ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $product->title ?></h5>
                <p class="card-text"><?= $product->description ?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
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