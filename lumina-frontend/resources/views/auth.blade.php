<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Lumina Login/Register</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      margin: 0;
      display: flex;
      height: 100vh;
      width: 100%;
    }

    .left {
      flex: 1;
      padding: 4rem;
      display: flex;
      flex-direction: center;
      justify-content: center;
      align-items: center; 
      /* position: relative; */
    }

    .right {
      flex: 1;
      background-color: #dfe6e9;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 99;
    }

    .form-title {
      font-size: 50px;
      font-weight: 500;
      margin-bottom: 0.5rem;
      width: 30vw;
    }
    .form-sub {
      color: gray;
      margin-bottom: 3rem;
      font-size: 24px;
    }
    .form-sub a {
      color: #446;
      text-decoration: none;
      font-weight: 500;
    }

    label {
      font-size: 20px;
      display: block;
      margin-top: 0.7rem;
      margin-bottom: 0.7rem;
      font-weight: 400;
    }
    input {
      /* width: 100%; */
      padding-left: 4rem;
      padding-bottom: 5px;
      /* border-radius: 8px; */
      border: none;
      background-color: #F2F2F2;
      height: 70px;
      width: 500px;
      /* margin-bottom: 10px; */
      font-size: 20px;
      z-index: 1;
    }

    .register-button {
      /* width: 100%; */
      padding: 1.3rem 5rem;
      border: none;
      background-color: #94aebc;
      color: white;
      width: 500px;
      /* font-weight: bold; */
      font-size: 20px;
      /* border-radius: 8px; */
      cursor: pointer;
      margin-top: 2.5rem;
      transition: all 0.5s ease;
    }

    .login-button {
      /* width: 100%; */
      padding: 1.3rem 5rem;
      width: 500px;
      border: none;
      background-color: #94aebc;
      color: white;
      /* font-weight: bold; */
      font-size: 20px;
      /* border-radius: 8px; */
      cursor: pointer;
      margin-top: 2.5rem;
      transition: all 0.5s ease;
    }

    .register-button:hover, .login-button:hover{
      transform: scale(1.05);
    }

    .toggle-link {
      margin-top: 1rem;
      display: block;
      color: #446;
      font-size: 14px;
      text-decoration: none;
    }

    .icon{
      width: 30px;
      height: 30px;
      transform: translate(-30.3rem, 0.5rem);
      z-index: 2;
    }

    .input-group, .output-group {
      position: relative;
    }

    .eye-icon {
      width: 30px;
      height: 30px;
      position: absolute;
      top: 50%;
      right: 100px;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .register-form, .login-form{
      position: fixed;
      top: 50%;
      left: 10%;
      transform: translateY(-50%);
    }

    .back{
      display: flex;
      height: 5vh;
      gap: 4rem;
      margin-left: 3rem;
      position: fixed; /* Tambahkan ini */
      top: 0;
      left: 0;
      z-index: 100; /* Pastikan tetap muncul di atas */
      background-color: transparent; /* Opsional: hindari transparan */
      width: 100%; /* Agar tetap sejajar atas */
      padding-top: 1rem; /
    }

    .back h3{
      font-size: 24px;
    }

    .back h4{
      font-size: 20px;
    }

    .back-child{
      display: flex;
      transition: all 0.5s ease;
    }

    .back-child:hover{
      transform: scale(1.1);
    }

    .back-child img{
      transform: translateY(1.9rem);
    }

    #login-error, #register-error {
      display: none;
      color: red;
      font-size: 20px;
      margin-top: 10px;
      margin-bottom: -1rem;
      padding: 0;
    } 

  </style>

  <script type="module" src="{{ asset('js/firebase_auth_test.js') }}"></script>

</head>
<body>
  <div class="back">
    <h3>LUMINA</h3>
    <div class="back-child" onclick="window.location.href='/'" style="cursor: pointer;">
    <a href="/welcome">
      <img src="image/angle-left-solid.svg" alt="angle-left" style="width: 24px; height: 24px;">
    </a>
    <h4>Home</h4>
    </div>
  </div>
  <div class="left">
    <form class="login-form" id="login-form">
      <div class="form-title">Login</div>
      <div class="form-sub">Not a member yet? <a href="#" onclick="toggleForm('register')">Register</a></div>
      <label for="login-email">Email</label>
      
      <input type="email" id="login-email" placeholder="Email" required />
      <img class="icon" src="image/envelope-regular.svg" alt="">

      <label for="login-password">Password</label>

      <div class="input-group">
        <input type="password" id="login-password" placeholder="Password" required />
        <img class="icon" src="image/lock-solid.svg" alt="">
        <img id="eye-slash" class="eye-icon" src="image/eye-slash-regular.svg" alt="Show">
        <img id="eye" class="eye-icon" src="image/eye-regular.svg" alt="Hide" style="display: none;">
      </div>
      <p id="login-error"></p>
      <button class="login-button" id="loginBtn" type="button">Login</button>
    </form>

    <form class="register-form" id="register-form" style="display: none;">
      <div class="form-title">Create new account</div>
      <div class="form-sub">Already a member? <a href="#" onclick="toggleForm('login')">Log In</a></div>
      <label for="register-name">Username</label>

      <input type="text" id="register-name" placeholder="Username" required />
      <img class="icon" src="image/circle-user-regular.svg" alt="">

      <label for="register-email">Email</label>
      <input type="email" id="register-email" placeholder="Email" required />
      <img class="icon" src="image/envelope-regular.svg" alt="">

      <label for="register-password">Password</label>

      <div class="output-group">
        <input type="password" id="register-password" placeholder="Password" required />
        <img class="icon" src="image/lock-solid.svg" alt="">
        <img id="eye-slash-reg" class="eye-icon" src="image/eye-slash-regular.svg" alt="Show">
        <img id="eye-reg" class="eye-icon" src="image/eye-regular.svg" alt="Hide" style="display: none;">
      </div>

      <p id="register-error"></p>
      <button class="register-button" id="registerBtn" type="button">Create Account</button>
    </form>
  </div>
  <div class="right">
    <img src="image/Flux_Dev_Professional_graphic_design_3D_render_A_highquality_3_3 2 (1).png" alt="Skincare Illustration" style="width: 100%; height: 100%; object-fit: cover;" />
  </div>  
  
  <script>
    function toggleForm(type) {
      document.getElementById("login-form").style.display = type === "login" ? "block" : "none";
      document.getElementById("register-form").style.display = type === "register" ? "block" : "none";
    }

    window.onload = function () {
      const urlParams = new URLSearchParams(window.location.search);
      const formType = urlParams.get("form");
      if (formType === "register") {
        toggleForm("register");
      }
    };
  </script>
  <script>
    const passwordInput = document.getElementById('login-password');
    const eyeSlash = document.getElementById('eye-slash');
    const eye = document.getElementById('eye');

    eyeSlash.addEventListener('click', function () {
      passwordInput.type = 'text';
      eyeSlash.style.display = 'none';
      eye.style.display = 'inline';
    });

    eye.addEventListener('click', function () {
      passwordInput.type = 'password';
      eye.style.display = 'none';
      eyeSlash.style.display = 'inline';
    });

    const pwdReg = document.getElementById('register-password');
    const eyeSlashReg = document.getElementById('eye-slash-reg');
    const eyeReg = document.getElementById('eye-reg');

    eyeSlashReg.addEventListener('click', () => {
      pwdReg.type = 'text';
      eyeSlashReg.style.display = 'none';
      eyeReg.style.display = 'inline';
    });

    eyeReg.addEventListener('click', () => {
      pwdReg.type = 'password';
      eyeReg.style.display = 'none';
      eyeSlashReg.style.display = 'inline';
    });
  </script>

</body>
</html>
