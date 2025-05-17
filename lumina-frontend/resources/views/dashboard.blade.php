<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Lumina</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
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
</head>
<body>
  <header class="header">
    <div class="logo">LUMINA</div>
    <nav class="nav">
      <a href="/dashboard">Dashboard</a>
      <a href="/history">History</a>
      <a href="#">Glow Tips</a>
    </nav>
    <button onclick="window.location.href='/profile'" class="profile-btn">Profile</button>
  </header>

  <main>
    <h1 class="greeting">Hello, <span id="userInfo">User</span>!</h1>
    <p class="subtitle">Let's find your perfect skincare!</p>

    <div class="upload-section">
      <label for="imageInput" class="upload-box">
      <div class="upload-text">Click here to start your skincare analysis</div>
        <button onclick="uploadImage()" class="analyze-btn">Analyze</button>
      </label>
      <input type="file" id="imageInput" onchange="updateFileName()" />
    </div>

    <div class="file-name" id="fileNameContainer" style="display: none;">
        <p id="fileName"></p>
        <div id="cancelButtonWrapper">
          <button style="background-color: red; color: rgb(255, 255, 255); padding: 15px 20px; border: none; border-radius: 10px; bottom: 10px; font-size: 20px; font-style: 'Arial', sans-serif; cursor: pointer;" type="button" onclick="cancelUpload()">Batal Upload</button>
        </div>
    </div>

    <div class="loading" id="loading"><span>Loading...</span></div>
    <div id="recommendations" class="recommendation-list"></div>

    <div class="field-text" id="story-text">
      <h3>Your Skin’s Story is Waiting to be Told!</h3>
      <p>You haven’t unlocked your personalized skincare insights yet. Start your analysis now and discover what your skin truly needs!</p>
    </div>
  </main>

  <script>
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        const name = localStorage.getItem("userName") || user.email;
        document.getElementById("userInfo").textContent = name;
      } else {
        alert("Kamu belum login!");
        window.location.href = "../lumina-auth-test/index.html";
      }
    });

    async function uploadImage() {
      const fileInput = document.getElementById('imageInput');
      const loading = document.getElementById('loading');

      if (fileInput.files.length === 0) {
        alert('Pilih gambar terlebih dahulu!');
        return;
      }

      const user = firebase.auth().currentUser;
      if (!user) {
        alert('Kamu harus login dulu!');
        return;
      }

      const token = await user.getIdToken();
      let formData = new FormData();
      formData.append('image', fileInput.files[0]);

      loading.style.display = 'block';

      try {
        let response = await fetch('http://localhost:8080/images/upload', {
          method: 'POST',
          body: formData,
          headers: { 'Authorization': `Bearer ${token}` }
        });
        if (response.ok) {
          await fetchLatestRecommendation();
        } else {
          alert('Gagal mengupload & menganalisis gambar');
          loading.style.display = 'none';
        }
      } catch (error) {
        console.error(error);
        alert('Terjadi kesalahan');
        loading.style.display = 'none';
      }
    }

    async function fetchLatestRecommendation() {
      const token = localStorage.getItem("token");
      if (!token) return;

      try {
        const res = await fetch("http://localhost:8080/skincare_recommendation/dashboard/recommendations", {
          headers: { Authorization: "Bearer " + token }
        });

        const recommendations = await res.json();
        const container = document.getElementById("recommendations");
        container.innerHTML = "";

        recommendations.forEach(rec => {
          const card = document.createElement("div");
          card.className = "card";
          card.innerHTML = `
            <div class="card-header">
              <h3>${rec.skincare_name}</h3>
              <span class="type-tag">${rec.skincare_type}</span>
            </div>
            <p>${rec.description}</p>
          `;
          container.appendChild(card);
        });
        container.style.display = "block";
        container.classList.add("with-result");
        loading.style.display = "none";
        document.getElementById("fileName").style.marginBottom = "2rem";
        document.getElementById("cancelButtonWrapper").style.display = "none";
        document.getElementById("story-text").style.display = "none";
        
      } catch (error) {
        console.error(error);
        container.style.display = "none";
      } 
    }
    
    function updateFileName() {
        const input = document.getElementById("imageInput");
        const fileName = document.getElementById("fileName");
        const container = document.getElementById("fileNameContainer");
  
        if (input.files.length > 0) {
          fileName.textContent = `File yang dipilih: ${input.files[0].name}`;
          container.style.display = "block";
        }
    }
  
    function cancelUpload() {
        const input = document.getElementById("imageInput");
        input.value = "";
        document.getElementById("fileNameContainer").style.display = "none";
    }

    function logout() {
      localStorage.clear();
      window.location.href = "../lumina-auth-test/index.html";
    }

  </script>
</body>
</html>
