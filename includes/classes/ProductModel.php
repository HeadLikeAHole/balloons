<?php

include_once 'Model.php';

class ProductException extends Exception { }

class ProductModel extends Model
{
    protected $_tableName = 'products';

    protected $id;
    protected $user_id;
    protected $category_id;
    protected $title;
    protected $description;
    protected $image_name;

    private $_uploadedFilePath;

    public function __construct($id, $user_id, $category_id, $title, $description, $image_name)
    {
        parent::__construct();

        $this->setId($id);
        $this->setUserId($user_id);
        $this->setCategoryId($category_id);
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setImageName($image_name);

        $this->_uploadedFilePath = "../images/$this->image_name";
    }

    public function setId($id)
    {
        if ($id !== null && (!is_numeric($id) || $id <= 0 || $id > 2147483647)) {
            throw new ProductException('invalid-product-id');
        }

        $this->user_id = $id;
    }

    public function setUserId($user_id)
    {
        if ($user_id !== null && (!is_numeric($user_id) || $user_id <= 0 || $user_id > 2147483647)) {
            throw new ProductException('invalid-user-id');
        }

        $this->user_id = $user_id;
    }

    public function setCategoryId($category_id)
    {
        if ($category_id !== null && (!is_numeric($category_id) || $category_id <= 0 || $category_id > 2147483647)) {
            throw new ProductException('invalid-category-id');
        }

        $this->category_id = $category_id;
    }

    public function setTitle($title)
    {
        if (strlen($title) < 1 || strlen($title) > 255) {
            throw new ProductException('invalid-title');
        }

        $this->title = $title;
    }

    public function setDescription($description)
    {
        if (strlen($description) < 1 || strlen($description  > 65535)) {
            throw new ProductException('invalid-description');
        }

        $this->description = $description;
    }

    public function setImageName($image_name)
    {
        if (strlen($image_name) < 1 || strlen($image_name) > 50) {
            throw new ProductException('invalid-image-name');
        }

        if (preg_match('/^[a-zA-Z0-9\s_-]+\.(jpg|jpeg|png|gif)$/', $image_name) != 1) {
            throw new ProductException('invalid-image-extension');
        }

        $this->image_name = $image_name;
    }

    public function saveImageFile($imageTmpName)
    {
        if (!file_exists($imageTmpName)) {
            throw new ProductException('failure-to-upload');
        }

        if (!move_uploaded_file($imageTmpName, $this->_uploadedFilePath)) {
            throw new ProductException('failure-to-upload');
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImageName()
    {
        return $this->image_name;
    }
}