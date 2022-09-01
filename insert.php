<?php
$username = $_POST['username'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$email = $_POST['email'];

if (!empty($username) || !empty($password) || !empty($email)) {
    # code...
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "login_sql";

    //sql csatlakozás
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

    if (mysqli_connect_error()){
        die('Connnect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else{
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register ( username, password, email) values(?,?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt ->bind_param("s", $email
        $stmt->execute();
        $stmt->bind_result($resultEmail);
        $stmt->store_result();
        $stmt->fetch();
        $rnum = $stmt->num_rows;
        if ($rnum == 0) {
            $stmt->close();
            $stmt = $conn->prepare($Insert);
            $stmt->bind_param("ssssii",$username, $password, $email);
            if ($stmt->execute()) {
                echo "Sikeres művelet";
            }
            else {
                echo $stmt->error;
            }
        }
        else {
            echo "Valaki regisztrált már ezzel az email címmel.";
        }
        $stmt->close();
        $conn->close();
    }

} else{
    echo "Az összes kötelező!";
    die();
}
?>

