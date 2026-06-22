<?php
include 'config.php';

if(isset($_POST['submit'])){

    $title=$_POST['title'];
    $content=$_POST['content'];
    if(empty($title) || empty($content)){
    echo "All fields are required";
    exit();
}

    $sql="INSERT INTO posts(title,content)
          VALUES('$title','$content')";

    mysqli_query($conn,$sql);

    echo "Post Added Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Create Post</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Create New Post</h2>

<form method="POST">

<input type="text"
name="title"
placeholder="Post Title"
required>

<textarea
name="content"
placeholder="Post Content"
required></textarea>

<button type="submit"
name="submit">
Add Post
</button>

</form>

</div>

</body>
</html>