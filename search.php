<?php

$Course = $_POST['course'];
$Dept = $_POST['dept'];
$Sem = $_POST['sem'];
$Term = $_POST['term'];
$Year = $_POST['year'];
// $papercode = $_POST['papercode'];


if(!empty($Course) || !empty($Dept) || !empty($Sem) || !empty($Term) || !empty($Year)) {

    $host = "";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "prevquestions";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    //check connection
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT course, dept, term, sem, year, papercode, papername, files FROM papers WHERE course = '$Course' AND dept = '$Dept' AND sem = '$Sem' AND term = '$Term' AND year = '$Year'" ;

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "course: " . $row["course"]. " - Depertment: " . $row["dept"]. " - sem: ". $row["sem"]. " - year: " . $row["year"]. " - papercode: " . $row["papercode"]. "- papername: " . $row["papername"]. " - files: " . $row["files"] . "<br>" ;

        }
    }else {
        echo "0 results";
    }

    mysqli_close($conn);
}

?>