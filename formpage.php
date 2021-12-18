<?php


    include("config/db_connect.php");


    $firstname=$lastname=$phoneNo=$DoB=$email=$addres=$fileDestination="";

    $errors = array("firstname"=>"", "lastname" =>"", "phoneNo" =>"", "DoB"=>"", "email"=>"", "addres"=>"","images"=>"");

    

    if(isset($_POST["upload"])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phoneNo = $_POST['phoneNo'];
        $email = $_POST["email"];
        $addres = $_POST['addres'];
        $DoB= $_POST['DoB'];


        $file = $_FILES["file"];
        $fileName = $_FILES["file"]["name"];
        $fileTmpName = $_FILES["file"]["tmp_name"];
        $fileSize = $_FILES["file"]["size"];
        $fileError = $_FILES["file"]["error"];
        $fileType = $_FILES["file"]["type"];
        

        $fileExt = explode ('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array ('jpg','jpeg','png');


        if (in_array($fileActualExt, $allowed)){
            if($fileError===0){
                if ($fileSize < 500000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $fileDestination = 'uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                }   else {$errors["images"]='your file is too big';}
            }   else { $errors["images"]='There was an error uploading your file';}
        }   else{ $errors["images"]= 'File type not allowed!';}
    
        
    }

    if(isset($_POST["submit"])){

        if (empty ($_POST["firstname"])){
            $errors["firstname"]= 'Please input your firstname <br />';
        }   else {
            $firstname = $_POST['firstname'];
            if(!preg_match("/^[a-zA-Z\s]+$/",$firstname)){
                $errors["firstname"]= "firstname must be letters";
                }
            }


        if (empty ($_POST["lastname"])){
            $errors["lastname"]= 'Please input your lastname <br />';
        }   else {
            $lastname = $_POST['lastname'];
            if(!preg_match("/^[a-zA-Z\s]+$/",$lastname)){
                $errors["lastname"]= "lastname must be letters";
                }
            }

        if (empty ($_POST["phoneNo"])){
            $errors["phoneNo"]= 'Please input your phone no <br />';
        }   else {
            $phoneNo = $_POST['phoneNo'];
            if (!preg_match("/^\d+$/", $phoneNo)) {
                $errors["phoneNo"]= "invalid phone Number";
                }
            }


        if (empty ($_POST["DoB"])){
            $errors["DoB"]= 'Please input your DoB <br />';
        }   else {
            $DoB= $_POST['DoB'];}

    
        if (empty($_POST["email"])){
            $errors["email"] = 'An email is required <br />';
        }   else {
            $email = $_POST["email"];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors["email"] = "email must be a valid email address";
              }
            }


        if (empty ($_POST["addres"])){
            $errors["addres"] = 'atleast one place is required <br />';
        }   else {
            $addres = $_POST['addres'];
            if(!preg_match("/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/", $addres)){
                $errors["addres"] = "address must be a comma seperated list";
                }
            }
    

        if(array_filter($errors)){
            print_r($errors);
        }   else{
            
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastname= mysqli_real_escape_string($conn, $_POST['lastname']);
            $phoneNo = mysqli_real_escape_string($conn, $_POST['phoneNo']);
            $DoB = mysqli_real_escape_string($conn, $_POST['DoB']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $addres = mysqli_real_escape_string($conn, $_POST['addres']);
            $profilepics = mysqli_real_escape_string($conn, $_POST['location']);

            //create sql
            $sql = "INSERT INTO dataforms(firstname,lastname,phoneNo,DoB,email,address,profilepics) VALUES('$firstname', '$lastname', '$phoneNo','$DoB','$email', '$addres', '$profilepics' )";

            if(mysqli_query($conn, $sql)){
                header("location: alldata.php");
            }   else {
                echo 'query error:'.mysqli_error($conn);
            }
        
        }
    }
    
    
    

?>








<!DOCTYPE html>
<html lang="en">

    <?php  include('templates/header.php'); ?>

    <section class="container">
        <h4 class="text-center my-3">Bio Data Registration page</h4>

        <form action="formpage.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-md-6 mb-3 form-group">
                    <div class="input-group">
                        <span class="input-group-prepend input-group-text">Firstname</span>
                        <input type="text" class="form-control" name="firstname" value="<?php echo htmlspecialchars($firstname) ?>">
                    </div>
                    <div class="text-danger mb-3"> <?php echo $errors["firstname"]; ?> </div>
                </div>

                <div class="col-md-6 mb-3 form-group">
                    <div class="input-group">
                        <span class="input-group-prepend input-group-text">Lastname</span>
                        <input type="text" class="form-control" name="lastname" value="<?php echo htmlspecialchars($lastname) ?>">
                    </div>
                    <div class="text-danger mb-3"> <?php echo $errors["lastname"]; ?> </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <div class="input-group">
                        <span class="input-group-prepend input-group-text">Phone Number</span>
                        <input class="form-control" type="tel" name="phoneNo" value="<?php echo htmlspecialchars($phoneNo) ?>" >
                    </div>
                    <div class="text-danger mb-3"> <?php echo $errors["phoneNo"]; ?> </div>
                </div>

                <div class="form-group mb-3 col-md-5">
                    <div class="input-group">
                        <span class="input-group-prepend input-group-text">DoB</span>
                        <input class="form-control" type="date" name="DoB" value="<?php echo htmlspecialchars($DoB) ?>" >
                    </div>
                    <div class="text-danger mb-3"> <?php echo $errors["DoB"]; ?> </div>
                </div>
                
            </div>
        
            <div class="input-group">
                <span class="input-group-prepend input-group-text">Email</span>
                <input class="form-control " type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
                
            </div>
            <div class="text-danger mb-3"> <?php echo $errors["email"]; ?> </div>

            
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Address</span>
                </div>
                <input class="form-control" name="addres" value="<?php echo htmlspecialchars($addres) ?>">
            </div> 
            <div class="text-danger mb-3"> <?php echo $errors["addres"]; ?></div>
            
            <div class="row">
                <div class="col col-6">
                    <input  type="file" name="file" value="<?php echo $fileDestination; ?>"><br><br>
                    <button  class=" btn btn-secondary" type="submit" name="upload">Upload </button>
                </div>
                <div class="col col-6">
                    <input class="d-none" type="text" name="location" value="<?php echo $fileDestination; ?>">
                    <img src="<?php echo $fileDestination; ?>"alt="Profile Picture" style="width:150px;height:auto;">
                </div>
            </div>
            <div class="text-danger mb-3"> <?php echo $errors["images"]; ?></div>

            <div class="form-group row text-center">
                <div class="col-sm-12">
                <button name="submit" type="submit" class="btn btn-outline-secondary mb-3">Submit</button>
                </div>
            </div>


        
        </form>

    </section>    

   

    <?php include('templates/footer.php'); ?>


    
</html>