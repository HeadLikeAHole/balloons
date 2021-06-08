<?php

include 'header.php';
include 'includes/classes/ProductModel.php';

$category_id = $_GET['category'];

$products = (new ProductModel)->getAll(['category_id' => $category_id], ['orderBy' => '-id']);

?>

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

<?php include 'footer.php' ?>