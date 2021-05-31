<?php

if (isset($_POST['product-submit'])) {
    include 'classes/ProductModel.php';
    include 'helperFunctions.php';

    try {
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

        $image = $_FILES['image'];

        $imageError = $image['error'];
        if ($imageError !== 0) {
            sendError('product-form', 'no-image-selected');
        }

        $imageSize = $image['size'];
        if ($imageSize > 5242880) {  // 5242880 is 5 MB
            sendError('product-form', 'image-too-large');
        }

        $imageName = $image['name'];

        $product = new ProductModel(null, $user_id, $category_id, $title, $description, $imageName);

        if ($product->get('image_name', $imageName)) {
            sendError('product-form', 'image-name-exists');
        }

        $imageTmpName = $image['tmp_name'];
        $product->saveImageFile($imageTmpName);

        $product->create();

        header('Location: /?message=success');
    } catch (ProductException $e) {
        sendError('product-form', $e->getMessage());
    } catch (PDOException $e) {
        sendError('product-form', 'db-error');
    }
} else {
    header('Location: /');
}
