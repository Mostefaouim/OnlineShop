<?php
    include 'config.php';
    require_once 'vendor/autoload.php'; // Include Composer autoloader

    use Supabase\Storage\StorageClient;

    // Create a Supabase storage client
    $storage = new StorageClient(
        $supabaseUrl . '/storage/v1',
        [
            'apiKey' => $supabaseKey,
            'Authorization' => 'Bearer ' . $supabaseKey
        ]
    );

    // Define bucket name for products
    $bucketName = 'shopnest';

    if (isset($_POST['update'])) {
        $ID = $_POST['id'];
        $NAME = $_POST['name'];
        $PRICE = $_POST['price'];
        $IMAGE = $_FILES['image'];
        
        if (empty($NAME) || empty($PRICE)) {
            echo "
                <center>
                <div class='alert alert-danger' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                   You Have a Problem.
                </div>
                </center>";
        } else {
            // If a new image was uploaded
            if (!empty($IMAGE['name'])) {
                $image_location = $IMAGE['tmp_name'];
                
                try {
                    $image_name = time() . '_' . $IMAGE['name'];
                    
                    $file = fopen($image_location, 'r');
                    $mime_type = mime_content_type($image_location);
                    $result = $storage->from($bucketName)->upload($image_name, $file, ['contentType' => $mime_type]);
                    fclose($file);

                    $image_url = $supabaseUrl . '/storage/v1/object/' . $bucketName . '/' . $image_name;
                    
                    // Find the old image URL to potentially delete it later
                    $result = mysqli_query($conn, "SELECT image FROM prod WHERE id = $ID");
                    $row = mysqli_fetch_assoc($result);
                    $old_image_url = $row['image'];
                    
                    // Update database with new image URL
                    $UPDATE = "UPDATE prod SET name='$NAME', price='$PRICE', image='$image_url' WHERE id=$ID";
                    mysqli_query($conn, $UPDATE) or die(mysqli_error($conn));
                    
                    // If the old image is from Supabase, we can delete it to save space
                    if (strpos($old_image_url, $supabaseUrl) === 0) {
                        // Extract the filename from the URL
                        $old_filename = basename(parse_url($old_image_url, PHP_URL_PATH));
                        try {
                            // Delete the old file
                            $storage->from($bucketName)->remove([$old_filename]);
                        } catch (Exception $e) {
                            // Just log the error, don't stop the update process
                            error_log("Failed to delete old image: " . $e->getMessage());
                        }
                    }
                    
                    echo "
                        <center>
                        <div class='alert alert-success' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                            Product Updated Successfully
                        </div>
                        </center>";
                } catch (Exception $e) {
                    echo "
                        <center>
                        <div class='alert alert-danger' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                            Failed to upload image: " . $e->getMessage() . "
                        </div>
                        </center>";
                }
            } else {
                // No new image, just update name and price
                $UPDATE = "UPDATE prod SET name='$NAME', price='$PRICE' WHERE id=$ID";
                mysqli_query($conn, $UPDATE) or die(mysqli_error($conn));
                
                echo "
                    <center>
                    <div class='alert alert-success' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                        Product Updated Successfully
                    </div>
                    </center>";
            }
        }

        header("location: index.php");
        exit;
    }
    
    // Get the product data for the form
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM prod WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
?>
