<?php  
//export.php  
include('../../../../private/conn.php');
$output = '';

 $query = "SELECT * FROM users order by 1 desc";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>S.L</th>  
                         <th>First Name</th>  
                         <th>Last Name</th>  
                         <th>Date Of Birth</th>  
                         <th>Place Of Birth</th>  
                         <th>Adress</th>
                         <th>Email</th>  
                         <th>Phone</th>
                         <th>Specialty</th>  
                         <th>level</th>
                         
                    </tr>
  ';
  $i = 0;
  while($row = mysqli_fetch_array($result))
  {
    $sl = ++$i;
   $output .= '
    <tr>  
                         <td > '.$sl.' </td>
                         <td>'.$row["firstName"].'</td>  
                         <td>'.$row["lastName"] .'</td>  
                         <td>'.$row["dateOfBirth"].'</td>  
                         <td>'.$row["PlaceOfBirth"].'</td>  
                         <td>'.$row["adress"].'</td>  
                         <td>'.$row["email"].'</td> 
                         <td>'.$row["phone"].'</td>  
                         <td>'.$row["specialty"].'</td>  
                         <td>'.$row["level"].'</td> 
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=Student.xls');
  echo $output;
 }

?>