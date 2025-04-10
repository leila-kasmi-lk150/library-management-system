<?php
include('../../../../private/conn.php');

        
if(isset($_POST['add']))
{
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pw = $_POST['pw'];
    $dateBirth = $_POST['dateBirth'];
    $placeBirth = $_POST['placeBirth'];
    $adress = $_POST['adress'];
    $codeUser = $_POST['codeUser'];
    $speciality = $_POST['speciality'];
    $level = $_POST['level'];

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];
       
    

    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
    $img_upload_path = 'uploadsMember/'.$new_img_name;
    move_uploaded_file($tmp_name,$img_upload_path);
    
    $query = "INSERT INTO users(passWord, email, firstName, lastName, dateOfBirth, PlaceOfBirth, phone, adress, codeUser, specialty, level, imageUser) VALUES('$pw', '$email', '$firstName', '$lastName', '$dateBirth', '$placeBirth', '$phone', '$adress', '$codeUser', '$speciality', '$level', '$new_img_name' )";
    $query_run = mysqli_query($conn, $query);

                    if($query_run)
                    {
                       

                        header("Location: ../addMember.php?success=The Member has been added");
                        exit();
                    }
                    else
                    {
                        header("Location: ../addMember.php?error=Error");
                        exit();
                    }
                
                
        }