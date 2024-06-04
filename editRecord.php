<?php
require 'includes/database.php';
require 'includes/validate.php';

$conn=getDB();
if (isset($_GET['id'])) {
    $record=getRecord($conn, $_GET['id']);
    // it takes values from database
    if ($record) {
        $id=$record['id'];
        //database bata lerako vayara we need id here
        $name=$record['std_name'];
        $contact=$record['contact'];
        $class=$record['class'];
        $maths=$record['maths'];
        $science=$record['science'];
        $social=$record['social'];
        $english=$record['english'];
        $computer=$record['computer'];
       
       
    }
    else{
        die("Record  not found");
        // die generate message and then terminate it
    }
}else{
    die("ID not supplied, Record not found");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST['name'];
    $contact=$_POST['contact'];
    $class=$_POST['class'];
    $maths=$_POST['maths'];
    $science=$_POST['science'];
    $social=$_POST['social'];
    $english=$_POST['english'];
    $computer=$_POST['computer'];
   
    $errors=validateRecord($name,$contact,$class, $maths, $science, $social, $english, $computer);
    if(empty($errors)){
        $conn=getDB();
        $sql="UPDATE records SET std_name=?, contact=?, class=?, maths=?, science=?, social=?, english=?, computer=? WHERE id=? ";//?is a placeholder for record item
        $stmt=mysqli_prepare($conn,$sql);
        if($stmt===false){
            echo mysqli_error($conn);

        }else{
            mysqli_stmt_bind_param($stmt,"ssiiiiiii",$name,$contact,$class, $maths, $science, $social, $english, $computer, $id);
            // here ss is to pass string values and i is to pass integer values
            if(mysqli_stmt_execute($stmt)){
                $id=mysqli_insert_id($conn);
               
                // echo "Inserted record with id:$id";
            }    
            else{
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}

?>
<?php require 'includes/header.php'; ?>
<h2>Edit Record</h2>
<?php require 'includes/form.php';?>
<?php require 'includes/footer.php'; ?>