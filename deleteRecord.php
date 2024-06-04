<?php require 'includes/header.php'; ?>
<h2>Delete Record</h2>
<form  method="post">
    <label for="id">Enter id </label>
    <input type="number" name="id" id=""><br>
    <button>Delete</button>
    <a href="/">Cancle</a>
</form>
<?php
require 'includes/database.php';
require 'includes/validate.php';

$conn=getDB();
if (isset($_POST['id'])) {
    $record=getRecord($conn, $_POST['id']);
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
   
        $sql="DELETE FROM records  WHERE id=? ";//?is a placeholder for record item
        $stmt=mysqli_prepare($conn,$sql);
        if($stmt===false){
            echo mysqli_error($conn);

        }else{
            mysqli_stmt_bind_param($stmt,'i',$id);
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

?>


<?php require 'includes/footer.php'; ?>