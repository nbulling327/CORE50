<?php
echo ini_get('file_uploads');
echo ini_get('upload_max_filesize');
ini_set('upload_max_filesize', '10M');
phpinfo();
echo ini_get('upload_max_filesize');
$target_dir="uploads/";
$target_file=$target_dir. basename($_FILES["fileToUpload"]["name"]);
echo $target_file;

var_dump($_FILES);

$uploadOk=1;
if(isset($_POST["submit"]))
{
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        echo "File is an image - ". $check["mine"] . ".";
        $uploadOk = 0;
    }
    else
    {
        echo "File is not an image.";
        $uploadOk=1;
    }
}
if (file_exists($target_file))
{
    echo "Sorry, file already exists.";
    $uploadOk=0;
}
if ($_FILES["fileToUpload"]["size"] > 7000000)
{
    echo "Sorry, file is too large.";
    $uploadOk=0;
}
echo "file size is " . $_FILES["fileToUpload"]["size"]. "!!";
//if($imageFileType != "csv")
//{
//    echo "Sorry - only csvs are allowed.";
//    $uploadOk=0;
//}
if($uploadOk == 0)
{
    echo "Your upload failed.";
}
else
{
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file))
    {
        echo "The file ". basename($_Files["fileToUpload"]["name"]). " has been uploaded.";
    }
    else
    {
        echo "File upload failed.";   
    }
}
?>
