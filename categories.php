<?php

include 'header.php';
include 'includes/classes/CategoryModel.php';

try {
    $categories = (new CategoryModel)->getAll([], ['order_by' => 'id']);
    // all categories except slides
    $categories = array_slice($categories, 1);
} catch (PDOException $e) {
    displayDbError();
}

?>

<div class="mx-auto text-center" style="max-width: 40rem">
    <?php if ($categories): ?>
        <h3 class="mb-4">Список категорий:</h3>

        <div class="mb-4 text-start">
            <a href="/category-form" class="btn btn-primary btn-lg">Добавить категорию</a>
        </div>

        <?php foreach ($categories as $category): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4"><?= $category->name ?></h5>
                    <a href="/category-form?id=<?= $category->id ?>"><button type="button" class="btn btn-warning me-2">Изменить</button></a>
                    <a href="/category-confirm-delete?id=<?= $category->id ?>"><button type="button" class="btn btn-danger">Удалить</button></a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-4">Пока не созданно ни одной категории.</h3>
                <a href="/" class="text-decoration-none text-uppercase fs-5">← вернуться назад</a>
            </div>
        </div>
    <?php endif; ?> 
</div>

<?php include 'footer.php' ?>