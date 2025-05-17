<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <title>Profile</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #ffffff;
      padding: 20px;
      text-align: center;
    }

    .container {
      background-color: #9AAEB3;
      /* max-width: 400px; */
      color: #ffffff;
      margin: 7rem auto;
      padding: 0.5rem;
      width: 500px;
      height: 600px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(107, 107, 107, 0.5);
    }

    h2 {
      margin-bottom: 2rem;
      /* color: #333; */
      font-size: 3rem;
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

    button {
      margin: 10px;
      margin-top: 7rem;
      padding: 15px 30px;
      border: none;
      background-color: black;
      color: white;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      transform: scale(1.05);
    }

    .avatar-placeholder {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background-color: #ddd;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto 2rem;
    }

  </style>
</head>
<body>
  <div class="container">
    <h2>Profil Pengguna</h2>
    <div class="avatar-placeholder">
      <i class="fas fa-user fa-4x"></i>
    </div>
    <p><span id="userName">Memuat...</span></p>
    <p><span id="userEmail">Memuat...</span></p>

    <button onclick="backToDashboard()">Back</button>
    <button style="background-color: red;"onclick="logout()">Logout</button>
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
      localStorage.removeItem("isLoggedIn");
      localStorage.removeItem("token");
      localStorage.removeItem("userName");
      window.location.href = "/";
    }

    function backToDashboard() {
      window.location.href = "/dashboard";
    }
  </script>
</body>
</html>
