<?php

include 'main.php';

if (isset($_POST['product-delete']) && $user) {
    include 'classes/ProductModel.php';

    try {
        // data to be converted to query string inside "sendError" method
        $data = [];

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $product = (new ProductModel())->get('id', $id);

        if ($product) {
            $imageFilePath = '../images/' . $product->image_name;

            if (file_exists($imageFilePath)) {
                if (!unlink($imageFilePath)) {
                    $data['category'] = $product->category_id;
                    $data['error'] = 'image-delete-failure';
                    sendError('products', $data);
                }
            }

            $product->delete();
        }
        header('Location: /?message=success');
    } catch (PDOException $e) {
        $data['error'] = 'dberror';
        sendError('/', $data);
    }
} else {
    header('Location: /');
}
