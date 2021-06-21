<?php include 'header.php' ?>

<div class="card">
    <div class="card-body text-center">
        <h2 class="card-title mb-4">Вы уверены, что хотите удалить данный товар?</h2>
        <form action="/includes/product-delete" method="post">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <input type="hidden" name="previous_page" value="<?= $_GET['id'] ?>">
            <button type="submit" name="product-delete" class="btn btn-danger me-1">Удалить</button>
            <a href="/"><button type="button" class="btn btn-secondary">Отмена</button></a>
        </form>
    </div>
</div>

<?php include 'footer.php' ?>