<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="icon" type="image/png" href="{{ asset('Logo.png') }}">
  <title>History Lumina</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to top, rgba(154, 174, 179, 0.3), #ffffff);
      margin: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      min-height: 96vh;
    }

    h2 {
      text-align: center;
      color: #333;
      font-size: 2rem;
      margin-bottom: 30px;
    }

    .history-container {
      display: flex;
      flex-direction: column;
      gap: 2rem;
      max-width: 1000px;
      margin: auto;
      margin-bottom: 1rem;
    }

    .history-card {
      background: white;
      padding: 20px;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      display: flex;
      gap: 20px;
      align-items: flex-start;
      transition: transform 0.2s ease;
    }

    .history-card:hover{
      transform: translateY(-4px);
    }

    .history-card img {
      width: 120px;
      border-radius: 0.5rem;
      object-fit: cover;
    }

    .recommendation-list {
      flex: 1;
    }

    .recommendation-item {
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px dashed #ccc;
    }

    .recommendation-item:last-child {
      border-bottom: none;
    }

    .recommendation-type {
      background: #e0f7fa;
      color: #00796b;
      display: inline-block;
      padding: 4px 10px;
      border-radius: 5px;
      font-size: 0.8rem;
      margin-bottom: 5px;
    }

    .recommendation-name {
      font-weight: bold;
      margin-bottom: 4px;
    }

    .recommendation-description {
      font-size: 0.9rem;
      color: #555;
    }

    .timestamp {
      font-size: 0.85rem;
      color: #888;
      margin-top: 10px;
    }

    .empty-state {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      color:rgba(112, 112, 112, 0.6); 
      font-size: 1.5rem;
      z-index: 2;
      transform: translateY(17rem);
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
    footer {
      text-align: center;
      color: rgba(163, 163, 163, 0.75);
      font-size: 20px;
      margin-top: auto;
      padding-top: 20px;
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

  <main style="flex: 1;">
    <h2>History</h2>
    <div class="empty-state" id="noHistoryMessage" style="display: none;">
      <p>Belum ada riwayat analisis.<br>Silakan unggah foto wajah terlebih dahulu.</p>
    </div>

    <div class="history-container" id="historyContainer"></div>
    <footer>
      ----- Lumina serve with all our hearts -----
    </footer>
  </main>
  
  
  <!-- <button onclick="backToMain()">Back</button> -->

  <script>
    async function fetchHistory() {
      const token = localStorage.getItem("token");
      if (!token) {
        alert("Kamu belum login.");
        window.location.href = "../lumina-auth-test/index.html";
        return;
      }

      try {
        const res = await fetch("http://localhost:8080/history/user", {
          headers: { Authorization: "Bearer " + token },
        });
        const histories = await res.json();

        const noHistoryEl = document.getElementById("noHistoryMessage");

        if (histories.length === 0) {
          noHistoryEl.style.display = "flex";
          return;
        }

        const container = document.getElementById("historyContainer");

        for (let i = 0; i < histories.length; i++) {
          const history = histories[i];

          const recRes = await fetch(`http://localhost:8080/skincare_recommendation/analysis/${history.analysis_id}`);
          const recommendations = await recRes.json();

          const card = document.createElement("div");
          card.className = "history-card";

          const image = document.createElement("img");
          image.src = history.image.image_url;
          card.appendChild(image);

          const recWrapper = document.createElement("div");
          recWrapper.className = "recommendation-list";

          recommendations.forEach((rec) => {
            const item = document.createElement("div");
            item.className = "recommendation-item";

            item.innerHTML = `
              <div class="recommendation-type">${rec.skincare_type}</div>
              <div class="recommendation-name">${rec.skincare_name}</div>
              <div class="recommendation-description">${rec.description}</div>
            `;

            recWrapper.appendChild(item);
          });

          const time = document.createElement("div");
          time.className = "timestamp";
          time.textContent = `Diupload pada: ${new Date(history.image.uploaded_at).toLocaleString()}`;

          recWrapper.appendChild(time);
          card.appendChild(recWrapper);
          container.appendChild(card);
        }
      } catch (err) {
        console.error(err);
        alert("Gagal mengambil data history");
      }
    }

    function backToMain() {
      window.location.href = "/dashboard";
    }

    fetchHistory();

  </script>
</body>
</html>
