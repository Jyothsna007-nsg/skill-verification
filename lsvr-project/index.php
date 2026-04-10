<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LSVR Project</title>

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: #f4f6f9;
}

/* NAVBAR */
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 50px;
    background: #0f172a;
    color: white;
    position: sticky;
    top: 0;
}

.logo {
    font-size: 22px;
    font-weight: bold;
}

.navbar ul {
    list-style: none;
    display: flex;
    gap: 25px;
}

.navbar a {
    color: white;
    text-decoration: none;
    transition: 0.3s;
}

.navbar a:hover {
    color: #38bdf8;
}

/* HERO */
.hero {
    height: 90vh;
    background: linear-gradient(to right, #1e3a8a, #2563eb);
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    padding: 20px;
}

.hero h1 {
    font-size: 48px;
}

.hero p {
    margin: 15px 0;
    font-size: 18px;
}

.buttons {
    margin-top: 20px;
}

.btn {
    padding: 12px 25px;
    margin: 10px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
    display: inline-block;
}

.primary {
    background: white;
    color: #2563eb;
}

.secondary {
    background: transparent;
    border: 2px solid white;
    color: white;
}

.btn:hover {
    transform: scale(1.05);
}

/* FEATURES */
.features {
    padding: 60px 50px;
    text-align: center;
}

.features h2 {
    margin-bottom: 40px;
    font-size: 32px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}

.card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
    cursor: pointer;
}

.card:hover {
    transform: translateY(-10px);
}

/* FOOTER */
footer {
    text-align: center;
    padding: 20px;
    background: #0f172a;
    color: white;
    margin-top: 40px;
}

/* ANIMATION */
.fade-in {
    opacity: 0;
    transform: translateY(30px);
    transition: 1s;
}

.fade-in.show {
    opacity: 1;
    transform: translateY(0);
}
</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">LSVR</div>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>
    </ul>
</nav>

<!-- HERO -->
<section class="hero">
    <div class="hero-content fade-in">
        <h1>Smart Skill Evaluation Platform</h1>
        <p>Test your skills. Build your resume. Get job-ready.</p>

        <div class="buttons">
            <a href="login.php" class="btn primary">Get Started</a>
            <a href="register.php" class="btn secondary">Create Account</a>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="features">
    <h2 class="fade-in">Why Choose LSVR?</h2>

    <div class="cards">
        <div class="card fade-in">
            <h3>💻 Multi-Language Tests</h3>
            <p>Take tests in C, Java, Python and more.</p>
        </div>

        <div class="card fade-in">
            <h3>📊 Instant Results</h3>
            <p>Get performance analysis instantly.</p>
        </div>

        <div class="card fade-in">
            <h3>📄 Resume Builder</h3>
            <p>Auto-generate resume based on your skills.</p>
        </div>

        <div class="card fade-in">
            <h3>🎯 Smart Evaluation</h3>
            <p>Random questions every time.</p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>© 2026 LSVR Project | Designed by Jyothsna</p>
</footer>

<!-- JAVASCRIPT -->
<script>

// Fade-in animation on scroll
const elements = document.querySelectorAll('.fade-in');

function showOnScroll() {
    const triggerBottom = window.innerHeight * 0.85;

    elements.forEach(el => {
        const boxTop = el.getBoundingClientRect().top;

        if (boxTop < triggerBottom) {
            el.classList.add('show');
        }
    });
}

window.addEventListener('scroll', showOnScroll);
showOnScroll();

// Card hover color effect
document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('mouseover', () => {
        card.style.background = '#e0f2fe';
    });

    card.addEventListener('mouseout', () => {
        card.style.background = 'white';
    });
});

</script>

</body>
</html>