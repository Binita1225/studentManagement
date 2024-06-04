
<!-- /**
*Get the article record based on the ID
*@param object $conn connection to the database
*@integer $id the article ID
*@return mixed An associative array containing the article with that id or null if not found.
*/ -->
<?php
function getArticle($conn,$id){
    $sql="SELECT * FROM article WHERE id=?";
    $stmt= mysqli_prepare($conn,$sql);
    if($stmt===false){
        echo mysqli_error($conn);

    }else{
        mysqli_stmt_bind_param($stmt,"i",$id);
        // i means integer value
        if(mysqli_stmt_execute($stmt)){
            $result =mysqli_stmt_get_result($stmt);
            return mysqli_fetch_array($result,MYSQLI_ASSOC);
        }
    }
}

function validateArticle($title,$content,$published_at){
    $errors=[];
    if($title==''){
        $errors[]='Title is required';
    }
        if($content==''){
            $errors[]='content is required';
        }
            if($published_at!=''){
                $date_time=date_create_from_format('Y-m-d H:i:s',$published_at);
            }
                if($date_time===false){
                    $errors[]='Invalid date and time';
                

            }
            else{
                $date_errors=date_get_last_errors();
                if($date_errors['warning-count']>0){
                    $errors[]='Invadid date and time';
                }
            }
            return $errors;
}
?>