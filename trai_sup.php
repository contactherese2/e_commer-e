<?php
include("con_db.php");
if(isset($_GET['id']) && !empty($_GET['id'])){
 $id=$_GET['id'];

 $sql="DELETE FROM produits WHERE id_p=:id";
 $stmt=$conn->prepare($sql);
 $stmt->bindParam('id',$id);
 $stmt->execute();

 if($stmt->execute()){
    header("Location:dashboard.php");
 }

}


?>