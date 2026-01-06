<?php
// PHP structure for the demo landing page
// Note: This page is *static* content, so it does not require a login check,
// but the 'Login' button will link to the protected system.

// Mock data for the 'Sample Recipes' section
$sample_recipes = [
    [
        'title' => 'Classic Steak Carbonara',
        'desc' => 'Rich, creamy pasta with crispy steak...',
        'img' => 'steak.jpg',
        'prep' => '10 min',
        'cook' => '30.5 min',
        'servings' => '4 Easy'
    ],
    [
        'title' => 'Chocohazelnut Chip Cookies',
        'desc' => 'Gooey, decadent cookies perfect for...',
        'img' => 'cookies.jpg',
        'prep' => '15 min',
        'cook' => '35 min',
        'servings' => '2.5 dozen Easy'
    ],
    [
        'title' => 'Vegetable Stir Fry',
        'desc' => 'A healthy, colorful weeknight meal...',
        'img' => 'stirfry.jpg',
        'prep' => '20 min',
        'cook' => '33.8 min',
        'servings' => '3 Med'
    ],
];

// PHP credentials block (for display purposes only)
$demo_credentials = [
    ['user' => 'admin', 'pass' => 'Passwert: 123'],
    ['user' => 'Demo Dennis', 'pass' => 'Password: 221'],
    ['user' => 'Úbere Docent', 'pass' => 'Password: 325']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlavourTrack - Recipe Management System</title>
    <link rel="stylesheet" href="demo.css">
<body>

    <header class="header-landing">
        <div class="logo">FlavourTrack</div>
    </header>

    <section class="hero">
        <h1>FlavourTrack</h1>
        <p class="subtitle">Your Complete Recipe Management System</p>
        <p class="tagline">Create, manage, and track your recipes with ease. Calculate costs and calories, generate shopping lists, and share culinary creations.</p>
        <div class="hero-actions">
            <a href="#" class="btn btn-primary">Get Started</a>
            <a href="#" class="btn btn-secondary">View More Features</a>
        </div>
        <div class="hero-features">
            <span><i class="fas fa-check-circle"></i> Save Recipes</span>
            <span><i class="fas fa-calculator"></i> Import Calculations</span>
            <span><i class="fas fa-chart-line"></i> Pantry Reduction</span>
        </div>
    </section>

    <section class="features-overview">
        <div class="divider-title">
            <span class="pill">FEATURES</span>
        </div>
        <h2>Everything You Need for Recipe Management</h2>
        <p class="features-tagline">Lorem Ipsum here. Lorem ipsum sit amet. Carry ingredients ingenium mal datos and plenty more culinary coastline. Fow exa.</p>
    </section>

    <section class="features-grid-section">
        <h3>Features</h3>
        <div class="features-grid">
            <div class="feature-card">
                <i class="fas fa-utensils"></i>
                <h4>Recipe Management</h4>
                <p>Create, edit, organize, and store all your favorite food designs, dishes, and extrusions.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-apple-alt"></i>
                <h4>Ingredient Calculator</h4>
                <p>Automatically reports ingredients, costs, and calories for everyone blogs forms or photoshp plug.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-list-ol"></i>
                <h4>Shopping Calculator</h4>
                <p>Track your ingredients expellese expenses, costs, and plenty more postal and forms.</p>
            </div>
            <div class="feature-card">
                <i class="fas fa-cookie"></i>
                <h4>Pantry Management</h4>
                <p>Track your list yallotiese of exspenses costs, ingredients, from complex pastry items.</p>
            </div>
        </div>
    </section>

    <section class="sample-recipes">
        <div class="divider-title">
            <span class="pill">RECIPES</span>
        </div>
        <h2>Sample Recipes</h2>
        <p class="sample-tagline">Get in glorious Eat-raw miser recipes I feel, I can not endure this. Read actions set up this full collection and some yummy new cook recipes.</p>
        
        <div class="recipe-cards-container">
            <?php foreach ($sample_recipes as $recipe): ?>
                <div class="sample-recipe-card">
                    <div class="recipe-img" style="background-image: url('images/<?php echo $recipe['img']; ?>');"></div>
                    <div class="recipe-details">
                        <h4><?php echo htmlspecialchars($recipe['title']); ?></h4>
                        <p><?php echo htmlspecialchars($recipe['desc']); ?></p>
                        <div class="recipe-meta">
                            <span>**Prep:** <?php echo $recipe['prep']; ?></span>
                            <span>**Cook:** <?php echo $recipe['cook']; ?></span>
                            <span>**Serves:** <?php echo $recipe['servings']; ?></span>
                        </div>
                        <a href="#" class="full-recipe-btn">Login to View Full Recipe</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="how-it-works">
        <h2>How it Works</h2>
        <p class="works-tagline">Get started with FlavourTrack in three simple steps!</p>
        <div class="steps-grid">
            <div class="step-card">
                <span class="step-number">1</span>
                <h4>Create Account</h4>
                <p>Sign up in seconds, then set your preferences.</p>
            </div>
            <div class="step-card">
                <span class="step-number">2</span>
                <h4>Add Recipes & Logs</h4>
                <p>Add your existing recipes, create new, or track your food consumption logs.</p>
            </div>
            <div class="step-card">
                <span class="step-number">3</span>
                <h4>Cook & Enjoy</h4>
                <p>Use the system to plan meals, shop, and cook recipes like a pro!</p>
            </div>
        </div>
    </section>

    <section class="cta-footer">
        <h2>Ready to Get Started?</h2>
        <p>Join FlavourTrack today and easily manage all your recipes, manage calories, calculate costs, and more. </p>
        <a href="login.php" class="btn btn-cta">Login to Continue <i class="fas fa-arrow-right"></i></a>
    </section>

    <section class="demo-credentials">
        <div class="credentials-container">
            <?php foreach ($demo_credentials as $creds): ?>
                <div class="cred-item">
                    <p class="user"><?php echo $creds['user']; ?></p>
                    <p class="pass"><?php echo $creds['pass']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>© 2025 FlavourTrack. Disclaimer: This is a demo page.</p>
        <p><a href="#">Privacy Policy</a> | <a href="#">Terms and Conditions</a> | <a href="#">Support</a></p>
    </footer>

</body>
</html>