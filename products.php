<?php

include 'header.php';
include 'includes/classes/ProductModel.php';

$category_id = $_GET['category_id'];

$products = (new ProductModel)->getAll(['category_id' => $category_id], ['orderBy' => '-id']);

?>

<?php foreach ($products as $product): ?>
    <div class="card" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
<?php endforeach; ?>

<?php include 'footer.php' ?>