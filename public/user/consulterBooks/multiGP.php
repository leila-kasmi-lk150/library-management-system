<?php
session_start();
if (isset($_SESSION['idUser'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <link rel="icon" type="image/x-icon" href="../../image/icon.jpg">
        <title>Library Of Faculty Of Exact Science</title>

        <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />


        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,600;1,700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- custom css file link  -->
        <link rel="stylesheet" href="../css/popup.css">

    </head>
    <style>
        <?php
        include('../css/popup.css');
        ?>
        .typeName {
            margin-top: 15px;
            margin-bottom: 15px;
            width: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 20px;
            padding-bottom: 20px;
            font-weight: bold;
            color: #000;
            background-color: #d9edf7;
            border-color: #bce8f1;
            text-transform: uppercase;
            /* font-size: 25px; */
            font-size: 15px;

            background-color: #235284;
            color: white;
        }

        .typeName p {
            padding: 20px;
        }

        .typeName p a {
            text-decoration: none;
            color: #000;
        }

        .p1 {

            color: #31708f;
            border-bottom: #ffffff 2px solid;
            color: white;
        }

        .p2 {
            color: black;
            color: white;
        }

        .p2:hover {
            color: #31708f;
            color: white;
            border-bottom: #ffffff 2px solid;
        }
    </style>

    <body>
        <nav>
            <a href="../../home/index.php"><img id="img" src="../../home/image/icon.jpg"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hideMenu()"></i>
                <ul>
                    <li>
                        <a href="../../home/index.php">Home</a>
                    </li>
                    <li>
                        <a href="contact.php#contact-us">ContactUs</a>
                    </li>
                    <li>
                        <a href="../Acount-setting/index.php">My Account</a>
                    </li>
                    <li>
                        <a href="../../../private/login/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>

        <?php
        include "../../../private/conn.php";
        $idCategorie = $_GET['idCategorie'];
        $idGP = $_GET['idGP'];
        $idUser = $_SESSION['idUser'];
        $Action = $_GET['Action'];
        ?>

        <center>
            <div class="typeName">
                <?php
                $categorieQuery = mysqli_query($conn, "SELECT * FROM categorie");
                while ($categorie = mysqli_fetch_assoc($categorieQuery)) {
                    if ($categorie['idCategorie'] == $idCategorie) {
                        ?>

                        <a href="index.php?idCategorie=<?php echo $categorie['idCategorie']; ?>">
                            <p class="p1">
                                <?php echo $categorie['categorie'] ?>
                            </p>
                        </a>

                        <?php
                    } else {
                        ?>

                        <a href="index.php?idCategorie=<?php echo $categorie['idCategorie']; ?>">
                            <p class="p2">
                                <?php echo $categorie['categorie'] ?>
                            </p>
                        </a>

                        <?php
                    }
                }
                ?>
            </div>
        </center>


        <div class="body">
            <table>
                <?php



                // test if user borrow book IF HE DID SO HE CAN'T BORROW BOOK
                $borrowGPtest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM borrow WHERE idUser='$idUser' AND isReturn='0'"));
                $requestGPtest = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM request WHERE idUser='$idUser'"));
                $total_gp = $borrowGPtest + $requestGPtest;


                // test if the user borrow more then 2 graduation_project 
            
                $borrow = mysqli_query($conn, "SELECT COUNT(*) AS b FROM borrow_gp WHERE idUser='$idUser'AND isReturn='0'");
                $request1 = mysqli_query($conn, "SELECT COUNT(*) AS r FROM request_gp WHERE idUser='$idUser'");
                $b = mysqli_fetch_assoc($borrow);
                $r = mysqli_fetch_assoc($request1);

                $total = $b['b'] + $r['r'];
                // ===== 
                $sql = mysqli_query($conn, "SELECT * FROM graduation_project WHERE idGP=$idGP");
                $row = mysqli_fetch_assoc($sql);


                // test if the member blocked
                $block = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE idUser='$idUser'"));
                if ($block['block'] == '1') {
                    ?>
                    <tr>
                        <td>
                            <h2>
                                <center>
                                    you can't borrow now, your action blocked
                                </center>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <button>
                                    <a
                                        href="viewBook.php?idCategorie=<?php echo $idCategorie; ?>&idBook=<?php echo $idBook; ?>&idType=<?php echo $idType; ?>">OK</a>
                                </button>
                            </center>
                        </td>
                    </tr>
                    <?php
                } else
                    if ($total_gp != 0) {
                        ?>
                        <tr>
                            <td>
                                <h2>
                                    <center>
                                        you can't Get book and graduation project in the same time
                                    </center>
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <center>
                                    <button>
                                        <a
                                            href="viewGP.php?idCategorie=<?php echo $idCategorie; ?>&idGP=<?php echo $idGP; ?>">OK</a>
                                    </button>
                                </center>
                            </td>
                        </tr>
                        <?php
                    } else if ($total >= 2) {
                        ?>
                            <tr>
                                <td>
                                    <h2>
                                        <center>
                                            you can't Get more than 2 graduation project
                                        </center>
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <center>
                                        <button>
                                            <a
                                                href="viewGP.php?idCategorie=<?php echo $idCategorie; ?>&idGP=<?php echo $idGP; ?>">Cancel</a>
                                        </button>
                                    </center>
                                </td>
                            </tr>
                        <?php
                    } else if ($row['qte'] <= 1 && $Action == "borrow") {
                        $r = "read";
                        ?>
                                <tr>
                                    <td>
                                        <h2>
                                            <center>
                                                This graduation project Cant't Be Borrowed , You Can just read it in library
                                            </center>
                                        </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <center>
                                            <button>
                                                <a
                                                    href="multiGP.php?idCategorie=<?php echo $idCategorie; ?>&idGP=<?php echo $idGP; ?>&Action=<?php echo $r; ?>">Read</a>
                                            </button>
                                            <button>
                                                <a
                                                    href="viewBook.php?idCategorie=<?php echo $idCategorie; ?>&idBook=<?php echo $idBook; ?>">Cancel</a>
                                            </button>
                                        </center>
                                    </td>
                                </tr>
                        <?php
                    } else if ($row['nbrCopy'] == '0') {


                        ?>
                                    <tr>
                                        <td>
                                            <h2>
                                                <center>
                                                    <h2>All Copis of this graduation project have been borrowed</h2> <br>
                                                    <h3>Do You want to be notified if it is available ?</h3>
                                                </center>
                                            </h2>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <button>
                                                    <a
                                                        href="sendNotificationGP.php?idGP=<?php echo $idGP ?>&idUser=<?php echo $idUser ?>">yes</a>
                                                </button>
                                                <button>
                                                    <a
                                                        href="viewGP.php?idCategorie=<?php echo $idCategorie; ?>&idGP=<?php echo $idGP; ?>">Cancel</a>
                                                </button>
                                            </center>
                                        </td>
                                    </tr>
                        <?php
                    } else if ($row['nbrCopy'] <= 1 && $row['qte'] > 1) {
                        ?>
                                        <tr>
                                            <td>
                                                <h2>
                                                    <center>
                                                        <h2>All Copis of this book have been borrowed</h2> <br>
                                                        <h3>Do You want to be notified if it is available ?</h3>
                                                    </center>
                                                </h2>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <center>
                                                    <button>
                                                        <a
                                                            href="sendNotificationGP.php?idGP=<?php echo $idGP ?>&idUser=<?php echo $idUser ?>&idCategorie=<?php echo $idCategorie; ?>">yes</a>
                                                    </button>
                                                    <button>
                                                        <a
                                                            href="viewGP.php?idCategorie=<?php echo $idCategorie; ?>&idGP=<?php echo $idGP; ?>">Cancel</a>
                                                    </button>
                                                </center>
                                            </td>
                                        </tr>
                        <?php
                    } else {
                        $request = mysqli_query($conn, "INSERT INTO request_gp(idUser,idGP,Action) VALUES ('$idUser','$idGP','$Action')");
                        $request2 = mysqli_query($conn, "UPDATE graduation_project SET nbrCopy=nbrCopy-1 WHERE idGP='$idGP' ");
                        if ($request && $request2) {
                            ?>
                                            <tr>
                                                <td>
                                                    <h2>
                                                        <center>
                                                            <h2>You Can Approach The Library To Take The Graduation Project <br>
                                                                Within A Period Not Exeeding One Day
                                                            </h2>
                                                        </center>
                                                    </h2>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <center>
                                                        <button>
                                                            <a
                                                                href="viewGP.php?idCategorie=<?php echo $idCategorie; ?>&idGP=<?php echo $idGP; ?>">OK</a>
                                                        </button>
                                                    </center>
                                                </td>
                                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        </div>



        <script src="../../home/script.js"></script>
    </body>


    <?php
} else {
    header("Location: ../../home/index.php");
    exit();
}
?>