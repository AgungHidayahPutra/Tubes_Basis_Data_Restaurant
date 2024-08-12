<?php
$showPopupSalah = false;

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user == 'tubesBD' && $pass == 'tubesBD') {
        // login berhasil
    } else {
        $showPopupSalah = true; // Tandai bahwa popup harus ditampilkan
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Agbalumo&family=Poppins&family=Vina+Sans&display=swap" rel="stylesheet">
</head>

<body>
    <style>
        :root {
            --blue: #0ef;
            --white: #fcf2fa;
            --dark-blue: #06141e;
            --trans-blc: rgba(0, 0, 0, 0.9);
            --shadow-nav: 0 2px 10px 2px #0ef;
            --shadow: 1px 1px 10px 0 #0ef;
        }

        #togglePassword {
            margin-right: 10px;
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            background-color: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
            outline: none;
            font-size: 18px;
            color: var(--white);
        }

        .show-password::before {
            content: "\f06e";
            font-family: "Font Awesome 5 Free";
        }

        .hide-password::before {
            content: "\f070";
            font-family: "Font Awesome 5 Free";
        }

        input[type="submit"] {
            font-weight: bold;
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background-color: var(--dark-blue);
            color: white;
            border: none;
            cursor: pointer;
            border: 1px solid var(--blue);
            transition: .5s;
            border-radius: 10px;
        }

        input[type="submit"]:hover {
            background-color: var(--blue);
            color: black;
        }

        /* pop up */
        .popup-benar,
        .popup-salah {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            visibility: hidden;
            display: none;
        }

        .popup-benar img,
        .popup-salah img {
            width: 100px;
            border-radius: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .open-popup-benar,
        .open-popup-salah {
            display: block;
            visibility: visible;
            top: 50%;
            transform: translate(-50%, -50%) scale(1);
        }

        .popup-benar h1,
        .popup-salah h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .popup-benar p,
        .popup-salah p {
            color: #555;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .popup-benar button,
        .popup-salah button {
            background-color: var(--dark-blue);
            border: 1px solid var(--blue);
            color: var(--white);
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: 0.5s;
        }

        .popup-benar button:hover,
        .popup-salah button:hover {
            color: black;
            background-color: var(--blue);
        }

        /* login */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: var(--dark-blue);
            overflow: hidden;
        }

        .wrapper {
            position: relative;
            width: 400px;
            height: 500px;
        }

        .form-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            background: var(--dark-blue);
            border: 1px solid var(--blue);
            box-shadow: var(--shadow);
        }

        .wrapper.animate-signUp .form-wrapper.sign-in {
            transform: rotate(7deg);
            animation: animateRotate .7s ease-in-out forwards;
            animation-delay: .3s;
        }

        .wrapper.animate-signIn .form-wrapper.sign-in {
            animation: animateSignIn 1.5s ease-in-out forwards;
        }

        @keyframes animateSignIn {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-500px);
            }

            100% {
                transform: translateX(0) rotate(7deg);
            }
        }

        .wrapper .form-wrapper.sign-up {
            transform: rotate(7deg);
        }

        .wrapper.animate-signIn .form-wrapper.sign-up {
            animation: animateRotate .7s ease-in-out forwards;
            animation-delay: .3s;
        }

        @keyframes animateRotate {
            0% {
                transform: rotate(7deg);
            }

            100% {
                transform: rotate(0);
                z-index: 1;
            }
        }

        .wrapper.animate-signUp .form-wrapper.sign-up {
            animation: animateSignUp 1.5s ease-in-out forwards;
        }

        @keyframes animateSignUp {
            0% {
                transform: translateX(0);
                z-index: 1;
            }

            50% {
                transform: translateX(500px);
            }

            100% {
                transform: translateX(0) rotate(7deg);
            }
        }

        h2 {
            font-size: 30px;
            color: var(--white);
            text-align: center;
        }

        .input-group {
            position: relative;
            width: 320px;
            margin: 30px 0;
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 16px;
            color: var(--white);
            padding: 0 5px;
            pointer-events: none;
            transition: .5s;
        }

        .input-group input {
            width: 100%;
            height: 40px;
            font-size: 16px;
            color: var(--white);
            padding: 0 10px;
            background: transparent;
            border: 1px solid var(--blue);
            outline: none;
            border-radius: 5px;
            transition: 0.5s;
        }

        .input-group input:focus {
            box-shadow: var(--shadow);
            border: none;
        }

        .input-group input:focus~label,
        .input-group input:valid~label {
            top: 0;
            font-size: 12px;
            color: var(--white);
            background-color: transparent;

        }

        .forgot-pass {
            margin: -15px 0 15px;
        }

        .forgot-pass a {
            color: var(--white);
            font-size: 14px;
            text-decoration: none;
        }

        .forgot-pass a:hover {
            text-decoration: underline;
        }

        .sign-link {
            font-size: 14px;
            text-align: center;
            margin: 25px 0;
        }

        .sign-link p {
            color: var(--white);
        }

        .sign-link p a {
            color: var(--blue);
            text-decoration: none;
            font-weight: 600;
        }

        .sign-link p a:hover {
            text-decoration: underline;
        }
    </style>
    <div class="container">
        <div class="wrapper">
            <div class="form-wrapper sign-up">
                <form action="">
                    <h2>Sign Up</h2>
                    <div class="input-group">
                        <input type="text" required>
                        <label for="">Username</label>
                    </div>
                    <div class="input-group">
                        <input type="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="password" required>
                        <label for="">Password</label>
                    </div>
                    <input type="submit" value="Sign Up">
                    <div class="sign-link">
                        <p>Already have an account? <a href="#" class="signIn-link">Sign In</a></p>
                    </div>
                </form>
            </div>

            <div class="form-wrapper sign-in">
                <form action="" method="post">
                    <h2>Login</h2>
                    <div class="input-group">
                        <input type="text" id="username" name="username" required><br>
                        <label for="">Username</label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="passwordInput" name="password" required>
                        <label for="">Password</label>
                        <button type="button" id="togglePassword" onclick="togglePasswordVisibility()" class="show-password"></button>
                    </div>
                    <div class="forgot-pass">
                        <a href="#">Forgot Password?</a>
                    </div>
                    <input type="submit" name="login" value="Login">
                    <div class="sign-link">
                        <p>Don't have an account? <a href="#" class="signUp-link">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div class="popup-benar" id="popup-benar">
            <img src="../Img/Benar.png" alt="Benar">
            <h1>Login Successful</h1>
            <p>Your login was successful</p>
            <button type="button" onclick="closePopupBenar()">OKE!</button>
        </div>
        <div class="popup-salah" id="popup-salah">
            <img src="../Img/Salah.png" alt="Salah">
            <h1>Login Failed</h1>
            <p>Please try again</p>
            <button type="button" onclick="closePopupSalah()">Coba Lagi!</button>
        </div>
    </div>

    <script>
        <?php if (isset($_POST['login']) && $user == 'tubesBD' && $pass == 'tubesBD') : ?>
            showPopupBenar();
        <?php elseif ($showPopupSalah) : ?>
            showPopupSalah();
        <?php endif; ?>


        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            var togglePassword = document.getElementById("togglePassword");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePassword.classList.remove("show-password");
                togglePassword.classList.add("hide-password");
                togglePassword.setAttribute("aria-label", "Hide password");
            } else {
                passwordInput.type = "password";
                togglePassword.classList.remove("hide-password");
                togglePassword.classList.add("show-password");
                togglePassword.setAttribute("aria-label", "Show password");
            }
        }

        // popup

        function showPopupBenar() {
            var popup = document.getElementById("popup-benar");
            popup.classList.add("open-popup-benar");
        }

        function closePopupBenar() {
            var popup = document.getElementById("popup-benar");
            popup.classList.remove("open-popup-benar");
            window.location.href = "../Profil/profil.html";
        }

        function showPopupSalah() {
            var popup = document.getElementById("popup-salah");
            popup.classList.add("open-popup-salah");
        }

        function closePopupSalah() {
            var popup = document.getElementById("popup-salah");
            popup.classList.remove("open-popup-salah");
        }

        // login
        const wrapper = document.querySelector('.wrapper');
        const signUpLink = document.querySelector('.signUp-link');
        const signInLink = document.querySelector('.signIn-link');

        signUpLink.addEventListener('click', () => {
            wrapper.classList.add('animate-signIn');
            wrapper.classList.remove('animate-signUp');
        });

        signInLink.addEventListener('click', () => {
            wrapper.classList.add('animate-signUp');
            wrapper.classList.remove('animate-signIn');
        });
    </script>
</body>

</html>