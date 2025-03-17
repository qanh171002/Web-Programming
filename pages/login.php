<?php
    if(isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST["submit"] == "Đăng nhập"){
            $username = $_POST["username"];
            $password = $_POST["password"];

            require_once('./admincp/config-database.php');
            $conn = openCon();

            $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($query);

            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['role'] = $row['role'];
                if(($_SESSION['id']) && $_SESSION['role'] == 2){
                    echo 
                    '
                    <script>
                        window.location.href = "index.php";
                    </script>
                    ';
                    exit();
                }
                elseif(($_SESSION['id']) && $_SESSION['role'] == 1){ 
                    // header("location: pages/adminpage/adminpage.php");
                    echo 
                    '
                    <script>
                        window.location.href = "pages/adminpage/adminpage.php";
                    </script>
                    ';
                    exit();
                }
            }
            else{
                echo 
                '
                <script>
                    alert("Sai tên đăng nhập hoặc mật khẩu");
                    window.location.href = "index.php?headermenu=login";
                </script>
                ';
                exit();
            }
        }
        elseif($_POST["submit"] == "Đăng ký"){
            echo '<script>window.location.href = "index.php?headermenu=register";</script>';
        }
    }
?>

<div class="container bg-light mt-5 mb-5" style="width: 600px">
    <div class="row">
        <h2 class="fw-bold text-center mt-2">ĐĂNG NHẬP</h2>
        <p>
            Nếu bạn chưa tài khoản, xin vui lòng bấm nút "Đăng ký" chuyển qua trang đăng ký.<br/>
        </p>
    </div>

    <form method="post" action="">
        <p>Tên đăng nhập*</p>
        <input type="text" class="form-control mb-3" name="username" placeholder="Username" value=''>
        <p>Password*</p>
        <input type="password" class="form-control mb-3" name="password" placeholder="Password" value=''>

        <div class="row">
            <div class="col">
                <input type="submit" class="form-control btn btn-outline-danger mt-3 mb-3" name="submit" value="Đăng nhập">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <input type="submit" class="form-control btn btn-outline-primary mt-3 mb-3" name="submit" value="Đăng ký">
            </div>
            
        </div>
    </form>
</div>