// 1. Import Firebase SDK
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import {
  getAuth,
  createUserWithEmailAndPassword,
  signInWithEmailAndPassword,
  updateProfile,
} from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

// 2. Konfigurasi Firebase
const firebaseConfig = {
  apiKey: "AIzaSyB_xZca3wrB-HqvbjFAfVrRsps89Nink8A",
  authDomain: "lumina-skin-care.firebaseapp.com",
  projectId: "lumina-skin-care",
  storageBucket: "lumina-skin-care.appspot.com",
  messagingSenderId: "654070228073",
  appId: "1:654070228073:web:518f9ee3cd86810bf62ef8",
};

// 3. Inisialisasi Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

function toggleForm(type) {
  if (type === "register") {
    document.getElementById("login-form").style.display = "none";
    document.getElementById("register-form").style.display = "block";
  } else {
    document.getElementById("login-form").style.display = "block";
    document.getElementById("register-form").style.display = "none";
  }
}
// 4. Fungsi Register
export async function register() {
  const name = document.getElementById("register-name").value;
  const email = document.getElementById("register-email").value;
  const password = document.getElementById("register-password").value;
  const registerBtn = document.getElementById("registerBtn");

  registerBtn.textContent = "⏳ Registering..."; // Tambahkan loader
  registerBtn.disabled = true;

  try {
    const userCredential = await createUserWithEmailAndPassword(
      auth,
      email,
      password
    );
    const user = userCredential.user;
    await updateProfile(user, { displayName: name });
    const idToken = await user.getIdToken();

    // Kirim data user ke backend
    const response = await fetch("http://localhost:8080/auth/register", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        firebase_uid: user.uid,
        name: name, // Nama sementara dari email
        email: email,
        password: password,
      }),
    });

    const data = await response.json();
    console.log("Register Response:", data);

    document.getElementById("register-error").style.display = "none";

    Swal.fire({
      icon: 'success',
      title: 'Register Berhasil',
      text: data.message,
      timer: 3000,
      showConfirmButton: false
    }).then(() => {
      toggleForm("login");
    });

  } catch (error) {
    console.error("Register Error:", error.message);
    const errorMsg = document.getElementById("register-error");

    if (error.code === "auth/email-already-in-use") {
      errorMsg.textContent = "Email sudah digunakan. Silakan gunakan email lain.";
    } else if (error.code === "auth/weak-password") {
      errorMsg.textContent = "Password terlalu lemah. Minimal 6 karakter.";
    } else {
      errorMsg.textContent = "Invalid Credential";
    }
    errorMsg.style.display = "block";
    setTimeout(() => {
      errorMsg.style.display = "none";
    }, 5000);

  } finally {
    registerBtn.textContent = "Register";
    registerBtn.disabled = false;
  }
}

// 5. Fungsi Login dan Ambil Token ID
export async function login() {
  const email = document.getElementById("login-email").value;
  const password = document.getElementById("login-password").value;
  const loginBtn = document.getElementById("loginBtn");

  loginBtn.textContent = "⏳ Logging in..."; // Tambahkan loader
  loginBtn.disabled = true;

  try {
    const userCredential = await signInWithEmailAndPassword(
      auth,
      email,
      password
    );
    const user = userCredential.user;
    const idToken = await user.getIdToken();

    console.log("Firebase Token:", idToken); // Debug token di console
    console.log("Sending token to backend:", idToken);

    const response = await fetch("http://localhost:8080/auth/login", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ token: idToken }),
    });

    if (!response.ok) {
      // Jika status bukan 200, ambil data error
      const errorData = await response.json();
      console.error("Login Error:", errorData);
      alert("Login gagal: " + errorData.error); // Tampilkan pesan kesalahan
      return; // Keluar dari fungsi jika ada kesalahan
    }

    const data = await response.json();
    console.log("Login Response:", data);

    // ✅ Simpan username & token di localStorage
    localStorage.setItem('isLoggedIn', 'true');
    localStorage.setItem('token', idToken);
    localStorage.setItem('userName', data.user.name); // ⬅️ ini penting

    Swal.fire({
      icon: 'success',
      title: 'Berhasil Login!',
      text: data.message,
      timer: 3000,
      showConfirmButton: false
    }).then(() => {
      window.location.href = "/dashboard";
    });

  } catch (error) {
    console.log("🔥 Full Firebase Error Object:", error);
    console.error("Login Error:", error.message);
    const errorMessage = document.getElementById("login-error");

    if (error.code === "auth/invalid-credential" || error.code === "auth/wrong-password" || error.code === "auth/invalid-email") {
      errorMessage.textContent = "Email atau password salah.";
    } else {
      errorMessage.textContent = "Terjadi kesalahan saat login.";
    }
  
    errorMessage.style.display = "block";
  
    // Sembunyikan setelah 3 detik
    setTimeout(() => {
      errorMessage.style.display = "none";
    }, 5000);

  } finally {
    loginBtn.textContent = "Login";
    loginBtn.disabled = false;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const loginBtn = document.getElementById("loginBtn");
  const registerBtn = document.getElementById("registerBtn");

  if (loginBtn) loginBtn.addEventListener("click", login);
  if (registerBtn) registerBtn.addEventListener("click", register);
});
