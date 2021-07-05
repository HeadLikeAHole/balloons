<?php

include 'header.php';
include 'includes/classes/CategoryModel.php';
include 'includes/classes/ProductModel.php';

try {
    $category_id = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);

    $category = (new CategoryModel)->get('id', $category_id);

    $page = $_GET['page'] ?? 1;
    // items per page
    $limit = 24;
    $offset = ($page - 1) * $limit;

    $productModel = new ProductModel();

    $products = $productModel->getAll(
        [
            'category_id' => $category_id
        ],
        [
            'orderBy' => '-id',
            'limit' => $limit,
            'offset' => $offset
        ]
    );

    $total = $productModel->count('category_id', $category_id);
} catch (PDOException $e) {
    displayDbError();
}

?>

<?php if ($products): ?>
    <h3 class="mb-3 text-center">Категория: <span class="text-lowercase fst-italic"><?= $category->name ?></span></h3>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 g-1 g-md-2 g-xl-3">
                <a href="/product-detail?id=<?= $product->id ?>"><img src="<?= $product->getImageUrl() ?>" class="img-thumbnail" alt="<?= $product->title ?? '' ?>"></a>
            </div>
        <?php endforeach; ?>       
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center">
            <h3 class="card-title mb-3">В данной категории ничего нет.</h3>
            <a href="/" class="text-decoration-none text-uppercase"><h5>← вернуться назад</h5></a>
        </div>
    </div>
<?php endif; ?>

<?php

if ($total > $limit) include 'pagination.php';

include 'footer.php';

?>