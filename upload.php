<?php
$target_dir = getcwd()."/uploadedFile/";
//$target_dir = "/uploadedFile/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileExt= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$fileName = pathinfo($target_file,PATHINFO_FILENAME);

// Check file
if(isset($_POST["submit"])) {
  $check = filesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is a " . $fileExt . " type.";
    $uploadOk = 1;
  } else {
    echo "File is not a pdf.";
    $uploadOk = 0;
  }
}

// Allow certain file formats
if($fileExt != "pdf") {
  echo "\n\nSorry, pdf file are allowed";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "\n\nSorry, your file was not uploaded.";
  
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "\n\nThe file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        //record the file name in txt file
        $txt = fopen(getcwd() . "/fileName.txt", "w");
        fwrite($txt, $fileName);
      
      //Exec java in shell
//         $command = "java -jar out/artifacts/JavaFile/JavaPdfTxt.jar";
//         echo shell_exec($command);
        

    } else {
        echo "\n\nSorry, there was an error uploading your file.";
        echo "\n " . $_FILES["fileToUpload"]["error"];
    }
}
?>
