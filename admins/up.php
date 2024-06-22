<?php
    include 'config.php';
    if (isset($_POST['update'])) {
        $ID = $_POST['id'];
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
                   You Have a Problem.
                </div>
                </center>";
        } else {
            if ($image_name) {
                // Move the uploaded file to the desired location
                if (move_uploaded_file($image_location, $image_up)) {
                    // Data Base
                    $UPDATE = "UPDATE prod SET name='$NAME', price='$PRICE', image='$image_up' WHERE id=$ID";
                    echo "
                        <center>
                        <div class='alert alert-success' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                            Product Updated Successfully
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
            } else {
                $UPDATE = "UPDATE prod SET name='$NAME', price='$PRICE' WHERE id=$ID";
            }

            mysqli_query($conn, $UPDATE) or die(mysqli_error($conn));
        }

        header("location: index.php");
        exit;
    }
?>
