<?php
session_start();
if (isset($_SESSION['idUser'])) {
  ?>
<?php
include('../includes/header.php');
include('../../../private/conn.php');
?>
<style>
    <?php include('../assets/css/section.css');
        ?>
 
</style>
<?php
    {
       
    
     ?>
     
    <div class="viewBook">
                    <div class="typeName">Members</div>
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>
                    <form action="addMember.php" method="post">
                    <button id = "add_book" name="add_book" type = "submit"><i class="fa fa-plus"></i> Add new</button>
                    <input type="text" placeholder="Search By Id" class="navbar-search" id="myInput" name="" onkeyup="searchFun()"/>

                </form>
                    <br />
                
                <hr>
          <table class="table table-bordered table-striped table-hover" id="myTable">
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
                    <script>
                        const searchFun = () =>{
                            let filter = document.getElementById('myInput').value.toUpperCase();

                            let myTable = document.getElementById('myTable');

                            let tr = myTable.getElementsByTagName('tr');

                            for(var i=0; i<tr.length; i++){
                                let td = tr[i].getElementsByTagName('td')[0];
                                if(td){
                                    let textvalue = td.textContent || td.innerHTML;
                                    if(textvalue.toUpperCase().indexOf(filter) >
                                        -1){
                                        tr[i].style.display = "";
                                    }
                                    else {
                                        tr[i].style.display = "none";
                                    }
                                }
                            }

                        }
                        
                    </script>
                    <?php
                         $sql = "SELECT * FROM users WHERE isAdmin=0";
                         $sql_run = mysqli_query($conn, $sql);
    
                           if(mysqli_num_rows($sql_run) > 0)        
                        {
                            $count = 1;
                            while($row = mysqli_fetch_assoc($sql_run))
                            {
                                
                        
                            
                    ?>
                        
                        <tr>
                            <td class='text-center'><?php echo $count; ?></td>
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
                        $count = $count + 1; 
                        } 
                        }
                        else {
                            echo "No Record Found";
                        }
                        ?>
                </table>
                </div>
               






<?php
}
include('../includes/scripts.php');
?>
<?php
}else{
  header("Location: ../../index.php");
  exit();
}
?>