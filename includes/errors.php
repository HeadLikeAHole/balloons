<?php

$errors = [
    'username-empty' => 'Укажите логин.',
    'password-empty' => 'Укажите пароль.',
    'username-wrong' => 'Логин не существует.',
    'password-wrong' => 'Неверный пароль.',
    'productidinvalid' => 'Неверный ID товара.',
    'useridinvalid' => 'Неверный ID пользователя.',
    'categoryidinvalid' => 'Неверный ID категории.',
    'title-invalid' => 'Название должно содержать от 1 до 255 символов.',
    'description-invalid' => 'Описание должно содержать от 1 до 65535 символов.',
    'image-not-selected' => 'Убедитесь, что Вы выбрали изображение.',
    'image-too-large' => 'Размер изображения не должен превышать 5МБ.',
    'image-name-invalid' => 'Название файла должно содержать от 1 до 50 символов (A-Z, a-z, 0-9, -, _, "пробел").',
    'image-extension-invalid' => 'Изображение должно быть одним из следующих форматов: jpg, jpeg, png, gif.',
    'image-name-exists' => 'Файл с таким именем уже существует.',
    'image-upload-failure' => 'Неудалось загрузить файл.',
    'image-rename-failure' => 'Неудалось переименовать изображение.',
    'image-delete-failure' => 'Неудалось удалить изображение.'
];

function displayDbError()
{
    echo '    
        <div style="text-align: center;">
            <h1 style="color: red;">Ошибка базы данных.</h3>
        </div>
    ';
    exit;
}