<?php

include 'includes/classes/ProductModel.php';
include 'includes/classes/CategoryModel.php';

try {
    $slides = (new ProductModel)->getAll(['category_id' => 1]);

    $categories = (new CategoryModel)->getAll([], ['order_by' => 'id']);

    // all categories except slides
    $categories = array_slice($categories, 1);
} catch (PDOException $e) {
    displayDbError();
}

?>

<div id="carouselExampleCaptions" class="carousel slide h-50" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($slides as $index => $slide): ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $index  ?>" class="<?= $index === 0 ? 'active' : '' ?>"></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($slides as $index => $slide): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <img src="<?= $slide->getImageUrl() ?>" class="d-block w-100 h-100 slide" alt="...">
                <div class="image-overlay"></div>
                <div class="carousel-caption">
                    <h1><?= $slide->title ?></h1>
                    <p><?= $slide->description ?></p>
                    <?php if ($user): ?>
                        <a href="/product-form?id=<?= $slide->id ?>"><button type="button" class="btn btn-warning btn-sm me-1">Изменить</button></a>
                        <a href="/product-confirm-delete?id=<?= $slide->id ?>"><button type="button" class="btn btn-danger btn-sm">Удалить</button></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="row mt-3">
    <?php foreach ($categories as $category): ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
            <div class="card mb-1 bg-light bg-gradient">
                <div class="card-body shadow-sm text-center fs-5">
                    <a href="/products?category=<?= $category->id ?>" class="text-decoration-none"><?= $category->name ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
