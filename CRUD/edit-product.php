<?php
include('inc/header.php');
include('core/functions.php');
include('database/conn.php');
include('inc/nav.php');
?>

<?php 
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM `products`  WHERE `id` = '$id' ";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        
        if(!$row){
            $errors = "Product Not Exists !";
            sessionStore('errors', $errors);
            redirectPath("products.php");
            die;
        }
    }
?>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="p-3 col text-center mt-5 text-white bg-primary"> Edit Product </h2>
            </div>


            <div class="col-sm-12">
                <?php
                    if (isset($_SESSION['errors'])) :
                        foreach ($_SESSION['errors'] as $error) : ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $error; ?>
                            </div>
                    <?php
                        endforeach;
                        sessionRemove('errors');
                    endif;
                ?>

                <?php
                    if (isset($_SESSION['success'])) :
                        foreach ($_SESSION['success'] as $success) : ?>
                            <div class="alert alert-success text-center">
                                <?php 
                                    echo $success;
                                    header("refresh:1;url=products.php"); 
                                ?>
                            </div>
                    <?php
                        endforeach;
                        sessionRemove('success');
                    endif;
                ?>
            </div>

            <div class="col-sm-12">
                <form method="post" action="handlers/editProductHandlers.php?id=<?php echo $row['id']; ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" id="name">
                    </div>

                    
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" id="price" value="<?php echo $row['price']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" name="description" value="<?php echo $row['description']; ?>" class="form-control" id="description">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        <img class="rounded mt-2" src="images/<?php echo $row['image']?>" alt="" style="width: 200px;">
                    </div>

                    <button type="submit" name="submit" class="btn btn-warning">Update</button>
                </form>
            </div>
        </div>
    </div>




<?php include('inc/footer.php'); ?>