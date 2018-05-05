<?php
$uploadOk = 1;
// $uploads_dir = "uploads/";

$file_name = preg_replace( 
    array("/\s+/", "/[^-\.\w]+/"), 
    array("_", ""), 
    trim($_FILES['file']['name'])
);

$imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["file"]["tmp_name"]);

if($check !== false) {
    // file is a valid image
    $uploadOk = 1;
} else {
    // File is not an image
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > (int)$_POST["filesize"]) {
    $uploadOk = 0;
    die("Sorry, your file is too large.");
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {

    die("Sorry, your file was not uploaded.");

} else {

    // if everything is ok, try to upload file
    $tmp_name = $_FILES["file"]["tmp_name"];

    // basename() may prevent filesystem traversal attacks
    $movefile = move_uploaded_file($tmp_name, "./tempfile.tmp");

    if ($movefile) {

        // The file has been uploaded successfully
        chmod("./tempfile.tmp", 0644);

        $tempfile = fopen("./tempfile.tmp", "rb");

        $size = $_FILES['file']['size'];

        $data = fread($tempfile, $size);

        fclose($tempfile);

        unlink("./tempfile.tmp");

        $data = base64_encode($data);

        echo $data;

    } else {

        echo "Sorry, there was an error uploading your file.";
        // print_r(error_get_last());
    }
}
?>
