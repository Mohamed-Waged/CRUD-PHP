<?php
session_start();
require_once '../core/functions.php';
require_once '../core/validations.php';
require_once '../database/conn.php';

$errors = [];
$success = [];


if (checkRequestMethod('POST')) {
    $name = sanitizeValue($_POST['name']);
    $price = $_POST['price'];
    $description = sanitizeValue($_POST['description']);
    $file_name = $_FILES['image']['name'];

    // Validation For Name  
    if (requireValue($name)) {
        $errors['name'] =  "Name is reqired";
    } elseif (minLength($name,3)) {
        $errors['name'] = "Name Must Be More Than  3 Letters ";
    } elseif (maxLength($name,15)) {
        $errors['name'] = "Name Must Be Less Than  15 Letters ";
    }

    // Validation For Description  
    if (requireValue($description)) {
        $errors['description'] =  "Description is reqired";
    }  elseif (minLength($description,10)) {
        $errors['description'] = "Description Must Be More Than  10 Letters ";
    } elseif (maxLength($description,30)) {
        $errors['description'] = "Description Must Be Less Than  30 Letters ";
    }

    

    if (empty($errors)) {
        if ($file_name != '') {
            $sql = "UPDATE products SET `name`='$name',`price`='$price',`description`='$description' ,`image`='$file_name'
                    WHERE `id`='$_GET[id]' ";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            $success['success'] = "Product Updated Successfully ";
            sessionStore('success', $success);
            redirectPath("../edit-category.php?id=$_GET[id]");
        }else{
                 // if image not update
                
            $sql = "SELECT * FROM  `products` WHERE `id`='$_GET[id]' ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        
            $sql = "UPDATE products SET `name`='$name',`price`='$price',`description`='$description' ,`image`='$row[image]'
                    WHERE `id`='$_GET[id]' ";
            mysqli_query($conn, $sql);
            mysqli_close($conn);
            $success['success'] = "Product Updated Successfully ";
            sessionStore('success', $success);
            redirectPath("../edit-category.php?id=$_GET[id]");
        }
    } else {
        sessionStore('errors', $errors);
        redirectPath("../edit-category.php?id=$_GET[id]");
    }
}

