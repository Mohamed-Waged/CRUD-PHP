<?php 
include('inc/header.php');  
include("database/conn.php") ;
include('inc/nav.php'); 

$sql = "SELECT * FROM  `products` ORDER BY id ASC";
$result = mysqli_query($conn, $sql);
?>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2 class="p-3 col text-center mt-5 text-white bg-primary"> All Products </h2>
        </div>

        <?php if (mysqli_num_rows($result)) : ?>
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Decription</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['id'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['price'];?> <strong>$</strong></td>
                                <td><?php echo $row['description'];?></td>
                                <td>
                                    <img src="images/<?php echo $row['image']?>" alt="" style="width: 100px; height: 100px;">
                                </td>
                                <td>
                                    <a href="edit-product.php?id=<?php echo $row['id'] ?>" class="text-primary">
                                        <i class="fa fa-pencil-square-o fa-2x"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="delete-product.php?id=<?php echo $row['id'] ?>" class="text-danger">
                                        <i class="fa fa-times fa-2x"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="col-sm-12">
                <h3 class="alert alert-danger mt-5 text-center"> No Products Found </h3>
            </div>
        <?php endif ; ?>
    </div>
</div>



<?php include('inc/footer.php'); ?>