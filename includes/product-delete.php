<?php

if (isset($_POST['product-submit'])) {
    include 'classes/ProductModel.php';
    include 'helperFunctions.php';

    try {
        // data to be converted to query string inside "sendError" method
        $data = [];

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $product = (new ProductModel())->get('id', $id);

        if ($product) {
            $product->delete();
            header('Location: /');
        }
        header('Location: /?message=success');
    } catch (PDOException $e) {
        sendError('product-form', 'db-error');
    }
} else {
    header('Location: /');
}
