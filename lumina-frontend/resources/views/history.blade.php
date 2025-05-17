<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Analisis Skincare</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      min-height: 92vh;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .history-container {
      display: flex;
      flex-direction: column;
      gap: 2rem;
      max-width: 1000px;
      margin: auto;
      margin-bottom: 2rem;
    }

    .history-card {
      background: white;
      padding: 20px;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      display: flex;
      gap: 20px;
      align-items: flex-start;
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

    button {
      margin: 1rem auto 0;
      display: block;
      padding: 10px 20px;
      background: black;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.3s ease;
    }

    button:hover {
      background: #333;
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

  </style>
</head>
<body>

  <main style="flex: 1;">
    <h2>Riwayat Analisis Skincare</h2>

    <div class="empty-state" id="noHistoryMessage" style="display: none;">
      <p>Belum ada riwayat analisis.<br>Silakan unggah foto wajah terlebih dahulu.</p>
    </div>

    <div class="history-container" id="historyContainer"></div>
  </main>

  <button onclick="backToMain()">Back</button>

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
