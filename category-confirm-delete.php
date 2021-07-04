<?php include 'header.php' ?>

<div class="card">
    <div class="card-body text-center">
        <h2 class="card-title mb-4">Вы уверены, что хотите удалить данную категорию?</h2>
        <form action="/includes/category-delete" method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <button type="submit" name="category-delete" class="btn btn-danger me-1">Удалить</button>
            <a href="/categories"><button type="button" class="btn btn-secondary">Отмена</button></a>
        </form>
    </div>
</div>

<?php include 'footer.php' ?>
