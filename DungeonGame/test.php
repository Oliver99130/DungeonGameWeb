<?php

 
/*
$con = mysqli_connect("localhost","root","","demo");

if (!$con)

  {

  die('Could not connect: ' . mysqli_connect_error());

  }



$result = mysqli_query($con,"SELECT * FROM users");

while($row = mysqli_fetch_array($result))

  {

  echo $row['id'] . " " . $row['username']. $row['created_at']. $row['salt'];

  echo "<br />";

  }*/
?>
<html>

<head>

<style>

table

{

border-style:solid;

border-width:2px;

border-color:pink;

}

</style>

</head>

<body>

<?php

$con = mysqli_connect("localhost","root","","demo");

if (!$con)

  {

  die('Could not connect: ' . mysqli_connect_error());

  }



$result = mysqli_query($con,"SELECT users.username AS username, playerdata.Health AS health, playerdata.PlayedTime AS PlayedTime FROM users JOIN playerdata ON users.ID=playerdata.ID");


echo "<table border='1'>

<tr>

<th>username</th>

<th>Health</th>

<th>PlayedTime</th>


</tr>";

 

while($row = mysqli_fetch_array($result))

  {

  echo "<tr>";

  echo "<td>" . $row['username'] . "</td>";

  echo "<td>" . $row['health'] . "</td>";

  echo "<td>" . $row['PlayedTime'] . "</td>";

  echo "</tr>";

  }

echo "</table>";

 

mysqli_close($con);

?>

</body>

</html>