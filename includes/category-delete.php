<?php

include 'common.php';
include 'classes/CategoryModel.php';
include 'classes/ProductModel.php';

if (isset($_POST['category-delete']) && $user) {
    try {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

        $category = (new CategoryModel())->get('id', $id);

        if ($category) {
            $productModel = new ProductModel();

            $products = $productModel->getAll(['category_id' => $category->id]);

            foreach ($products as $product) {
                $imageFilePath = '../images/' . $product->image_name;

                if (file_exists($imageFilePath)) {
                    if (!unlink($imageFilePath)) {
                        sendMessage('categories', 'danger', 'Неудалось удалить изображение.');
                    }
                }

                $product->delete();
            }

            $category->delete();
        }

        sendMessage('categories', 'warning', 'Категория была удалена.');
    } catch (PDOException $e) {
        displayDbError();
    }
} else {
    header('Location: /403');
}
