<?php

include 'header.php';
include 'includes/classes/CategoryModel.php';
include 'includes/classes/ProductModel.php';

try {
    $category_id = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);

    $category = (new CategoryModel)->get('id', $category_id);

    $page = $_GET['page'] ?? 1;
    // items per page
    $limit = 10;
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
    <h3 class="mb-4 text-center">Категория: <span class="text-lowercase fst-italic"><?= $category->name ?></span></h3>
    <div class="row">
        <div class="col-3">
            <?php foreach ($products as $product): ?>
                <div class="card mx-auto mb-4" style="max-width: 40rem;">
                    <img src="<?= $product->getImageUrl() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product->title ?? '' ?></h5>
                        <p class="card-text"><?= $product->description ?? '' ?></p>
                        <?php if ($user): ?>
                            <a href="/product-form?id=<?= $product->id . '&prev=' . urlencode($_SERVER['REQUEST_URI']) ?>"><button type="button" class="btn btn-warning me-2">Изменить</button></a>
                            <a href="/product-confirm-delete?id=<?= $product->id . '&prev=' . urlencode($_SERVER['REQUEST_URI']) ?>"><button type="button" class="btn btn-danger">Удалить</button></a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>       
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center">
            <h3 class="card-title mb-4">В данной категории ничего нет.</h3>
            <a href="/" class="text-decoration-none text-uppercase fs-5">← вернуться назад</a>
        </div>
    </div>
<?php endif; ?>

<?php

if ($total > $limit) include 'pagination.php';

include 'footer.php';

?>