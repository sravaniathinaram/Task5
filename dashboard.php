<?php
session_start();
$conn = mysqli_connect("localhost","root","","blog");

if(!$conn){
    die("Connection failed");
}

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h1>Welcome <?php echo $_SESSION['username']; ?></h1>

<div class="nav">
<a href="create.php">Create Post</a>
<a href="logout.php">Logout</a>
</div>

<hr>
<form method="GET">

<input type="text"
name="search"
placeholder="Search posts...">

<button type="submit">
Search
</button>

</form>

<hr>

<?php

$limit = 3;

$page = isset($_GET['page']) ?
$_GET['page'] : 1;

$offset = ($page - 1) * $limit;

if(isset($_GET['search'])
&& $_GET['search']!=""){

$search = $_GET['search'];

$query =
"SELECT * FROM posts
WHERE title LIKE '%$search%'
OR content LIKE '%$search%'
LIMIT $offset,$limit";

}else{

$query =
"SELECT * FROM posts
LIMIT $offset,$limit";
}

$result = mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($result)){

echo "<div class='post'>";

echo "<h3>".$row['title']."</h3>";

echo "<p>".$row['content']."</p>";

echo "<a href='edit.php?id=".$row['id']."'>Edit</a> | ";
if($_SESSION['role']=="admin"){
echo "<a href='delete.php?id=".$row['id']."'>Delete</a>";
}

echo "</div>";
}
?>
<?php

$total_query =
mysqli_query(
$conn,
"SELECT COUNT(*) as total
FROM posts"
);

$total_row =
mysqli_fetch_assoc(
$total_query
);

$total_posts =
$total_row['total'];

$total_pages =
ceil($total_posts / $limit);

echo "<br><br>";

for($i=1;$i<=$total_pages;$i++){

echo "<a href='dashboard.php?page=$i'>
$i
</a> ";
}
?>

</div>

</body>
</html>