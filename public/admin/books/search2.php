<?php
session_start();
if (isset($_SESSION['idUser']) && $_SESSION['userType']=='admin') {
?>
<?php
    include('../includes/header.php');
    include('../../../private/conn.php');
    
?>
<style>
   <?php include('../assets/css/search.css');?>
</style>

<center>


<div class="search-form">
<form action="search.php" method="post">
                <!-- <label type="submit" for="search-box" class="fas fa-search"></label> -->
                <!-- <input type="hidden" name="idCategorie" value="< ?php echo $idCategorie; ?>"> -->
                <input type="text" name="search" placeholder="search here..."  class="fas fa-search">
                <select name="selectSearch" id="">
                    <option value="type">Type</option>
                    <option value="book">Book</option>
                </select>
                
</form>
</div>
</center>
<center>

<hr style="border: 2px solid #1c4966; margin: 26px; width: 50%">
<?php
    // if (mysqli_num_rows($result) > 0 ) 
    {
    //   while($row2 = mysqli_fetch_assoc($result))
                        {
    ?>
<div class="showBook">
    <table>
        <tr>
            <td>
                <div class="img">
                    <img src="code/uploadsBook/IMG-6400c019657764.24922849.jpg" alt="" width="120">
                </div>
            </td>
            <td>
                <div class="name">
                    <h3>Lorem ipsum dolos eum, omnis maxime aliquam.</h3> <br>
                    <h4>sumenda, quaerat nostrum voluptas iusto vit</h4>
                    <h5>
                        ISBN : 269456102889<br>
                        Cote : 510-20
                    </h5>
                </div>
            </td>
            <td>
                <div class="view">
                    <center>
                        <button type="submit" name="view_btn"> Show <span class="fas fa-chevron-right"></span></button>
                    </center>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="img">
                    <img src="code/uploadsBook/IMG-6401e37ecbe4e9.72082050.jfif" alt="" width="120">
                </div>
            </td>
            <td>
                <div class="name">
                    <h3>los eum, omnis maxime aliquam.</h3> <br>
                    <h4>sumenda hjkire vcxaeh jjkifc vbn,k , quaerat nostrum voluptas iusto vit</h4>
                    <h5>
                        ISBN : 269456102889<br>
                        Cote : 510-20
                    </h5>
                </div>
            </td>
            <td>
                <div class="view">
                    <center>
                        <button type="submit" name="view_btn"> Show <span class="fas fa-chevron-right"></span></button>
                    </center>
                </div>
            </td>
        </tr>
    </table>
</div>

<?php
}
}



?>

            
            <?php

include('../includes/scripts.php');

}else{
  header("Location: ../../home/index.php");
  exit();
}
?> 