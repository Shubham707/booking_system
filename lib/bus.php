<?php
include'../config.php';
if(@$_REQUEST['submit'])
{
	$id=$_REQUEST['cat_id'];
	$R = $_REQUEST;
	$url = str_replace(' ','-',strtolower($R['cat_name']));
	$tag = ucfirst($R['cat_name']);
	echo $sql="UPDATE `bus_category` SET 
	`cat_name`='$tag',
	`cat_slug`='$url',
	`cat_tag`='$tag' 
	WHERE cat_id='$id'";
	 $query=mysqli_query($db,$sql) or dir(mysqli_error());
	 header("location:../bus-category.php?error=3");
}
if(@$_REQUEST['del'])
{
	$id=$_REQUEST['del'];
	$sql="DELETE FROM `bus_category` WHERE `bus_category`.`cat_id` = '$id'";
	$query=mysqli_query($db,$sql) or dir(mysqli_error());
	header("location:../bus-category.php?error=3");
}
if(@$_REQUEST['insert'])
{
  if($_FILES['images']['name']!="")
  {
    $newFileName = uniqid('uploaded-', true) . '.' . strtolower(pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION));
     move_uploaded_file($_FILES['images']['tmp_name'], '../../uploads_list/' . $newFileName);
  }

  $R=$_REQUEST;
   $data="INSERT INTO `bus_list`(`bus_name`, `bus_cat_id`, `images`,`address`, `price`, `city`, `state`,`country`, `book_description`,  `discount`, `days`) VALUES ('$R[bus_name]', '$R[resort_cat_id]','$newFileName',  '$R[address]','$R[price]', '$R[city]', '$R[state]', '$R[country]', '$R[book_description]', '$R[discount]', '$R[days]')";
    $query= mysqli_query($db, $data) or die (mysqli_error()); 
   header("location:../bus-list.php?error=3");
}
if(isset($_REQUEST['inactive']))
{
	 $active=$_REQUEST['inactive'];
	 $sql="UPDATE bus_list SET status = 0 WHERE flight_id = '$active'";
	 $query=mysqli_query($db,$sql) or dir(mysqli_error());
	 header("location:".$_SERVER['HTTP_REFERER']);
}
if(isset($_REQUEST['active']))
{
	$active=$_REQUEST['active'];
	 $sql="UPDATE `bus_list` SET `status` = '1' WHERE `flight_id` = $active";
	 $query=mysqli_query($db,$sql) or dir(mysqli_error());
	 header("location:".$_SERVER['HTTP_REFERER']);
}
if(isset($_REQUEST['update']))
{

  $id=$_REQUEST['bus_id']; 
 $R=$_REQUEST;
 if($_FILES['imagess']['name']!="")
  {
     $newFileName = uniqid('uploaded-', true) . '.' . strtolower(pathinfo($_FILES['imagess']['name'], PATHINFO_EXTENSION));
      move_uploaded_file($_FILES['imagess']['tmp_name'], '../../uploads_list/' . $newFileName);
  }
  else{
  	$newFileName=$R['images'];
  }
   $sql="UPDATE `bus_list` SET `bus_cat_id`='$R[bus_cat_id]',`bus_name`='$R[bus_name]',`images`='$newFileName',`price`='$R[price]',`address`='$R[address]',`city`='$R[city]',`state`='$R[state]',`country`='$R[country]',`discount`='$R[discount]',`days`='$R[days]',`book_description`='$R[book_description]' WHERE `bus_id` = $id"; 
	 $query=mysqli_query($db,$sql) or dir(mysqli_error());
	header("location:../bus-list.php?error=3");
}
if($_REQUEST['delete'])
{
	$id=$_REQUEST['del'];
	$sql="DELETE FROM `bus_list` WHERE `bus_id` = '$id'";
	$query=mysqli_query($db,$sql) or dir(mysqli_error());
	header("location:../bus-list.php?error=3");
}
?>