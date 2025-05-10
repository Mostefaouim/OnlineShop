<?php

include '../admins/config.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
    exit();
}

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'The Product Has Already Been Added To The Shopping Cart!';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
        $message[] = 'Add a Product To Your Shopping Cart!';
    }
}

if (isset($_POST['update_cart'])) {
    $update_quantity = $_POST['cart_quantity'];
    $update_id = $_POST['cart_id'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
    $message[] = 'Benga Shopping Cart Quantity Has Been Updated!';
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
    header('location:index.php');
    exit();
}

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopora</title>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../css/index.css">

</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
    }
}
?>

<div class="container">

<center><div class="user-profile">

    <?php
    $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
    if (mysqli_num_rows($select_user) > 0) {
        $fetch_user = mysqli_fetch_assoc($select_user);
    } else {
        $fetch_user = null;
    }
    ?>
<center>
    <p>User : <span><?php echo $fetch_user ? $fetch_user['name'] : 'Indefind'; ?></span> </p>
    <div class="flex">
        <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Do Ypu Want To Logout');" class="delete-btn">Log Out</a>
    </div></center>

</div></center>

<div class="products">

    <h1 class="heading">Latest Products</h1>

    <div class="box-container">

    <?php
    $result = mysqli_query($conn, "SELECT * FROM prod");
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <form method="post" class="box" action="">
            <img src="<?php echo $row['image']; ?>" width="200">
            <div class="name"><?php echo $row['name']; ?></div>
            <div class="price"><?php echo $row['price'] . " $"; ?></div>
            <input type="number" min="1" name="product_quantity" value="1">
            <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
        </form>
    <?php
    }
    ?>

    </div>

</div>

<div class="shopping-cart">

    <h1 class="heading">My Card</h1>

    <table>
        <thead>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Count</th>
            <th>Total Price</th>
            <th>Action</th>
        </thead>
        <tbody>
        <?php
        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $grand_total = 0;
        if (mysqli_num_rows($cart_query) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
        ?>
            <tr>
                <td><img src="<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
                <td><?php echo $fetch_cart['name']; ?></td>
                <td><?php echo $fetch_cart['price']; ?>$ </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                        <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                        <input type="submit" name="update_cart" value="Update" class="option-btn">
                    </form>
                </td>
                <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>$</td>
                <td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('Delete Product');">Delete</a></td>
            </tr>
        <?php
                $grand_total += $sub_total;
            }
        } else {
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">The Card Has Empty</td></tr>';
        }
        ?>
        <tr class="table-bottom">
            <td colspan="4">Total Price:</td>
            <td><?php echo $grand_total; ?>$</td>
            <td><a href="index.php?delete_all" onclick="return confirm('Delete All');" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Delete All</a></td>
        </tr>
        </tbody>
    </table>

</div>

</div>

</body>
</html>