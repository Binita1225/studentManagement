<?php require 'includes/header.php';?>
<!-- it is run first so header is in top -->
<form action="" method="post">
    <!-- id ko value lina method post used -->
    <label for="displayId">Enter id to generate marksheet: </label>
    <input type="number" name="displayId" id="displayId">
</form>

<?php
require 'includes/database.php';

require 'includes/validate.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // post method xa vana chalxa   =is for value assign, == is for value comparison, ===is for datatype sanga ko value comparisonor to validate
    $displayId = $_POST['displayId'];
    $conn = getDB();
    $sql = "SELECT * FROM records WHERE id = ?;";
    $stmt = mysqli_prepare($conn, $sql);
    // database statement prepared
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $displayId = $_POST['displayId'];
        $conn = getDB();
        $sql = "SELECT * FROM records WHERE id = ?;";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, 'i', $displayId);
            // bind param is paramater bind garako 
            mysqli_stmt_execute($stmt);
            
            $result = mysqli_stmt_get_result($stmt);
            
            if (mysqli_num_rows($result) > 0) {
                
                $row = mysqli_fetch_assoc($result);
                //  database ko record fetch garako
                $name = $row['std_name'];
                $class = $row['class'];
                $id=$row['id'];
                $mathsMarks = $row['maths'];
                $scienceMarks = $row['science'];
                $socialMarks = $row['social'];
                $englishMarks = $row['english'];
                $computerMarks = $row['computer'];
                
                $passMarks = 32;
                // initialize garako
                $totalMarks = $mathsMarks + $scienceMarks + $socialMarks + $englishMarks + $computerMarks;
                $percentage = ($totalMarks / 500) * 100;
                
                echo "<h3>Name: $name</h3>";
                echo "<h3>Class: $class</h3>";
                echo "<h3>Student ID: $id</h3>";
                
                echo '<table style="border-collapse: collapse;">';
                //border collapse is a css command 
                echo '<tr><th style="border: 1px solid black;">Subject</th>
                <th style="border: 1px solid black;">Pass Marks</th>
                <th style="border: 1px solid black;">Total Marks</th>
                <th style="border: 1px solid black;">Obtained Marks</th></tr>';
                
                echo '<tr>';
                echo '<td style="border: 1px solid black;">Maths</td>';
                echo '<td style="border: 1px solid black;">32</td>';
                echo '<td style="border: 1px solid black;">100</td>';
                echo '<td style="border: 1px solid black;">' . $mathsMarks . '</td>';
                echo '</tr>';
                
                echo '<tr>';
                echo '<td style="border: 1px solid black;">Science</td>';
                echo '<td style="border: 1px solid black;">32</td>';
                echo '<td style="border: 1px solid black;">100</td>';
                echo '<td style="border: 1px solid black;">' . $scienceMarks . '</td>';
                echo '</tr>';
                
                echo '<tr>';
                echo '<td style="border: 1px solid black;">Social</td>';
                echo '<td style="border: 1px solid black;">32</td>';
                echo '<td style="border: 1px solid black;">100</td>';
                echo '<td style="border: 1px solid black;">' . $socialMarks . '</td>';
                echo '</tr>';
                
                echo '<tr>';
                echo '<td style="border: 1px solid black;">English</td>';
                echo '<td style="border: 1px solid black;">32</td>';
                echo '<td style="border: 1px solid black;">100</td>';
                echo '<td style="border: 1px solid black;">' . $englishMarks . '</td>';
                echo '</tr>';
                
                echo '<tr>';
                echo '<td style="border: 1px solid black;">Computer</td>';
                echo '<td style="border: 1px solid black;">32</td>';
                echo '<td style="border: 1px solid black;">100</td>';
                echo '<td style="border: 1px solid black;">' . $computerMarks . '</td>';
                echo '</tr>';
                
                echo '<tr>';
                echo '<td colspan="3" style="border: 1px solid black;">Total Obtained Marks</td>';
                echo '<td style="border: 1px solid black;">' . $totalMarks . '</td>';
                // . is used to concardinate string
                echo '</tr>';

                echo '</table>';
                echo "<p>Percentage: $percentage%</p>";
                if ($totalMarks >= $passMarks*5) {
                    echo '<h3>Congratulations! You have passed.</h3>';
                } else {
                    echo '<h3>Sorry! You have failed.</h3>';
                }
            } else {
                echo "No records found.";
            }
        }
    }
    
    
}
   
?>
<?php require 'includes/footer.php';?>