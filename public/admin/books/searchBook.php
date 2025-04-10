<?php
include "../../../private/conn.php";
$input = $_POST['input'];
$idCategorie = $_POST['idCategorie'];
$idType = $_POST['idType'];

if (!empty($input)) {
    $query = "SELECT * FROM books WHERE idType='$idType' AND (nameBook LIKE '%$input%' OR isbn LIKE '%$input%') ORDER BY `books`.`nbrBook` ASC ";
    $result = mysqli_query($conn, $query);
} else {
    $query = "SELECT * FROM books WHERE books.idType='$idType' ORDER BY `books`.`nbrBook` ASC";
    $result = mysqli_query($conn, $query);
}

?>
<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th class="text-center" scope="col">Cote</th>
            <th class="text-center" scope="col">Book</th>
            <th class="text-center" scope="col">Auther</th>
            <th class="text-center" scope="col">date Of Publisher</th>
            <th class="text-center" scope="col">ISBN</th>
            <th>Image</th>
            <th class="text-center" scope="col">View</th>
            <th class="text-center" scope="col">Edit</th>
            <th class="text-center" scope="col">Delete</th>
        </tr>
    </thead>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row2 = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td class='text-center'>
                    <?php echo $row2['nbrBook']; ?>
                </td>
                <td class='text-left'>
                    <?php echo $row2['nameBook']; ?>
                </td>
                <td class='text-left'>
                    <?php
                    $idBook = $row2['idBook'];
                    $author = mysqli_query($conn, "SELECT * FROM authors,writ WHERE writ.idAuthor=authors.idAuthor AND writ.idBook='$idBook'");
                    if (mysqli_num_rows($author) > 0) {
                        while ($rowA = mysqli_fetch_assoc($author)) {
                            echo "<br>";
                            echo $rowA['author'];

                        }
                    } else {
                        echo "0";
                    } ?>
                </td>
                <td class='text-left'>
                    <?php echo $row2['dateOfPublisher']; ?>
                </td>
                <td class='text-center'>
                    <?php echo $row2['isbn']; ?>
                </td>
                <td class='text-center'>
                                <?php
                                if (!empty($row2['image'])) {
                                    ?>
                                    <img src="code/uploadsBook/<?php echo $row2['image'] ?>" alt="" width="150">
                                    <?php
                                }else{
                                ?>
                                <img src="code/uploadsBook/empty.jpg" alt="" width="150">
                                <?php } ?>
                            </td>
                            <td class='text-center'>
                    <span class="viewSpan">
                        <form action="viewBookCard.php" method="post">
                            <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                            <input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>">
                            <input type="hidden" name="view_id" value="<?php echo $row2['idBook']; ?>">
                            <button type="submit" name="view_btn" class="btn btn-view"><i class='fa fa-eye'></i></button>
                        </form>
                    </span>
                </td>
                <td class='text-center'>
                    <span class="editSpan">
                        <form action="editBook.php" method="post">
                            <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                            <input type="hidden" name="idCategorie" value="<?php $idCategorie; ?>">
                            <input type="hidden" name="edit_id" value="<?php echo $row2['idBook']; ?>">
                            <button type="submit" name="edit_btn" class="btn btn-edit"><i class='fa fa-edit'></i></button>
                        </form>
                    </span>
                </td>
                <td class='text-center'>
                    <span class="deletSpan">
                        <form action="code/deletBookCode.php" method="post">
                            <input type="hidden" name="returnIdType" value="<?php echo $idType ?>">
                            <input type="hidden" name="idCategorie" value="<?php $idCategorie; ?>">
                            <input type="hidden" name="delete_id" value="<?php echo $row2['idBook']; ?>">
                            <button type="submit" name="delete_btn" class="btn btn-danger"><i class='fa fa-trash'></i></button>
                        </form>
                    </span>
                </td>
            </tr>

            <?php
        }
    }
    ?>