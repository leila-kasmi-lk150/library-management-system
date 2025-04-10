<?php

$idUser = $_GET['idUser'];
include('../../../../private/conn.php');

require_once __DIR__ . '/pdf/autoload.php';

?>
<?php

$query = "SELECT * FROM users WHERE  idUser='$idUser'";
$query_run = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($query_run);
$firstName = $row['firstName'];
$lastName = $row['lastName'];
$adress = $row['adress'];
$phone = $row['phone'];
$email = $row['email'];
$codeUser = $row['codeUser'];
$specialty = $row['specialty'];
$level = $row['level'];
$dateOfBirth = $row['dateOfBirth'];
$PlaceOfBirth = $row['PlaceOfBirth'];
if (!empty($row['imageUser'])) {
  $imageUser = $row['imageUser'];
} else {
  $imageUser = "user.png";
}

$html = "
<meta> <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> </meta>

<center>
  <table>
  <tr>
    <th>
        <img src='../code/uploadsMember/$imageUser' width='150'>
        <br>
        <h3> $firstName  $lastName</h3>
    </th>
    <td>
      <center><h3>Faculty Of Exact Sciences Library <br> <br> University Mustafa Stambouli</h3><br></center>
    </td>
  </tr>
  <tr>
    <th>
        <p style='th p{display: flex;}'><i class='fa fa-map-marker'></i><span> $adress</span></p>
      
    </th>
    <td>
      <hr>
    </td>
  </tr>
  <tr>
    <th>
      <p style='th p{display: flex;}'><i class='fa fa-phone'></i><span> $phone </span></p>
    </th>
    <td>
      <h4>First Name</h4> $firstName
      <hr>
    </td>
  </tr>
  <tr>
    <th>
      <p style='th p{display: flex;}'><i class='fa fa-envelope'></i><span> $email </span></p>
    </th>
    <td>
      <h4>Last Name</h4> $lastName
      <hr>
    </td>
  </tr>
  <tr>
    <th>
      <p style='th p{display: flex;}'><i class='fa fa-id-card'></i><span> $codeUser </span></p>
    </th>
    <td>
      <h4>Date Of Birth</h4> $dateOfBirth
      <hr>
    </td>
  </tr>
  <tr>
    <th>
      <p style='th p{display: flex;}'><i class='fa fa-graduation-cap'></i><span>$specialty  $level</span></p>
    </th>
    <td>
      <h4>Place Of Birth</h4> $PlaceOfBirth
    </td>
  </tr>
</table>
</center>
";
$css = file_get_contents('file.css');
$echo = file_get_contents('file.php');

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
// $mpdf->Output();
// $mpdf->Output('file.pdf', 'D');

$pdfContent = $mpdf->Output('', 'S'); // Get the PDF content as a string

// Set the appropriate headers to force download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="BIOGRAPHY.pdf"');
header('Content-Length: ' . strlen($pdfContent));

// Output the PDF content
echo $pdfContent;


?>