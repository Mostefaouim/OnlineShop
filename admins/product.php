<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Css/style.css">
    <title>Product</title>
        <style>
        h3{
            margin-top: 40px;
        }
        .card{
            float: right;
            margin-top: 20px;
            margin-left: 10px;
            margin-right: 10px;
            width: 30%;
        }
        .card img{
            width: 100%;
            height: 160px;
            margin-top: 5px;
        }
        main{
            width: 50%;
        }
        a{
            text-decoration: none;

        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php" style="margin-left: 50px;">Add Product</a>
    </nav>
    <center>
        <h3>All Product</h3>
    </center>
<?php
include 'config.php';
$result = mysqli_query($conn,"SELECT * FROM prod");
while($row = mysqli_fetch_array($result)){
    ?>
        <center>
        <main>
            <div class='card'>
                <img src='<?php echo $row["image"]; ?>' class='card-img-top'>
                <div class='card-body'>
                    <h5 class='card-title'><?php echo $row["name"]; ?></h5>
                    <p class='card-text'><?php echo $row["price"]; ?> $</p>
                    <a href='delete.php?id=<?php echo $row["id"]; ?>' class='btn btn-danger'>Delete</a>
                    <a href='modify.php?id=<?php echo $row["id"]; }?>' class='btn btn-primary'>Modify</a>
                </div>
            </div>
        </main>
    </center>
</body>
</html>