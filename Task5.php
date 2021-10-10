<?php

include 'validation.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    /* Validate uploaded file */
    function validateFile(){
        if(!empty($_FILES['file']['name'])){
            $file_tmp = $_FILES['file']['tmp_name']; // temporary path
            $file_name = $_FILES['file']['name']; // name
            $file_type = $_FILES['file']['type']; // ex: img/png
    
            $allowed = ['pdf', 'docx']; // Allowed Extension
            $fileExtension = explode('/', $file_type); // extract the extension type from the uploaded file
    
                // Check if uploaded extension is allowed
                if(in_array($fileExtension[1],$allowed)){
                    global $finalName;
                    $finalName = 'random'.rand(1,50).'time'.time().'.'.$fileExtension[1]; // to not repeat name
                    $finalPath = './uploaded/'.$finalName;
                    move_uploaded_file($file_tmp, $finalPath); // (temporary path , final path)
                }
                else{
                    echo 'Not a valid CV extension, only PDF and DOCX are accepted!'.'<br>';
                }
          }else{
              echo 'CV is required!'.'<br>';
          }
    }

    /* Get user info */
    $name     =  $_POST['name']; 
    $password =  $_POST['password'];
    $email    =  $_POST['email'];
    $address  =  $_POST['address'];
    $gender   =  $_POST['gender'] ?? "Unkown";
    $url      =  $_POST['url'];

    /* Validate user info */
    validate($name, 'name');
    validate($password, 'password');
    validate($email, 'email');
    validate($address, 'address');
    validate($gender, 'gender');
    validate($url, 'url');
    validateFile();

    /* Write user info into txt */
    $userInfo = [$name, $password, $email, $address, $gender, $url, $finalName];
    $infoString = implode(',', $userInfo)."\n";

    $file = fopen('info.txt', 'a') or die ('unable to open required file!'.'<br>');
    fwrite($file, $infoString);
    fclose($file);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="container">

    <form action="<?php echo $_SERVER['PHP_SELF'];?>"  method="post"  enctype ="multipart/form-data">

     <div class="form-group">
        <label for="exampleInputName1">Name</label>
        <input type="text" name = "name" class="form-control mb-3" id="exampleInputName1" aria-describedby="nameHelp" placeholder="Enter name">
     </div>


     <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" name = "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
     </div>


     <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" name = "password" class="form-control" id="exampleInputPassword1" placeholder="Password">
     </div>


     <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" name = 'address' id="inputAddress" placeholder="1234 Main St">
     </div>


     <div class="form-group">
        <label>Gender</label>
        <label class="radio-inline"> <input type="radio"  name="gender" value='female'> Female</label>
        <label class="radio-inline"><input type="radio" name="gender" vlaue='male'> Male</label>
     </div>


     <div class="form-group">
        <label for="exampleInputURL1">Linkedin URL</label>
        <input type="url" name = "url" class="form-control mb-3" id="exampleInputURL1" aria-describedby="urlHelp" placeholder="Enter url" >
     </div>


     <div class="form-group">
     <label for="upload">CV</label>
     <input type="file" class="form-control" name = 'file' id="upload" placeholder="browse file">
     </div>

     <button type="submit" class="btn btn-primary">Submit</button>

    </form>
  </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>