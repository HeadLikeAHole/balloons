<?php

include 'common.php';
include 'classes/ProductModel.php';

if (isset($_POST['product-submit']) && $user) {
    try {
        // data to be converted to query string inside "sendError" function
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

       if ($id !== null && ($id <= 0 || $id > 2147483647)) {
           sendMessage('product-form', 'danger', 'Неверный ID товара.');
       }

        if ($user_id <= 0 || $user_id > 2147483647) {
            sendMessage('product-form', 'danger', 'Неверный ID пользователя.');
        }

        if ($category_id <= 0 || $category_id > 2147483647) {
            sendMessage('product-form', 'danger', 'Неверный ID категории.');
        }

        if (strlen($title) < 1 || strlen($title) > 255) {
            $data['error'] = 'title-invalid';
            sendError('product-form', $data);
        }

        if (strlen($description) < 1 || strlen($description) > 65535) {
            $data['error'] = 'description-invalid';
            sendError('product-form', $data);
        }

        $product = new ProductModel();

        $image = $_FILES['image'];
        $imageError = $image['error'];

        if ($id && $imageError !== 4 || !$id) {
            if ($imageError !== 0) {
                $data['error'] = 'image-not-selected';
                sendError('product-form', $data);
            }

            $imageSize = $image['size'];
            if ($imageSize > 5242880) {  // 5242880 is 5 MB
                $data['error'] = 'image-too-large';
                sendError('product-form', $data);
            }

            $imageName = $image['name'];
            if (strlen($imageName) < 1 || strlen($imageName) > 50) {
                $data['error'] = 'image-name-invalid';
                sendError('product-form', $data);
            }

            if (preg_match('/^[a-zA-Z0-9\s_-]+\.(jpg|jpeg|png|gif)$/', $imageName) != 1) {
                $data['error'] = 'image-extension-invalid';
                sendError('product-form', $data);
            }

            if ($product->get('image_name', $imageName)) {
                $data['error'] = 'image-name-exists';
                sendError('product-form', $data);
            }

            $imageTmpName = $image['tmp_name'];
            if (!file_exists($imageTmpName)) {
                $data['error'] = 'image-upload-failure';
                sendError('product-form', $data);
            }

            $newImageFilePath = "../images/$imageName";

            // if id is present edit image file, otherwise create a new one
            if ($id && $imageError !== 4) {
                $oldImageFilePath = '../images/' . $product->get('id', $id)->image_name;

                if (!file_exists($oldImageFilePath)) {
                    $data['error'] = 'image-rename-failure';
                    sendError('product-form', $data);
                }

                if (!rename($oldImageFilePath, $newImageFilePath)) {
                    $data['error'] = 'image-rename-failure';
                    sendError('product-form', $data);                }
            } else {
                if (!move_uploaded_file($imageTmpName, $newImageFilePath)) {
                    $data['error'] = 'image-rename-failure';
                    sendError('product-form', $data);
                }
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

        sendMessage('', 'success', 'Товар был добавлен.');
    } catch (PDOException $e) {
        displayDbError();
    }
} else {
    header('Location: /403');
}
