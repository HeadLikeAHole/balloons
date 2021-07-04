<?php

include 'common.php';
include 'classes/CategoryModel.php';

if (isset($_POST['category-submit']) && $user) {
    try {
        // data to be converted to query string inside "sendError" function
        $data = [];

        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        if ($id) {
            // add id to query string so on validation error when editing a category id persists in url after redirection
            $data['id'] = $id;
        } else {
            // set id from empty string to null to autoincrement id in db
            $id = null;
        }

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $data['name'] = $name;

        if ($id !== null && ($id <= 0 || $id > 2147483647)) {
            sendMessage('category-form', 'danger', 'Неверный ID категории.');
        }

        // slides category isn't allowed to be edited
        if ($id == 1) {
            header('Location: /403');
            exit;
        }

        if (strlen($name) < 1 || strlen($name) > 255) {
            $data['error'] = 'name-invalid';
            sendError('category-form', $data);
        }

        $category = new CategoryModel();

        if (!$category->save(['id' => $id, 'name' => $name])) {
            throw new PDOException;
        }

        sendMessage(
            'categories',
            'success',
            !$id ? 'Категория была добавлена.' : 'Категория была изменена.'
        );
    } catch (PDOException $e) {
        displayDbError();
    }
} else {
    header('Location: /403');
}
