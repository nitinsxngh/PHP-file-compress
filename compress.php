<?php

     if(isset($_FILES["file"]["type"]))
     {


        $validextensions = array("jpeg", "jpg", "png"); // Only extension to be used
        $temporary = explode(".", $_FILES["file"]["name"]); // Exploding the extension
        $file_extension = end($temporary); // file extension name

         if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg") // if file type = extension 
         ) && ($_FILES["file"]["size"] < 800000000)//Approx. 1000kb files can be uploaded.
           && in_array($file_extension, $validextensions)) {

         if ($_FILES["file"]["error"] > 0)
         {
          echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
         } else {

                $sourcePath = explode(".", $_FILES["file"]["name"]);
                $newfilename = round(microtime(true)) . '.' . end($sourcePath);
                move_uploaded_file($_FILES["file"]["tmp_name"], "../../../../user/data/profile/" . $newfilename);

//-------------------------------//

        $ext = pathinfo($newfilename, PATHINFO_EXTENSION);
        function gen_uid($l=5){
          return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 10, $l);
        }
        $compressFileName = gen_uid(30);

        $source = ("../../../../user/data/profile/".$newfilename);

        // Create a new image from file 
        switch($ext){ 
          case 'jpeg': 
             $image = imagecreatefromjpeg($source); 
             break; 
          case 'png': 
             $image = imagecreatefrompng($source); 
             break; 
          case 'gif': 
             $image = imagecreatefromgif($source); 
             break; 
          default: 
             $image = imagecreatefromjpeg($source); 
        } 


        imagejpeg($image,"../../../../user/data/compressed-profile-1/".$compressFileName.'.'.$ext,10);



//--------------------------------//
// Insert into database
//--------------------------------//

              }
        } else {
           echo "<span id='invalid'>***Invalid file Size or Type***<span>";
        }
    }

 ?>
