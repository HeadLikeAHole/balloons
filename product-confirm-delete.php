<?php

include 'header.php';

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

?>

<div class="card">
    <div class="card-body text-center">
        <h5 class="card-title mb-3">Вы уверены, что хотите удалить данный товар?</h5>
        <form action="/product-delete" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="previous_page" value="<?= $id ?>">
            <button type="submit" class="btn btn-danger me-2">Удалить</button>
            <a href="/"><button type="button" class="btn btn-secondary">Отмена</button></a>
        </form>
    </div>
</div>

<?php include 'footer.php' ?>