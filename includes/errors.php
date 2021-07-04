<?php

$errors = [
    'username-empty' => 'Укажите логин.',
    'password-empty' => 'Укажите пароль.',
    'username-wrong' => 'Логин не существует.',
    'password-wrong' => 'Неверный пароль.',
    'title-invalid' => 'Название должно содержать от 1 до 255 символов.',
    'description-invalid' => 'Описание должно содержать от 1 до 65535 символов.',
    'image-not-selected' => 'Убедитесь, что Вы выбрали изображение.',
    'image-too-large' => 'Размер изображения не должен превышать 5МБ.',
    'image-name-invalid' => 'Название изображения должно содержать от 1 до 50 символов (A-Z, a-z, 0-9, -, _, "пробел").',
    'image-extension-invalid' => 'Изображение должно быть одним из следующих форматов: jpg, jpeg, png, gif.',
    'image-name-exists' => 'Изображение с таким именем уже существует.',
    'image-upload-failure' => 'Неудалось загрузить изображение.',
    'image-update-failure' => 'Неудалось обновить изображение.',
    'image-delete-failure' => 'Неудалось удалить изображение.',
    'name-invalid' => 'Название категории должно содержать от 1 до 255 символов.',
];

function displayDbError()
{
    echo '<h1 style="text-align: center; color: red;">Ошибка базы данных.</h3>';
    exit;
}