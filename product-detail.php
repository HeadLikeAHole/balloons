<?php

include 'header.php';
include 'includes/classes/ProductModel.php';

try {
    $product = (new ProductModel)->get('id', $_GET['id']);
    if (!$product) header('Location: /404');
} catch (PDOException $e) {
    displayDbError();
}

?>

<div class="card mx-auto mb-4 text-center" style="max-width: 40rem;">
    <img src="<?= $product->getImageUrl() ?>" class="card-img-top" alt="<?= $product->title ?? '' ?>">
    <div class="card-body">
        <h5 class="card-title"><?= $product->title ?? '' ?></h5>
        <p class="card-text"><?= $product->description ?? '' ?></p>
        <?php if ($user): ?>
            <a href="/product-form?id=<?= $product->id . '&prev=' . urlencode($_SERVER['REQUEST_URI']) ?>"><button type="button" class="btn btn-warning me-1">Изменить</button></a>
            <a href="/product-confirm-delete?id=<?= $product->id . '&prev=' . urlencode($_SERVER['REQUEST_URI']) ?>"><button type="button" class="btn btn-danger">Удалить</button></a>
        <?php endif; ?>
        <a href="products?category=<?= $product->category_id ?>" class="text-decoration-none text-uppercase"><h6 class="my-4">← вернуться назад</h6></a>
    </div>
</div>

<?php include 'footer.php' ?>