<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title></title>
    <link rel="stylesheet" href="../Css/style.css">

</head>
<body>
    <?php
        if (isset($_POST['add'])) {
            $NAME = $_POST['name'];
            $PRICE = $_POST['price'];
            $IMAGE = $_FILES['image'];
            $image_location = $_FILES['image']['tmp_name'];
            $image_name = $_FILES['image']['name'];
            $image_up = "../image/" . $image_name;
            
            if (empty($NAME) || empty($PRICE)) {
                echo "
                    <center>
                    <div class='alert alert-danger' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                        Please Check Your Information
                    </div>
                    </center>";
            } else {
                // Data Base
                include 'config.php';
                // Move the uploaded file to the desired location
                if (move_uploaded_file($image_location, $image_up)) {
                    mysqli_query($conn, "INSERT INTO prod(name, price, image) VALUES('$NAME','$PRICE','$image_up')");
                    echo "
                        <center>
                        <div class='alert alert-success' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                            Product Added Successfully
                        </div>
                        </center>";
                } else {
                    echo "
                        <center>
                        <div class='alert alert-danger' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                            Failed to upload image
                        </div>
                        </center>";
                }
            }
        }
    ?>
    <center>
        <div class="col" >
            <h2>Admin Dashbord</h2>
            <img src="ecommerce.webp" alt="logo" width="250px" id="logo">
            <form  method="post" action="index.php" enctype="multipart/form-data">
                <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name"><br>
                <input type="number" class="form-control" placeholder="Price" aria-label="Price" name="price">
                <input type="file" name="image" id="image" style="display: none;">
                <label for="image" id="image" class="btn btn-secondary" style="margin-top: 20px;">Insert Image Of Product</label>
                <input type="submit" class="btn btn-primary" value="Add Product" name="add"
                style="margin-top: 30px">
                <br>
                <button class="btn btn-info" style="margin-top: 20px;"><a href="product.php">See All Product</a></button>
            </form>
        </div>
    </center>
</body>
</html>
