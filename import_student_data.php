<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include_once 'db_conn.php';
$error = 0;
if(isset($_POST["import"]))
{
  $temp = explode(".", $_FILES["excel"]["name"]);
  $extension = end($temp);
  $allowed_extension = array("xls", "xlsx", "csv");
  
  if(in_array($extension, $allowed_extension)){
    
    $file = $_FILES["excel"]["tmp_name"]; 
    include("PHPExcel/IOFactory.php");
    $objPHPExcel = PHPExcel_IOFactory::load($file);
    

    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
      $highestRow = $worksheet->getHighestRow();
      $imported_records = 0;
      for($row=2; $row<=$highestRow; $row++){
        
        $student_id = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());

        $sql = "SELECT * FROM students WHERE student_id LIKE '$student_id'";
        $result = mysqli_query($conn, $sql);
        $inner_ctr = mysqli_num_rows($result);

        if($inner_ctr==0){

          $imported_records++;
          $student_lname = strtoupper(mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue()));
          $student_fname = strtoupper(mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue()));

          $student_mname = strtoupper(mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue()));
          $birth_date = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
          $unix_date = ($birth_date - 25569) * 86400;
          $excel_date = 25569 + ($unix_date / 86400);
          $unix_date = ($excel_date - 25569) * 86400;
          $birth_date = gmdate("Y-m-d", $unix_date);

          $nationality = strtoupper(mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(5, $row)->getValue()));
          $gender = strtoupper(mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(6, $row)->getValue()));
          $email = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(7, $row)->getValue());
          $phone = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(8, $row)->getValue());
        
            if(!empty($student_id) || !empty($student_fname) || !empty($student_lname) || !empty($student_mname) || !empty($birth_date) || !empty($nationality) || !empty($gender)|| !empty($phone)|| !empty($email)){
              
              $query = "INSERT INTO students(student_id,firstname,lastname,middlename,birth_date,nationality,gender,phone,email,password) VALUES ('".$student_id."', '".$student_fname."' , '".$student_lname."', '".$student_mname."' , '".$birth_date."', '".$nationality."', '".$gender."', '".$phone."', '".$email."','".$student_id."')";

              mysqli_query($conn, $query);
              $error = 0;
            }
            else{
              $error = 1;
            }

          // $student_id = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
          // $student_name = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
          // $birth_date = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(2, $row)->getValue());
          // $unix_date = ($birth_date - 25569) * 86400;
          // $excel_date = 25569 + ($unix_date / 86400);
          // $unix_date = ($excel_date - 25569) * 86400;
          // $birth_date = gmdate("Y-m-d", $unix_date);
          // $address = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(3, $row)->getValue());
          // $phone = mysqli_real_escape_string($conn, $worksheet->getCellByColumnAndRow(4, $row)->getValue());
        
          //   if(!empty($student_id) || !empty($student_name) || !empty($birth_date) || !empty($address) || !empty($phone)){
              
          //       $query = "INSERT INTO student_records(student_id,student_name,birth_date,address,phone) VALUES ('".$student_id."', '".$student_name."' , '".$birth_date."', '".$address."' , '".$phone."')";
              
          //     mysqli_query($conn, $query);
          //     $error = 0;
          //   }
          //   else{
          //     $error = 1;
          //   }
        }
      }
      
    } 
    if ($error == 0) {
      echo "<script>alert('(".$imported_records.") Student record imported.');
          window.location.href='admindashboard_students.php';</script>";
     }
     else{
      echo "<script>alert('Something went wrong. please try again!');
          window.location.href='admindashboard_students.php';</script>";
     }
     mysqli_close($conn);
  }
  else
  {
    echo "<script>alert('Invalid File');
          window.location.href='admindashboard_students.php';</script>";
    
  }
}

?>