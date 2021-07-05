<?php

include 'includes/common.php';
include 'includes/classes/ProductModel.php';

if (isset($_POST['product-delete']) && $user) {
    try {
        // data to be converted to query string inside "sendError" method
        $data = [];

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $product = (new ProductModel())->get('id', $id);

        if ($product) {
            $imageFilePath = 'images/' . $product->image_name;

            if (!file_exists($imageFilePath) || !unlink($imageFilePath)) {
                $data['category'] = $product->category_id;
                $data['error'] = 'image-delete-failure';
                sendError('products', $data);
            }

            $product->delete();
        }

        sendMessage(
            $product->category_id == 1 ? '' : "products?category=$product->category_id",
            'warning',
            'Товар был удален.'
        );
    } catch (PDOException $e) {
        displayDbError();
    }
} else {
    header('Location: /403');
}
