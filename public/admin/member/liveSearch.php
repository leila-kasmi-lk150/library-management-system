<?php 
    include "../../../private/conn.php";
    $input = $_POST['input'];
    if(!empty($input))
    {
        $query = "SELECT * FROM users WHERE userType!='admin' AND (firstName LIKE '%$input%' OR lastName LIKE '%$input%') ";
        $result = mysqli_query($conn, $query);
    }else{
        $query = "SELECT * FROM users WHERE userType!='admin'";
        $result = mysqli_query($conn, $query);
    }
    ?>
    <table class="table table-bordered table-striped table-hover" >
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">S.L</th>
                            <th class="text-center" scope="col">Name</th>
                            <th class="text-center" scope="col">EMAIL</th>
                            <th class="text-center" scope="col">SPECIALTY</th>
                            <th class="text-center" scope="col">ADRESS</th>
                            <th class="text-center" scope="col">View</th>
                            <th class="text-center" scope="col">Edit</th>
                            <th class="text-center" scope="col">Delete</th>
                        </tr>
                    </thead>

    <?php
    if (mysqli_num_rows($result) > 0 ) {
        $count = 1;
?>
         
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        
                        <tr>
                            <td class='text-center'><?php  echo $count; ?></td>
                            <td class='text-left'><?php echo $row["firstName"]; echo " "; echo $row["lastName"]; ?></td>
                            <td class='text-left'><?php echo $row['email']; ?></td>
                            <td class='text-left'><?php echo $row["specialty"]; echo " "; echo $row["level"]; ?></td>
                            <td class='text-center'><?php echo $row['adress']; ?></td>
                            <td class='text-center'>
                                <span class="viewSpan">
                                        <form action="viewMember.php" method="post">
                                            <input type="hidden" name="view_id" value="<?php echo $row['idUser']; ?>">
                                            <button type="submit" name="view_btn" class="btn btn-view"><i class='fa fa-eye'></i></button>
                                        </form>
                                </span>
                            </td>
                            <td class='text-center'>
                                <span class="editSpan" >
                                    <form action="editMember.php" method="post">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['idUser']; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-edit"><i class='fa fa-edit'></i></button>
                                    </form>
                                    
                                </span>  
                            </td>
                            <td class='text-center'>
                                <span class="deletSpan">
                                        <form action="code/deletMember.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['idUser']; ?>">
                                        <button type="submit" name="delete_btn" class="btn btn-danger"><i class='fa fa-trash'></i></button>
                                        </form>
                                </span>
                            </td>
                        </tr>
                        <?php
                            $count++; 
                        }
                        ?>
        </table>
                        <?php
                              

} else{
        echo "<tr>No Record Found</tr>";
    }