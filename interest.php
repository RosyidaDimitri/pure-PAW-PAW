<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Minat - Careon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/careon.css" rel="stylesheet">
</head>
<body class="landing-layout">

<nav class="landing-nav">
    <a href="index.php" class="landing-logo">
        <img src="images/logo.png" height="35">
    </a>

    <div class="d-flex gap-2 align-items-center">
        <span style="font-size:13px;color:var(--gray-600);">
            Halo, <?= htmlspecialchars($_SESSION['username']); ?>
        </span>
        <a href="logout.php" class="btn-careon-outline btn-careon-sm">Logout</a>
    </div>
</nav>

<section class="why-section" style="padding-top:50px;">

    <div class="text-center mb-5">
        <p style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:var(--red);margin-bottom:8px;">
            CAREER INTEREST
        </p>

        <h2 class="why-title">Choose Your Field of Interest</h2>

        <p class="why-subtitle">
            Explore various career fields and discover personalized specializations that match your interests and potential.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="feature-card" style="height:100%;border:2px solid var(--red);">
                <div class="feature-icon">
                    <i class="bi bi-cpu"></i>
                </div>

                <div class="feature-title" style="font-size:22px;">Technology</div>

                <p class="feature-desc">
                    Suitable for those of you who are interested in website, application, database, system, and software development.
                </p>

                <div style="margin-top:22px;">
                    <h5 style="color:var(--navy);font-weight:800;margin-bottom:14px;">
                        Select Specialization
                    </h5>

                    <a href="assessment.php" class="btn-careon-primary" style="width:100%;justify-content:space-between;">
                        Backend Developer
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <div class="mt-3 p-3 rounded" style="background:var(--gray-100);color:var(--gray-500);">
                        Frontend Developer (Coming Soon)
                    </div>

                    <div class="mt-2 p-3 rounded" style="background:var(--gray-100);color:var(--gray-500);">
                        Data Analyst (Coming Soon)
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto"><i class="bi bi-heart-pulse"></i></div>
                <div class="feature-title">Health</div>
                <p class="feature-desc">Coming soon</p>
            </div>
        </div>

        <div class="col-md-2">
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto"><i class="bi bi-briefcase"></i></div>
                <div class="feature-title">Business</div>
                <p class="feature-desc">Coming soon</p>
            </div>
        </div>

        <div class="col-md-2">
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto"><i class="bi bi-palette"></i></div>
                <div class="feature-title">Creative</div>
                <p class="feature-desc">Coming soon</p>
            </div>
        </div>

    </div>

</section>

</body>
</html>