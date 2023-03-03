<?php

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "prevquestions";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    
    $sql = "SELECT course FROM papers WHERE course IS NULL";
    
    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_assoc($result);


if(!empty($_POST['course']) || !empty($_POST['dept']) || !empty($_POST['sem']) || !empty($_POST['term']) || !empty($_POST['year'])) {
    
    $Course = $_POST['course'];
    $Dept = $_POST['dept'];
    $Sem = $_POST['sem'];
    $Term = $_POST['term'];
    $Year = $_POST['year'];

    //check connection
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT course, dept, term, sem, year, papercode, papername, files FROM papers WHERE course = '$Course' AND dept = '$Dept' AND sem = '$Sem' AND term = '$Term' AND year = '$Year'" ;

    $result = mysqli_query($conn, $sql);
    
    $row = mysqli_fetch_assoc($result);


}

if(isset($_GET['file_id'])) {
    
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $id = $_GET['file_id'];
    
    $sql = "SELECT * FROM papers WHERE files = '$id'";
    
    $result = mysqli_query($conn,$sql);
    
    $row = mysqli_fetch_assoc($result);
    
    $filepath = 'uploads/' . $row['files'];
    
    if(file_exists($filepath)) {
        header('Content-Type: application/octet-stream');
        
        header('Content-Description: File Transfer');
        
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        
        header('Expires: 0');
        
        header('Cache-Control: must-revalidate');
        
        header('Pragma:public');
        
        header('Content-Length:' . filesize('uploads/' . $row['files']));
        
        readfile('uploads/' . $row['files']);
        
        exit;
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GCECT.previous-year.question-paper</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Pacifico&family=Roboto:wght@700&family=Scada:wght@700&family=Source+Code+Pro:wght@500&family=Ubuntu:wght@700&family=Yanone+Kaffeesatz:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="design.css" rel="stylesheet">
</head>
<body>
    <div class="nav">
        <a id="admin" href="admin.html" >ADMIN LOGIN</a>
    </div>
    <div class="hed">
        <h2>GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY</h2>
        <h4>(An Autonomus Institute under MAKAUT, NAAC accredited A Grade)</h4>
        <h2>Previous Year Question Papers</h2>
    </div>
    
    <div class="container tabel tbh">
        <table class="table">
            <thead class="frm">
                <tr>
                    <div class="pr-form">
                        <form action = "/index.php" method = "post" > 
                            <th scope="col">
                                <label for="course">Course : </label>
                                    <select name="course" id="course">
                                        <option value="btech" selected>B.TECH</option>
                                        <option value="mtech">M.TECH</option>
                                    </select>
                            </th>
                            <th scope="col">
                                <label for="department">Dept. : </label>
                                <select name="dept" id="department">
                                    <option value="null" selected>-</option>
                                    <option value="cse">CSE</option>
                                    <option value="IT">IT</option>
                                    <option value="Ceramic">Ceramic</option>
                                </select>
                            </th>
                            <th scope="col">
                                <label for="sem">Sem : </label>
                                <select name="sem" id="sem">
                                    <option value="0" selected>-</option>
                                    <option value="1">I</option>
                                    <option value="2">II</option>
                                    <option value="3">III</option>
                                    <option value="4">IV</option>
                                    <option value="5">V</option>
                                    <option value="6">VI</option>
                                    <option value="7">VII</option>
                                    <option value="8">VIII</option>
                                </select>
                            </th>
                            <th scope="col">
                                <label for="term">Term : </label>
                                <select name="term" id="term">
                                    <option value="null" selected>-</option>
                                    <option value="mid1">Mid-Term 1</option>
                                    <option value="mid"2>Mid-Term 2</option>
                                    <option value="end">End-Sem</option>
                                </select>
                            </th>
                            <th scope="col">
                                <label for="year">Year : </label>
                                <select name="year" id="year">
                                    <option value="null" selected>-</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                </select>
                            </th>
                            <th scope="col">
                                <button name="sub" id="sub" type="submit" submitted>Search</button>
                            </th>
                        </form>
                    </div>
                </tr>
            </thead>
            <thead>
              <tr>
                <!-- <th scope="col">no.</th> -->
                <th scope="col">Course</th>
                <th scope="col">Stream</th>
                <th scope="col">PaperCode</th>
                <th scope="col">PaperName</th> 
                <th scope="col">Year</th>
                <th scope="col">Download</th>
              </tr>
            </thead>
            <?php
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['course'];?></td>
                    <td><?php echo $row['dept'];?></td>
                    <td><?php echo $row['papercode'];?></td>
                    <td><?php echo $row['papername'];?></td> 
                    <td><?php echo $row['year'];?></td>
                    <td><a href="index.php?file_id=<?php echo $row['files']?>">Download</a>
                    </td>
                </tr>
            <?php   
                        }
                    }
            ?>
          </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<!-- </body> -->
</body>
<!-- <script src="function.js"></script> -->
</html>