<?php 
    include "../../../private/conn.php";
    $input = $_POST['input'];
    $idCategorie = $_POST['idCategorie'];
   
    if(!empty($input))
    {
        $query = "SELECT * FROM typebook WHERE idCategorie='$idCategorie' AND (nbrTypeBook LIKE '%$input%' OR typeBook LIKE '%$input%') ";
        $result = mysqli_query($conn, $query);
    }else{
        $query = "SELECT * FROM typebook WHERE idCategorie='$idCategorie'";
        $result = mysqli_query($conn, $query);
    }
    if (mysqli_num_rows($result) > 0 ) {
    ?>
        <div class="cardBox">
            <?php
            while($row = mysqli_fetch_assoc($result)){
            ?>
                <form action="viewBook.php" method="post">
                    <div class="card">
                        <button type="submit" id="go_to" name="go_to">
                            <div class="numbers"><?php echo $row["nbrTypeBook"] ;?></div>
                            <div class="cardName"><?php echo $row["typeBook"]?></div>
                            <input type="hidden" name="idType" value="<?php echo $row['idType']; ?>">
                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                        </button>
                    </div>
                </form>
            <?php
            } 
        }else {
                echo "No Record Found";
            }
        ?>
        </div>