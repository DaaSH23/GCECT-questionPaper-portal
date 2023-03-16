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
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Pacifico&family=Roboto:wght@700&family=Scada:wght@700&family=Source+Code+Pro:wght@500&family=Ubuntu:wght@700&family=Yanone+Kaffeesatz:wght@700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- Font Awesome CDN  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css file  -->
    <link href="./styles/index.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="nav">
            <a id="admin" href="admin.html" class="login_btn mt-4">ADMIN LOGIN</a>
        </div>
        <div class="hed">
            <h2>GOVERNMENT COLLEGE OF ENGINEERING AND CERAMIC TECHNOLOGY</h2>
            <h4>(An Autonomus Institute under MAKAUT, NAAC accredited A Grade)</h4>
            <h2>Previous Year Question Papers</h2>
        </div>
    </div>

    <!-- Input Search Form  -->
    <div class="container p-0">
        <form action="index.php" method="POST" enctype="multipart/form-data" class="search_form_container">
            <div class="input_container">
                <label for="course" class="input_label">Course : </label>
                <select name="course" id="course" class="input_field">
                    <option value="null" selected>-Select-</option>
                    <option value="btech">B.TECH</option>
                    <option value="mtech">M.TECH</option>
                </select>
            </div>
            <div class="input_container">
                <label for="department" class="input_label">Dept. : </label>
                <select name="dept" id="department" class="input_field">
                    <option value="null" selected>-Select-</option>
                    <option value="cse">CSE</option>
                    <option value="IT">IT</option>
                    <option value="Ceramic">Ceramic</option>
                </select>
            </div>
            <div class="input_container">
                <label for="sem" class="input_label">Sem : </label>
                <select name="sem" id="sem" class="input_field">
                    <option value="0" selected>-Select-</option>
                    <option value="1">I</option>
                    <option value="2">II</option>
                    <option value="3">III</option>
                    <option value="4">IV</option>
                    <option value="5">V</option>
                    <option value="6">VI</option>
                    <option value="7">VII</option>
                    <option value="8">VIII</option>
                </select>
            </div>
            <div class="input_container">
                <label for="term" class="input_label">Term : </label>
                <select name="term" id="term" class="input_field">
                    <option value="null" selected>-Select-</option>
                    <option value="mid1">Mid-Term 1</option>
                    <option value="mid" 2>Mid-Term 2</option>
                    <option value="end">End-Sem</option>
                </select>
            </div>
            <div class="input_container">
                <label for="year" class="input_label">Year : </label>
                <select name="year" id="year" class="input_field">
                    <option value="null" selected>-Select-</option>
                    <option value="2021">2021</option>
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                </select>
            </div>
            <div class="input_container">
                <button name="sub" id="sub" type="submit" class="search_btn">Search</button>
            </div>
        </form>
    </div>
  
    <!-- Data Table -->
    <div class="container tabel table-responsive p-3">
        <table class="table table-striped table-bordered data_table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Course</th>
                    <th scope="col" class="text-center">Stream</th>
                    <th scope="col" class="text-center">PaperCode</th>
                    <th scope="col" class="text-center">PaperName</th>
                    <th scope="col" class="text-center">Year</th>
                    <th scope="col" class="text-center">Download</th>
                </tr>
            </thead>
            <?php
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td class="text-center"><?php echo $row['course'];?></td>
                <td class="text-center"><?php echo $row['dept'];?></td>
                <td class="text-center"><?php echo $row['papercode'];?></td>
                <td class="text-center"><?php echo $row['papername'];?></td>
                <td class="text-center"><?php echo $row['year'];?></td>
                <td class="text-center"><a href="index.php?file_id=<?php echo $row['files']?>" class="download_icon"><i
                            class="fa-solid fa-download"></i></a></td>
            </tr>
            <?php   
                        }
                    }
            ?>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <!-- </body> -->
</body>
<!-- <script src="function.js"></script> -->

</html>