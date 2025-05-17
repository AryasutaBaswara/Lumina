<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />
  <link href="https://fonts.googleapis.com/css2?family=Ballet&family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">
  <title>Welcome | Lumina</title>
</head>

<body>
<header>
  <h1>LUMINA</h1>
  <nav class="nav-mid">
    <a href="#">Home</a>
    <a href="#">How it Works</a>
    <a href="#">About</a>
  </nav>
  <nav class="nav-auth">
    <a href="/auth" class="btn-login">Log In</a>
    <a href="/auth?form=register" class="btn-signup">Sign Up</a>
  </nav>
</header>

<section class="hero">
  <div class="text-layer">
      <div class="porcelain-skin-text">
          <div class="text-layer-porcelain">
                <div class="text-p">
                <span class="letter-p">P</span>
                </div>
              <div class="text-orcelain">
                <span class="porcelain">ORCELAIN</span>
                </div>
              </div>
          <div class="text-layer-skin">
                    <div class="text-skin">
                    <span class="skin">SKIN</span>
        </div>
      </div>
  </div>
  <div class="img-layer-1">
    <img src="image/freepik__35mm-film-photography-a-stunning-young-woman-with-__57713.png" alt="gambar-orang">
  </div>
  <div class="hero-text">
    <h2>Timeless Beauty, Perfected</h2>
    <p>A revolutionary AI skincare advisor tailored just for your skin.</p>
    <button onclick="window.location.href='/auth'" class="btn-start">Start Now</button>
  </div>
</section>

<section class="section-redef">
  <div class="line-1"></div>
  <h3>REDEFINING SKINCARE THROUGH INNOVATION</h3>
  <div class="line-2"></div>
</section>

<div class="about-container">
  <div class="background-img2"></div>
  <span class="letter-p-2">A</span>
  <span class="letter-p-3">L</span>
  <div class="img-layer-2">
    <img src="image/Adobe Express - file 1.png" alt="gambar-orang">
  </div>
  <div class="about-wrapper">
    <section class="section-about">
      <h3>ABOUT LUMINA</h3>
      <p>Lumina is an AI-powered skincare platform that analyzes your skin and provides personalized recommendations. We make skincare simple, effective, and tailored to you.</p>
    </section>

    <section class="section-our">
      <h3>OUR STORY</h3>
      <p>Skincare should not be complicated. With endless products and advice, finding what works can be overwhelming. Lumina was created to cut through the confusion, using technology to help you understand your skin and care for it with confidence.</p>
    </section>
  </div>
</div>

<div class="smart-how-wrapper">
  <section class="smart">
    <div class="smart-title">
      <h3>SMART SKINCARE, POWERED BY AI</h3>
      <p>Our facial analysis technology accurately detects your skin’s needs and provides data-driven recommendations, allowing you to care for your skin in a smarter and more effective way.</p>
    </div>
  </section>
  <section class="section-how">
    <h3>HOW IT WORKS</h3>
    <div class="features">
      <div class="feature-box">
        <h4>Step 1</h4>
        <div class="feature-box-wrapper">
          <h5>Upload Your Photo</h5>
          <p>Choose a clear photo from your gallery, and let our AI analyze your skin with precision.</p>
        </div>
      </div>
      <div class="feature-box">
        <h4>Step 2</h4>
        <div class="feature-box-wrapper">
          <h5>AI-Powered Skin Analysis</h5>
          <p>Our advanced AI technology detects key skin concerns, from hydration levels to fine lines, providing data-driven insights.</p>
        </div>
      </div>
      <div class="feature-box">
        <h4>Step 3</h4>
        <div class="feature-box-wrapper">
          <h5>Skincare Recommendations</h5>
          <p>Receive a curated selection of skincare products tailored to your unique skin needs, ensuring the best possible results.</p>
        </div>
      </div>
    </div>
  </section>
</div>

<section class="section-beyond">
  <span class="letter-b">B</span>
  <span class="eyond">EYOND</span>
  <span class="the-glow">THE GLOW</span>
  <div class="img-layer-3">
    <img src="image/Women-3.png" alt="women-3">
  </div>
  <div class="beyond-text">
    <h2>EVERY SKIN HAS A STORY, LET'S UNDERSTAND YOURS</h2>
    <p>Your skin is unique, and every concern tells a story. From dryness to acne, understanding your skin is the key to the perfect routine.
    Discover skin concerns and find the best care for you</p>
    <button onclick="window.location.href='/auth'" class="btn-start">Explore Now</button>
  </div>
</section>

<section class="section-why">
  <h3>Why Lumina?</h3>
  <div class="features-why">
    <div class="feature-box-why">
      <h3>1</h3>
      <div class="why-wrapped">
        <h4>Personalized for You</h4>
        <p>No more one-size-fits-all routines. Lumina's AI analyzes your skin and tailors recommendations based on your unique needs, ensuring every product works for you.</p>
      </div>
    </div>
    <div class="feature-box-why">
      <h3>2</h3>
      <div class="why-wrapped">
        <h4>Backed by Technology</h4>
        <p>Powered by advanced AI, Lumina provides accurate skin insights, so you can make informed decisions and achieve real results with confidence.</p>
      </div>
    </div>
    <div class="feature-box-why">
      <h3>3</h3>
      <div class="why-wrapped">
        <h4>Effortless & Convenient</h4>
        <p>Simply upload a photo, and let Lumina do the rest. No complicated quizzes, no trial and error, just instant, expert-backed recommendations.</p>
      </div>
    </div>
    <div class="feature-box-why">
      <h3>4</h3>
      <div class="why-wrapped">
        <h4>Result-Driven Approach</h4>
        <p>Every recommendation is designed with effectiveness in mind, helping you achieve healthier, radiant skin with science-backed solutions.</p>
      </div>
    </div>
  </div>
</section>

<section class="section-join">
  <div class="join-wrapped">
    <h3>Join the Lumina Collective</h3>
    <button onclick="window.location.href='/auth'" class="btn">Join Now</button>
  </div>
  <div class="join-img-wrapped">
    <div class="background-img3"></div>
    <span class="letter-a">A</span>
    <span class="letter-l">L</span>
    <div class="img-layer-4">
      <img src="image/women-4.png" alt="gambar-orang">
    </div>
  </div>
</section>

<footer>
  <div class="lumina-footer">
    <h3>LUMINA</h3>
    <p>Your skin is unique, and every concern tells a story. From dryness to acne, understanding your skin is the key to the perfect routine.
    Discover skin concerns and find the best care for you</p>
    <div class="social-media">
      <img src="image/instagram-brands.svg" alt="instagram">
      <img src="image/x-twitter-brands.svg" alt="x">
      <img src="image/github-brands.svg" alt="github">
    </div>
  </div>
  <div class="copy">
    &copy; Lumina. All rights reserved.
  </div>
</footer>

</body>
</html>
