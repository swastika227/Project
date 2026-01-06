<?php
// PHP Placeholder Data for Classic Pasta Carbonara
$recipe_data = [
    'name' => 'Classic Pasta Carbonara',
    'description' => 'A traditional Italian pasta dish with eggs, cheese, and pancetta',
    'prep_time' => '10m',
    'cook_time' => '15m',
    'total_time' => '25m',
    'default_servings' => 4,
    'tags' => ['Italian', 'Quick', 'Pasta'],
    'base_ingredients' => [
        ['name' => 'Spaghetti', 'quantity' => 400, 'unit' => 'g'],
        ['name' => 'Pancetta', 'quantity' => 150, 'unit' => 'g'],
        ['name' => 'Eggs', 'quantity' => 3, 'unit' => 'large'],
        ['name' => 'Parmesan cheese', 'quantity' => 100, 'unit' => 'g'],
        ['name' => 'Black pepper', 'quantity' => 1, 'unit' => 'tsp'],
    ],
    'instructions' => [
        'Bring a large pot of salted water to boil and cook spaghetti according to package directions.',
        'While pasta cooks, heat a large pan over medium heat. Add pancetta and cook until crispy.',
        'In a bowl, whisk together eggs, grated Parmesan, and black pepper.',
        'Drain pasta, reserving 1 cup pasta water. Add hot pasta to the pan with pancetta.',
        'Remove from heat and quickly stir in egg mixture, adding pasta water as needed to create a creamy sauce.',
        'Serve immediately with extra Parmesan and black pepper.'
    ]
];

// PHP logic for ingredient scaling (assuming default serving is used)
$current_servings = $recipe_data['default_servings'];
$scaling_factor = 1; // 4/4 = 1

// In a real application, this would handle $_POST or $_GET for scaling:
/*
if (isset($_GET['servings']) && is_numeric($_GET['servings']) && $_GET['servings'] > 0) {
    $current_servings = (int)$_GET['servings'];
    $scaling_factor = $current_servings / $recipe_data['default_servings'];
}
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe: <?php echo htmlspecialchars($recipe_data['name']); ?></title>
    <link rel="stylesheet" href="a.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <header class="navbar">
        <div class="navbar-left">
            <span class="logo">FlavourTrack</span>
            <span class="page-title">Recipe Manager</span>
        </div>
        <div class="navbar-center">
            <a href="#" class="nav-btn"><i class="fas fa-arrow-left"></i> Back</a>
            <a href="#" class="nav-btn"><i class="fas fa-home"></i> Home</a>
            <a href="#" class="nav-btn"><i class="fas fa-plus"></i> Add Recipe</a>
            <a href="#" class="nav-btn">Multi Calculator</a>
            <a href="#" class="nav-btn">Pantry</a>
            <a href="#" class="nav-btn"><i class="fas fa-list-ul"></i> Wishlist</a>
        </div>
        <div class="navbar-right">
            <a href="#" class="nav-icon-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <div class="user-avatar">L</div>
        </div>
    </header>

    <main class="container">
        <div class="recipe-header">
            <h1 class="recipe-main-title"><?php echo htmlspecialchars($recipe_data['name']); ?></h1>
            <button class="btn btn-wishlist"><i class="far fa-heart"></i> Add to Wishlist</button>
        </div>
        
        <div class="recipe-details-card">
            <h2 class="recipe-title-small"><?php echo htmlspecialchars($recipe_data['name']); ?></h2>
            <p class="recipe-description-small"><?php echo htmlspecialchars($recipe_data['description']); ?></p>

            <div class="recipe-meta-row">
                <div class="meta-box">
                    <span class="meta-label">Prep Time</span>
                    <span class="meta-value"><?php echo htmlspecialchars($recipe_data['prep_time']); ?></span>
                </div>
                <div class="meta-box">
                    <span class="meta-label">Cook Time</span>
                    <span class="meta-value"><?php echo htmlspecialchars($recipe_data['cook_time']); ?></span>
                </div>
                <div class="meta-box">
                    <span class="meta-label">Total Time</span>
                    <span class="meta-value"><?php echo htmlspecialchars($recipe_data['total_time']); ?></span>
                </div>
                <div class="meta-box">
                    <span class="meta-label">Servings</span>
                    <span class="meta-value"><?php echo htmlspecialchars($recipe_data['default_servings']); ?></span>
                </div>
            </div>

            <div class="recipe-tags-list">
                <?php foreach ($recipe_data['tags'] as $tag): ?>
                    <span class="tag tag-recipe-item"><?php echo htmlspecialchars($tag); ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="two-column-layout">
            
            <div class="calculator-panel panel">
                <div class="panel-header">
                    <i class="fas fa-calculator panel-icon"></i>
                    <h3>Ingredient Calculator</h3>
                </div>

                <div class="servings-input-group">
                    <label>Servings</label>
                    <div class="input-with-icon">
                        <input type="number" value="<?php echo $current_servings; ?>" min="1" class="servings-input">
                        <i class="fas fa-redo-alt icon-action"></i>
                    </div>
                </div>

                <h4>Scaled Ingredients</h4>
                <div class="ingredients-list">
                    <?php foreach ($recipe_data['base_ingredients'] as $ing): 
                        // Calculate scaled quantity
                        $scaled_qty = $ing['quantity'] * $scaling_factor;
                        // Format the output (simple rounding for demonstration)
                        $display_qty = round($scaled_qty) == $scaled_qty ? (int)$scaled_qty : number_format($scaled_qty, 1);
                    ?>
                    <div class="ingredient-item">
                        <span class="ingredient-name"><?php echo htmlspecialchars($ing['name']); ?></span>
                        <span class="ingredient-qty"><?php echo htmlspecialchars($display_qty . ' ' . $ing['unit']); ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="instructions-panel panel">
                <div class="panel-header">
                    <h3>Instructions</h3>
                </div>

                <ol class="instruction-steps">
                    <?php $step_number = 1; ?>
                    <?php foreach ($recipe_data['instructions'] as $step): ?>
                        <li>
                            <div class="step-number"><?php echo $step_number++; ?></div>
                            <p><?php echo htmlspecialchars($step); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </main>
</body>
</html>