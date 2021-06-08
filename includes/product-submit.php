<?php

if (isset($_POST['product-submit'])) {
    include 'classes/ProductModel.php';
    include 'helperFunctions.php';

    try {
        // data to be converted to query string inside "sendError" method
        $data = [];

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            // add id to query string so on validation error when editing a product id persists in url after redirection
            $data['id'] = $id;
        } else {
            // set id from empty string to null to autoincrement id in db
            $id = null;
        }

        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);

        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_NUMBER_INT);

        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $data['title'] = $title;

        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $data['description'] = $description;

        if ($id !== null && (!is_numeric($id) || $id <= 0 || $id > 2147483647)) {
            $data['error'] = 'invalid-product-id';
            sendError('product-form', $data);
        }

        if (!is_numeric($user_id) || $user_id <= 0 || $user_id > 2147483647) {
            $data['error'] = 'invalid-user-id';
            sendError('product-form', $data);
        }

        if (!is_numeric($category_id) || $category_id <= 0 || $category_id > 2147483647) {
            $data['error'] = 'invalid-category-id';
            sendError('product-form', $data);
        }

        if (strlen($title) < 1 || strlen($title) > 255) {
            $data['error'] = 'invalid-title';
            sendError('product-form', $data);
        }

        if (strlen($description) < 1 || strlen($description  > 65535)) {
            $data['error'] = 'invalid-description';
            sendError('product-form', $data);
        }

        $product = new ProductModel();

        $image = $_FILES['image'];
        $imageError = $image['error'];

        if ($id && $imageError !== 4 || !$id) {
            if ($imageError !== 0) {
                $data['error'] = 'no-image-selected';
                sendError('product-form', $data);
            }

            $imageSize = $image['size'];
            if ($imageSize > 5242880) {  // 5242880 is 5 MB
                $data['error'] = 'image-too-large';
                sendError('product-form', $data);
            }

            $imageName = $image['name'];
            if (strlen($imageName) < 1 || strlen($imageName) > 50) {
                $data['error'] = 'invalid-image-name';
                sendError('product-form', $data);
            }

            if (preg_match('/^[a-zA-Z0-9\s_-]+\.(jpg|jpeg|png|gif)$/', $imageName) != 1) {
                $data['error'] = 'invalid-image-extension';
                sendError('product-form', $data);
            }

            if ($product->get('image_name', $imageName)) {
                $data['error'] = 'image-name-exists';
                sendError('product-form', $data);
            }

            $imageTmpName = $image['tmp_name'];
            if (!file_exists($imageTmpName)) {
                $data['error'] = 'failure-to-upload';
                sendError('product-form', $data);        }

            $imageFilePath = "../images/$imageName";
            if (!move_uploaded_file($imageTmpName, $imageFilePath)) {
                $data['error'] = 'failure-to-upload';
                sendError('product-form', $data);
            }
        }

        if (!$product->save(array_merge([
            'id' => $id,
            'user_id' => $user_id,
            'category_id' => $category_id,
            'title' => $title,
            'description' => $description
        ], isset($imageName) ? ['image_name' => $imageName] : [] ))) {
            throw new PDOException;
        }

        header('Location: /?message=success');
    } catch (PDOException $e) {
        sendError('product-form', 'db-error');
    }
} else {
    header('Location: /');
}
