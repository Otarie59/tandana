<html>

<head>
<title>Artists</title>
<style type="text/css">
    .link { 
        float:left;
        position:relative; 
        top:900px;
    }
    #image{
        float:left;
        position:relative; 
        top:350px;
        left:0px;
    }
</style>
</head>
<body>
<form method='get'>
<?PHP include 'navigation.php';
      //require_once('db_configuration.php');
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

// Create connection
//$conn = new mysqli($servername, $username, $password, $database);

$conn = new mysqli("localhost","thisitz6_tandana" ,"Pittaladora!23" , "thisitz6_tana_tandana");        
if ($conn->connect_error) {
    die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
}
//check if the starting row variable was passed in the URL or not
if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}
/*
D
RESOURCE_TYPE
RESOURCE_NAMES
RESOURCE_LOCATION
ISBN
PUBLICATION_DATE
AUTHOR_NAME
PUBLICATION_COMPANY
AUTHOR2_NAME
AUTHOR3_NAME
*/
//this part goes after the checking of the $_GET var
$fetch = mysqli_query($conn,"SELECT * FROM Artists LIMIT $startrow, 10")or
die(mysqli_error($conn));
   $num=Mysqli_num_rows($fetch);
        if($num>0)
        {
        echo "<table border=2 class='artist_table' style= \"position:absolute; top:600px;\" >";
        echo "<tr>";
        if(isset($_SESSION['username'])){
        }
        if(isset($_SESSION['username'])){
        echo '<img src="assets/images/index_dance.png" id="image" width="100px" height="100px">';
        $edit="update_artists.php";
        $delete="delete_artist.php";
        $link='<a href=$edit>Edit</a>'.'<a href=$delete>Delete</a>';
        $row=mysqli_fetch_row($fetch);
        echo '<td>ACTIONS</td>';
        echo '</tr>';
        for($i=0;$i<$num;$i++) //?id=.$row[0].
        {
        $row=mysqli_fetch_row($fetch);
        echo "<tr>";
        echo '<td>'.$row[0].'</td>';       
        echo '<td>'.$row[1].'</td>';       
        echo '<td>'.$row[2].'</td>';
        echo '<td>'.$row[3].'</td>';       
        echo '<td>'.$row[4].'</td>';       
        echo '<td>'.$row[5].'</td>';
        echo '<td>'.$row[6].'</td>';       
        echo '<td>'.$row[7].'</td>';       
        echo '<td>'.$row[8].'</td>';
        echo '<td>'.$row[9].'</td>';
        echo '<td>'.$row[10].'</td>';
        echo '<td>'.$row[11].'</td>';
        echo '<td>'.'<a href='.$edit.'?id='.$row[0].'>Edit</a>'.'<a href='.$delete.'?id='.$row[0].'>Delete</a>'.'</td>';
        echo "</tr>";
        }//for
        echo"</table>";
        }
          //only admins can see this
        for($i=0;$i<$num;$i++)
        {
        $row=mysqli_fetch_row($fetch);
        echo "<tr>";
        echo '<td>'.$row[0].'</td>';       
        echo '<td>'.$row[1].'</td>';       
        echo '<td>'.$row[2].'</td>';
        echo '<td>'.$row[3].'</td>';       
        echo '<td>'.$row[4].'</td>';       
        echo '<td>'.$row[5].'</td>';
        echo '<td>'.$row[6].'</td>';       
        echo '<td>'.$row[7].'</td>';       
        echo '<td>'.$row[8].'</td>';
        echo '<td>'.$row[9].'</td>';
        echo '<td>'.$row[10].'</td>';
        echo '<td>'.$row[11].'</td>';
        echo"</tr>";
        }//for
        echo"</table>";
        }
//now this is the link..
echo '<a class="link" href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+10).'">Next</a>';

$prev = $startrow - 10;

//only print a "Previous" link if a "Next" was clicked
if ($prev >= 0)
    echo '<a class="link" href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'">Previous</a>';
?>
</form>
</body>
</html>