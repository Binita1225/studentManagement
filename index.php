
<?php
    require 'includes/database.php';
    require 'includes/validate.php';
   
    $conn=getDB();// database connection 

    
    $name='';
    $contact='';
    $class='';
    $maths='';
    $science='';
    $social='';
    $english='';
    $computer='';
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name=$_POST['name'];
        $contact=$_POST['contact'];
        $class=$_POST['class'];
        $maths=$_POST['maths'];
        $science=$_POST['science'];
        $social=$_POST['social'];
        $english=$_POST['english'];
        $computer=$_POST['computer'];
       
        $error=validateRecord($name,$contact,$class, $maths, $science, $social, $english, $computer);
        if(empty($error)){
            $conn=getDB();
            $sql="INSERT INTO records(std_name, contact, class, maths, science, social, english, computer) VALUES(?,?,?,?,?,?,?,?)";//?is a placeholder for record item
            $stmt=mysqli_prepare($conn,$sql);
            if($stmt===false){
                echo mysqli_error($conn);

            }else{
                mysqli_stmt_bind_param($stmt,"ssiiiiii",$name,$contact,$class, $maths, $science, $social, $english, $computer);
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
<h2>New Record</h2>
<?php require 'includes/form.php';?>
<a href="display.php">Generate Marksheet</a>
<a href="editRecord.php">Edit a marksheet</a>
<a href="deleteRecord.php">Delete a marksheet</a>
<?php require 'includes/footer.php'; ?>