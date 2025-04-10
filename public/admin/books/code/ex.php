<?php
include('../../../../private/conn.php');

if (isset($_POST['edit'])) {

    $img= $_POST['img'];
    if (!empty($_FILES['my_image']['name'])) {
        
        unlink('uploadsBook/'.$img);
        echo "good";

             }else {
               echo "empity";
            }
        }
    // }


    

// }