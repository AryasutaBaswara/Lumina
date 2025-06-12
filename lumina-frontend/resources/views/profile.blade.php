<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Profile</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      /* background: #ffffff; */
      padding: 20px;
      text-align: center;
      background: linear-gradient(to left, rgba(154, 174, 179, 0.3), #ffffff);
      margin: 0;
      min-height: 95vh;
    }

    .container {
      background-color:rgb(255, 255, 255);
      /* max-width: 400px; */
      color:rgb(0, 0, 0);
      margin: 7rem auto;
      padding: 0.5rem;
      /* padding-bottom: 1rem; */
      width: 600px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(107, 107, 107, 0.5);
      text-align: center;
    }

    h2 {
      margin-bottom: 2rem;
      /* color: #333; */
      font-size: 2rem;
      /* text-align: center; */
    }

    p {
      font-size: 1.5rem;
      margin: 10px 0;
      /* color: #555; */
    }

    span {
      font-weight: bold;
      /* color: #222; */
    }

    .avatar-placeholder {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background-color: #ddd;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 2rem auto 2rem;
    }

    .back{
      display: flex;
      margin-left: 2rem;
      transition: all 0.5s ease;
    }

    .back:hover{
      transform: scale(1.1);
      transform: translateX(-0.5rem);
    }

    .back img{
      transform: translateY(1.1rem);
    }
    .info-wrap {
      margin-bottom: 2rem;
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      padding: 0.5rem 1.5rem;
    }

    .label {
      font-weight: bold;
      text-align: left;
      color:rgba(155, 155, 155, 0.7);
    }

    .value {
      text-align: right;
      font-weight: 100;
    }
  .logout svg{
    width: 25px;
    height: 25px;
    margin-left: 1.5rem;
    transform: translateY(0.75rem);
    fill: red;
  }

  .logout p{
    margin-left: 1rem;
    font-size: 1.5rem;
    font-weight: bold;
  }
  .logout{
    display: flex;
    margin-top: 1rem;
    margin-bottom: -1rem;
    cursor: pointer;
    transition: all 0.5s ease;
    color: red;
    width: 160px;
  }

  .logout:hover{
    transform: scale(1.05);
    transform: translateX(0.2rem);
  }

  </style>
</head>
<body>
  <div class="back" onclick="window.location.href='/dashboard'" style="cursor: pointer;">
    <a href="/Dashboard">
      <img src="image/angle-left-solid.svg" alt="angle-left" style="width: 24px; height: 24px;">
    </a>
    <h3>Dashboard</h3>
  </div>

  <div class="container">
    <h2>My Profile</h2>
    <div class="avatar-placeholder">
      <i class="fas fa-user fa-4x"></i>
    </div>

    <div class="info-wrap">
      <div class="info-row">
        <p class="label">Name :</p>
        <p style="font-weight: bold;" class="value" id="userName">Raphinha</p>
      </div>
      <div class="info-row">
        <p class="label">Email :</p>
        <p class="value" id="userEmail">raphinha@gmail.com</p>
      </div>
      <div class="logout" onclick="logout()">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
        <p>Log out</p>
      </div>
    </div>
    
    <!-- <button onclick="backToDashboard()">Back</button> -->
  </div>

  <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.10/firebase-auth-compat.js"></script>
  <script>
    const firebaseConfig = {
      apiKey: "AIzaSyB_xZca3wrB-HqvbjFAfVrRsps89Nink8A",
      authDomain: "lumina-skin-care.firebaseapp.com",
      projectId: "lumina-skin-care",
      storageBucket: "lumina-skin-care.firebasestorage.app",
      messagingSenderId: "654070228073",
      appId: "1:654070228073:web:518f9ee3cd86810bf62ef8",
      measurementId: "G-862L34YL7X"
    };
    firebase.initializeApp(firebaseConfig);
  </script>

  <script>
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        document.getElementById("userEmail").textContent = user.email;
        const name = localStorage.getItem("userName") || "Tidak diketahui";
        document.getElementById("userName").textContent = name;
      } else {
        alert("Kamu belum login!");
        window.location.href = "../lumina-auth-test/index.html";
      }
    });

    function logout() {
      Swal.fire({
        title: 'Yakin ingin logout?',
        text: "Kamu akan keluar dari akun ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, logout',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          localStorage.removeItem("isLoggedIn");
          localStorage.removeItem("token");
          localStorage.removeItem("userName");
          localStorage.setItem("logoutSuccess", "true");

          window.location.href = "/auth";
        }
      });
    }

    function backToDashboard() {
      window.location.href = "/dashboard";
    }
  </script>
</body>
</html>
