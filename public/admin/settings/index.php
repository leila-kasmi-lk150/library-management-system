<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType']=='admin') {

include('../includes/header.php');
include('../../../private/conn.php');
?>

<style>
    <?php include('../assets/css/settings.css'); ?>
    #settings{
        padding: 5px;
        border-bottom: 5px solid white;
    }
</style>

<?php
    include('../../../private/conn.php');
    $idUser=$_SESSION['idUser'];
    $query_run = mysqli_query($conn, "SELECT * FROM users WHERE idUser=$idUser");
    foreach($query_run as $row)
    {
?>        
        <section class="section">
            <div class="main">
                <div class="sect">
                    <div class="sect-heading">
                        <h1>Account</h1>
                    </div>
                    <div class="sect-avatar">
                        <div class="sect-avatar-img">
                            <img src="../member/viewCardMemberDownload/user.jfif" alt="">
                        </div>
                        <div class="name-bio">
                            <p class="user-name" id="userNameAccount"> <?php echo $row['firstName']; echo " ";  echo $row['lastName'];?> </p>
                        </div>
                    </div>
                    <div class="btns">
                        <?php if (isset($_GET['error'])) { ?><p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
                        <?php if (isset($_GET['success'])) { ?><p class="success"><?php echo $_GET['success']; ?></p><?php } ?>
                    </div>
                    <hr >
                    <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd;">
                    <div class="account-edit-form">
                    <!--  -->
                        <form action="code/editAccount.php" class="acc-edit-frm" id="formValidation" method="post">
                            <input type="hidden" name="idUser" value="<?php echo $row['idUser'] ?>">
                            <div class="form-1">
                                <div class="inner-form-1">
                                    <p>Email</p>
                                    <input type="text" name="email" id="email" value="<?php echo $row['email'] ?>">
                                </div>
                                <div class="inner-form-2">
                                    <p>Phone</p>
                                    <input type="text" name="phone" value="<?php echo $row['phone'] ?>" >
                                </div>
                            </div>
                            <div class="form-2">
                                <div class="inner-form-2-1">
                                    <p>Password</p>
                                    <input type="password" name="pw" value="<?php echo $row['passWord'] ?>">
                                </div>
                                <div class="inner-form-2-2">
                                    <p>Adress</p>
                                    <input type="text" name="adress" value="<?php echo $row['adress'] ?>">
                                </div>
                            </div>
                            <div class="save-btn">
                                <input type="submit" value="Save" class="save-bbtn" name="saveProfile">
                             </div>
                        </form>
                    </div>

                    <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; ">
                        <div class="history">
                                <div class="headings">
                                    <h1>Authors</h1>
                                </div>
                                <div class="acc-history">
                                    <div class="history-acc">
                                        <p>Manage Authors</p>
                                    </div>
                                    <div class="conn-btn">
                                        <a href="authors.php" id="view" style="color:white;">View</a>
                                    </div>
                                </div>
                        </div>
                        <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; ">
                        <div class="history">
                                <div class="headings">
                                    <h1>Publisher</h1>
                                </div>
                                <div class="acc-history">
                                    <div class="history-acc">
                                        <p>Manage Publisher</p>
                                    </div>
                                    <div class="conn-btn">
                                        <a href="publisher.php" id="view" style="color:white;">View</a>
                                    </div>
                                </div>
                        </div>

                        <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; ">
                        <div class="history">
                                <div class="headings">
                                    <h1>Language</h1>
                                </div>
                                <div class="acc-history">
                                    <div class="history-acc">
                                        <p>Manage Language</p>
                                    </div>
                                    <div class="conn-btn">
                                        <a href="language.php" id="view" style="color:white;">View</a>
                                    </div>
                                </div>
                        </div>
                        <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd; ">
                        <div class="history">
                                <div class="headings">
                                    <h1>Resource Types</h1>
                                </div>
                                <div class="acc-history">
                                    <div class="history-acc">
                                        <p>Manage Resource Types</p>
                                    </div>
                                    <div class="conn-btn">
                                        <a href="type.php" id="view" style="color:white;">View</a>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
        </section>
        <?php
        }
        ?>
        <section class="section">
            <div class="main">
                <div class="sect">
                    <div class="sect-heading">
                        <h1>LIBRARY IN FIGURES</h1>
                    </div>
                    <hr >
                    <hr size="1px" style="margin: 30px 0px 10px 0px; border: 1px solid #ddd;">
                    <center><h1 style="color: #15a0e1;font-weight: bold; margin-top: 35px;"></h1></center>
                    <div class="cardBox">
                        <div class="card">
                            <div>
                            <div class="cardName">Info  <i class="fas fa-code"></i></div>
                                <div class="numbers">
                                    
                                    <?php
                                    echo "<br>";
                                         $l = "SELECT SUM(`quantity`) AS ll FROM books WHERE idCategorie='1'";
                                         $k = mysqli_query($conn, $l);
                                         $lk = mysqli_fetch_assoc($k);
                                         echo "Book : "; echo $lk['ll'];

                                         echo "<br>";
                                         echo "GP :";
                                         $l_gp = "SELECT SUM(`qte`) AS ll FROM graduation_project WHERE idCategorie='1'";
                                         $k_gp = mysqli_query($conn, $l_gp);
                                         $lk_gp = mysqli_fetch_assoc($k_gp);
                                         echo $lk_gp['ll'];
                                    ?>
                                </div>
                                
                            </div>
                            <div class="iconBx">
                                
                            </div>
                        </div>
                        <div class="card">
                            <div>
                            <div class="cardName">Maths   <i class="fas fa-calculator"></i></div>
                                <div class="numbers">
                                    <?php
                                    echo "<br>";
                                         $l = "SELECT SUM(`quantity`) AS ll FROM books WHERE idCategorie='2'";
                                         $k = mysqli_query($conn, $l);
                                         $lk = mysqli_fetch_assoc($k);
                                         echo "Book : "; echo $lk['ll'];
                                         echo "<br>";
                                         echo "GP :";
                                         $l_gp = "SELECT SUM(`qte`) AS ll FROM graduation_project WHERE idCategorie='2'";
                                         $k_gp = mysqli_query($conn, $l_gp);
                                         $lk_gp = mysqli_fetch_assoc($k_gp);
                                         echo $lk_gp['ll'];
                                    ?>
                                </div>
                           
                            </div>
                            <div class="iconBx">
                               
                            </div>
                        </div>
                        <div class="card">
                            <div>
                            <div class="cardName">chemistry  <i class="fas fa-vial"></i></div>
                                <div class="numbers">
                                    <?php
                                    echo "<br>";
                                     $l = "SELECT SUM(`quantity`) AS ll FROM books WHERE idCategorie='4'";
                                     $k = mysqli_query($conn, $l);
                                     $lk = mysqli_fetch_assoc($k);
                                     echo "Book : "; echo $lk['ll'];
                                     echo "<br>";
 
                                     echo "GP :";
                                     $l_gp = "SELECT SUM(`qte`) AS ll FROM graduation_project WHERE idCategorie='4'";
                                     $k_gp = mysqli_query($conn, $l_gp);
                                     $lk_gp = mysqli_fetch_assoc($k_gp);
                                     echo $lk_gp['ll'];
                                    ?>
                                </div>
                            </div>
                            <div class="iconBx">
                                
                            </div>
                        </div>
                        <div class="card">
                            <div>
                            <div class="cardName">physics <i class="fas fa-atom"></i></div>
                            
                                <div class="numbers">
                                    
                                    <?php
                                    echo "<br>";
                                    
                                    $l = "SELECT SUM(`quantity`) AS ll FROM books WHERE idCategorie='3'";
                                    $k = mysqli_query($conn, $l);
                                    $lk = mysqli_fetch_assoc($k);
                                    echo "Book : "; echo $lk['ll'];
                                    echo "<br>";

                                    echo "GP :";
                                    $l_gp = "SELECT SUM(`qte`) AS ll FROM graduation_project WHERE idCategorie='3'";
                                    $k_gp = mysqli_query($conn, $l_gp);
                                    $lk_gp = mysqli_fetch_assoc($k_gp);
                                    echo $lk_gp['ll'];
                                    ?>
                                </div>
                                
                            </div>
                            <div class="iconBx">
                                
                            </div>
                        </div>
                    </div>
                
                    
                
                    
                </div>
            </div>
        </section>



        
         
<?php
include('../includes/scripts.php');

}else{
    header("Location: ../../home/index.php");
    exit();
}
?> 