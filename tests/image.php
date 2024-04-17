<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="image.php"
    method="post"
    enctype="multipart/form-data">

    <input type="file" name="my_image">

    <input type="submit" name="submit" value="upload">
    </form>

    <?php
        if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
            echo"hello";

            $img_name = $_FILES['my_image']['name'];
            $img_size = $_FILES['my_image']['size'];
            $tmp_name = $_FILES['my_image']['tmp_name'];
            $error = $_FILES['my_image']['error'];

            if ($error ===0) {
                if ($img_size > 125000000) {
                    $em = "sorry file too large";
                    header("location:image.php");
                }else{
                    $img_ex = pathinfo($img_name, );
        }else {
            $em = "not right type";
            header("location: image.php?error=$em");
        }
        }else {
            header("location:image.php");
        }
    ?>
</body>
</html>