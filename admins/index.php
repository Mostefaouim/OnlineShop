<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Css/style.css">
</head>
<body>
    <?php
        require_once 'config.php';
        require_once 'vendor/autoload.php';

        use Supabase\Storage\StorageClient;
        use Supabase\Storage\StorageFile;

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

        // Check if the bucket exists, if not create it
        try {
            $storage->getBucket($bucketName);
        } catch (Exception $e) {
            try {
                $storage->createBucket($bucketName, ['public' => false]);
            } catch (Exception $e) {
                ?>
                <center>
                <div class='alert alert-danger' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                    Failed to initialize storage: " . $e->getMessage() . "
                </div>
                </center>
                <?php
            }
        }

        if (isset($_POST['add'])) {
            $NAME = $_POST['name'];
            $PRICE = $_POST['price'];
            $IMAGE = $_FILES['image'];
            
            if (empty($NAME) || empty($PRICE) || empty($IMAGE['name'])) {
                ?>
                    <center>
                    <div class='alert alert-danger' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                        Please Check Your Information
                    </div>
                    </center>
                <?php
            } else {
                // Generate a unique filename to avoid collisions
                $image_name = time() . '_' . $IMAGE['name'];
                $image_location = $IMAGE['tmp_name'];
                
                try {
                    // Upload the file to Supabase storage
                    $file = fopen($image_location, 'r');
                    $mime_type = mime_content_type($image_location);
                    $result = $storage->from($bucketName)->upload($image_name, $file, $mime_type);
                    fclose($file);
                    
                    // Get the public URL of the uploaded file
                    $image_url = $supabaseUrl . '/storage/v1/object/' . $bucketName . '/' . $image_name;
                    
                    // Insert data into database with Supabase image URL
                    mysqli_query($conn, "INSERT INTO prod(name, price, image) VALUES('$NAME','$PRICE','$image_url')");
                    
                   ?>
                        <center>
                        <div class='alert alert-success' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                            Product Added Successfully
                        </div>
                        </center>
                    <?php
                } catch (Exception $e) {
                    ?>
                        <center>
                        <div class='alert alert-danger' role='alert' style='width: 50%; height: 50%; margin-top:10px'>
                            Failed to upload image: " . $e->getMessage() . "
                        </div>
                        </center>
                        <?php
                }
            }
        }
    ?>
    <center>
        <div class="col" >
            <h2>Admin Dashboard</h2>
            <img src="https://eattnoxdvsftpyaztuxd.supabase.co/storage/v1/object/sign/shopnest/ecommerce.webp?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCIsImtpZCI6InN0b3JhZ2UtdXJsLXNpZ25pbmcta2V5XzU5NGM4Zjk4LTVlNWMtNDJhNC1iODlmLWY2OWQ0ZTZiYmI4NSJ9.eyJ1cmwiOiJzaG9wbmVzdC9lY29tbWVyY2Uud2VicCIsImlhdCI6MTc0Njg5NTMwNywiZXhwIjoyMDYyMjU1MzA3fQ.WYPy7nDW4gRsU8Ejznn3GASpl4iFaHdqEhktqGW9gf8" alt="logo" width="250px" id="logo">
            <form method="post" action="index.php" enctype="multipart/form-data">
                <input type="text" class="form-control" placeholder="Name" aria-label="Name" name="name"><br>
                <input type="number" class="form-control" placeholder="Price" aria-label="Price" name="price">
                <input type="file" name="image" id="image" style="display: none;">
                <label for="image" class="btn btn-secondary" style="margin-top: 20px;">Insert Image Of Product</label>
                <input type="submit" class="btn btn-primary" value="Add Product" name="add"
                style="margin-top: 30px">
                <br>
                <button class="btn btn-info" style="margin-top: 20px;"><a href="product.php">See All Product</a></button>
            </form>
        </div>
    </center>
</body>
</html>