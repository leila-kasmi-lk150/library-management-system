<meta>

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

</meta>

<?php 
    include "../../../private/conn.php";
    $idCategorie = $_POST['idCategorie'];
    $input = $_POST['input'];
   
    if(!empty($input))
    {
        $query = "SELECT * FROM typebook WHERE idCategorie='$idCategorie' AND (nbrTypeBook LIKE '%$input%' OR typeBook LIKE '%$input%') ";
        $result = mysqli_query($conn, $query);
    }else{
        $query = "SELECT * FROM typebook WHERE idCategorie='$idCategorie'";
        $result = mysqli_query($conn, $query);
    }
    ?>
   

    <?php
    if (mysqli_num_rows($result) > 0 ) {
        while($row = mysqli_fetch_assoc($result))
        {
    ?>

<div class="icons">
            <div id="search-btn"></div>
            <div id="login-btn" ></div>
    </div>

    

<div class="login-form-container"><div id="close-login-btn"></div></div>

<section class="featured" id="featured">
        <h1 class="heading"> <span><?php echo $row['nbrTypeBook']; echo " : "; echo $row['typeBook']; ?></span> </h1>
        <div class="swiper featured-slider">
            <div class="swiper-wrapper">

            <?php
            $idType = $row['idType'];
            $sql2 = "SELECT * FROM `books` WHERE idType='$idType'";
            $sql_run2 = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($sql_run2) > 0)        
            {
                $count = 1;
                while($row2 = mysqli_fetch_assoc($sql_run2))
                {
                    ?>
                        <div class="swiper-slide box">
                            <div class="image">
                                <?php
                                if($row2['image']== null){
                                    ?>
                                        <img src="../../home/image/download.jfif">
                                    <?php

                                }else{
                                ?>
                                <img src="../../admin/books/code/uploadsBook/<?php echo $row2['image']?>">
                                    <?php } ?>
                            </div>
                        <div class="content">
            <?php $idBook= $row2['idBook'];?>
                            <a href="viewBook.php?idBook=<?php echo $idBook?>&idType=<?php echo $idType?>" class="btn">View</a>
                        </div>
            </div>
            <?php
        }
    }
            ?>


            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </section>
<?php 
}
}else {
    echo "<center><h1>No Record Found</h1></center>";
}

?>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="../js/consulterBooks.js"></script>
