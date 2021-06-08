<?php

include_once 'Model.php';

class ProductModel extends Model
{
    protected $tableName = 'products';

    public function getImageUrl()
    {
        $httpsOrHttp = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $url = "/images/$this->image_name";

        return $httpsOrHttp . '://' . $host . $url;
    }
}