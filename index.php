<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careon - Career Assessment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="assets/careon.css" rel="stylesheet">
</head>
<body class="landing-layout">
<nav class="landing-nav">
    <a href="index.php" class="landing-logo"><img src="images/logo.png" alt="Careon" height="35"></a>
    <div class="landing-nav-links d-none d-md-flex">
        <a href="index.php">Home</a><a href="#features">Features</a><a href="#about">About</a>
    </div>
    <div class="d-flex gap-2">
        <a href="login.php" class="btn-careon-outline btn-careon-sm">Login</a>
        <a href="register.php" class="btn-careon-primary btn-careon-sm">Get Started</a>
    </div>
</nav>

<section class="hero-section">
    <div class="hero-content">
        <div class="hero-tag">CAREER DEVELOPMENT PLATFORM</div>
        <h1 class="hero-title">
            Your Personalized <br>
            Career Companion
        </h1>
        <p class="hero-desc">Discover your skills, build your career, and let Careon be your side. Navigate your professional journey with precision and mentorship.</p>
        <div class="d-flex gap-3 flex-wrap">
            <a href="login.php" class="btn-careon-outline" style="padding:13px 28px;font-size:15px;color:white;border-color:rgba(255,255,255,0.35);">Start for Free</a>
        </div>
    </div>
    <div class="hero-visual" style="padding:0;overflow:hidden;">
        <img src="images/career_planning.jpg" alt="Career Planning"style="width:100%;height:100%;object-fit:cover;object-position:center 70%;border-radius:16px;opacity:0.88;">
    </div>
</section>

<section class="why-section" id="features">
    <div class="text-center mb-5">
        <p style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--red);margin-bottom:8px;">Career Journey Flow</p>
        <h2 class="why-title">Why Careon?</h2>
        <p class="why-subtitle">Everything you need to plan, grow, and land your dream career.</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4"><div class="feature-card"><div class="feature-title">Smart Asassment</div><p class="feature-desc">Our system analyzes your strengths, personality, and market demand to recommend the perfect career path for you.</p></div></div>
        <div class="col-md-4"><div class="feature-card"><div class="feature-title">Personal Roadmap</div><p class="feature-desc">Step-by-step learning roadmap with checkpoints, projects, and milestones designed specificially for your goals.</p></div></div>
        <div class="col-md-4"><div class="feature-card"><div class="feature-title">Dynamic Result</div><p class="feature-desc">The dashboard results change according to the latest answers.</p></div></div>
    </div>
</section>

<section id="about" style="background:var(--cream);padding:72px 48px;text-align:center;">
    <p style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--red);">Careon Prototype</p>
    <h2 class="why-title" style="font-size:28px;">Bridging the gap between career dreams and innovation</h2>
    <p style="color:var(--gray-600);max-width:650px;margin:12px auto 0;">Careon helps students explore career paths, measure their readiness, and build structured learning journeys through assessments and personalized roadmaps.</p>
</section>
</body>
</html>
