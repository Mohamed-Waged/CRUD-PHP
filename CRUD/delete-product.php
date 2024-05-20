<?php 
include('inc/header.php'); 
include('inc/nav.php'); 
include('core/functions.php'); 
include('database/conn.php'); 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `products`  WHERE `id` = '$id' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);

    if (!$row) {
        $errors = "Product Not Exists";
        sessionStore('errors', $errors);
    } else {
        $sql = "DELETE FROM `products`  WHERE `id` = '$id' ";
        $result = mysqli_query($conn, $sql);
        $success = "Product Deleted Succesfully";
        sessionStore('success', $success);
    }
    header("refresh:1;url=products.php"); 
}

?>

<?php if (isset($_GET['id']) && is_numeric($_GET['id']) && $row) :  ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="p-3 col text-center mt-5 text-white bg-primary">  Delete Product </h2>
            </div>

            <div class="col-sm-12">
                <h3 class="alert alert-success mt-5 text-center">
                    <?php echo $_SESSION['success']; ?>
                </h3>
            </div>
        </div>
    </div>

<?php else : ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-5 text-center"> Product ID Not Found </h3>
            </div>
        </div>
    </div>


<?php endif;  ?>

<?php include('inc/footer.php'); ?>