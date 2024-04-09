<?php
session_start();
require_once '../core/functions.php';
require_once '../core/validations.php';
require_once '../database/conn.php';

$errors = [];
$success = [];

if (checkRequestMethod('POST')) {
    $name = sanitizeValue($_POST['name']);
    $description = sanitizeValue($_POST['description']);
    $file_name = $_FILES['image']['name'];
    $file_temp_name = $_FILES['image']['tmp_name'];
    $folder = '../images/' . $file_name ;
    

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

    // Validation For Image
    if (requireValue($file_name)) {
        $errors['image'] =  "Image is reqired";
    }

    if (empty($errors)) {
        $sql =  "INSERT INTO categories(`name`,`description`,`image`) 
                    VALUES('$name','$description','$file_name')";
        mysqli_query($conn, $sql);
        mysqli_close($conn);
        move_uploaded_file($file_temp_name, $folder);
        $success['success'] = "Category Added Successfully ";
        sessionStore('success', $success);
        redirectPath('../add-category.php');
    } else {
        sessionStore('errors', $errors);
        redirectPath('../add-category.php');
    }
}
