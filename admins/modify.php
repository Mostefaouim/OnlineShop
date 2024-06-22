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
    include 'config.php';
    $ID = $_GET['id'];
    $update = mysqli_query($conn, "SELECT * FROM prod WHERE id = $ID");
    $data = mysqli_fetch_array($update);    
    ?>
    <center><div class="col" style="margin-top: 70px;" >
        <h2>Update Products</h2>
        <form  method="post" action="up.php" enctype="multipart/form-data">
            <input type="text" class="form-control" name="id" value="<?php echo $data['id']?>" style="display:none;"><br>
            <input type="text" class="form-control" name="name" value="<?php echo $data['name']?>"><br>
            <input type="number" class="form-control" name="price" value="<?php echo $data['price']?>">
            <input type="file" name="image" id="image" style="display: none;">
            <label for="image" id="image"  class="btn btn-primary">Update Image Of Product</label>
            <input type="submit" class="btn btn-success" value="Update Product" name="update"style="margin-top: 20px">
        </form>
    </div></center>
</body>
</html>