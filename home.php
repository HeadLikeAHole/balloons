<?php

include 'includes/classes/ProductModel.php';
include 'includes/classes/CategoryModel.php';

$slides = (new ProductModel)->getAll(['category_id' => 1]);

$categories = (new CategoryModel)->getAll([], ['order_by' => 'id']);

// all categories except slides
$categories = array_slice($categories, 1);

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
                <div class="carousel-caption">
                    <h1><?= $slide->title ?></h1>
                    <p><?= $slide->description ?></p>
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
            <div class="card">
                <div class="card-body">
                    <a href="/products?category=<?= $category->id ?>"><h5 class="card-title text-center"><?= $category->name ?></h5></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
