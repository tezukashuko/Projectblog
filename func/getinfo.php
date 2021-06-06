<?php 

function getuser($id,$conn){
    $sql = "SELECT *  from user WHERE id = ?  ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) return;
    else return($result->fetch_assoc());
}
?>
