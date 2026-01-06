<?php
// PHP Placeholder Data - In a real application, this would come from a database.
$recipes = [
    [
        'name' => 'Classic Pasta Carbonara',
        'description' => 'A traditional Italian pasta dish with eggs, cheese, and pancetta',
        'time' => '25m',
        'servings' => '4 servings',
        'ingredients' => '5 ingredients',
        'tags' => ['Italian', 'Quick', 'Pasta'],
    ],
    [
        'name' => 'Chocolate Chip Cookies',
        'description' => 'Soft and chewy homemade chocolate chip cookies',
        'time' => '27m',
        'servings' => '24 servings',
        'ingredients' => '9 ingredients',
        'tags' => ['Dessert', 'Cookies', 'Sweet'],
    ],
    [
        'name' => 'Vegetable Stir Fry',
        'description' => 'Quick and healthy vegetable stir fry with ginger and soy sauce',
        'time' => '23m',
        'servings' => '2 servings',
        'ingredients' => '5 ingredients',
        'tags' => ['Vegetarian', 'Quick', 'Healthy'],
        'more_tags' => '+1 more',
    ],
    [
        'name' => 'Classic Caesar Salad',
        'description' => 'Fresh romaine lettuce with homemade Caesar dressing and croutons',
        'time' => '20m',
        'servings' => '4 servings',
        'ingredients' => '7 ingredients',
        'tags' => ['Salad', 'Vegetarian', 'Classic'],
    ],
    [
        'name' => 'Garlic Bread',
        'description' => 'Crispy garlic bread perfect as a side dish',
        'time' => '25m',
        'servings' => '6 servings',
        'ingredients' => '5 ingredients',
        'tags' => ['Side Dish', 'Quick', 'Garlic'],
    ],
    [
        'name' => 'Scrambled Eggs with Herbs',
        'description' => 'Puffy scrambled eggs with fresh herbs',
        'time' => '10m',
        'servings' => '2 servings',
        'ingredients' => '5 ingredients',
        'tags' => ['Breakfast', 'Quick', 'Protein'],
    ],
];

// Placeholder for filtering. In a real app, this would be based on user input.
$all_tags = ['Asian', 'Breakfast', 'Classic', 'Cookies', 'Dessert', 'Garlic', 'Healthy', 'Italian', 'Pasta', 'Protein', 'Quick', 'Salad', 'Side Dish', 'Sweet', 'Vegetarian'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlavourTrack | Recipe Manager</title>
    <link rel="stylesheet" href="home.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <header class="navbar">
        <div class="navbar-left">
            <span class="logo">FlavourTrack</span>
            <span class="page-title">Recipe Manager</span>
        </div>
        <div class="navbar-right">
            <button class="btn btn-primary"><i class="fas fa-plus"></i> Add Recipe</button>
            <a href="#" class="nav-icon-link"><i class="fas fa-user-shield"></i> Admin</a>
            <a href="#" class="nav-icon-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <div class="user-avatar">L</div>
        </div>
    </header>

    <main class="container">
        <section class="filter-section">
            <div class="search-bar-container">
                <i class="fas fa-search search-icon"></i>
                <input type="text" placeholder="Search recipes, ingredients, or descriptions..." class="search-input">
            </div>

            <p class="filter-title">Filter by tags:</p>
            <div class="tag-filter-list">
                <?php foreach ($all_tags as $tag): ?>
                    <span class="tag tag-filter <?php echo (in_array($tag, ['Quick', 'Italian', 'Dessert'])) ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($tag); ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="recipe-list-header">
            <p><strong><?php echo count($recipes); ?></strong> of <strong><?php echo count($recipes); ?></strong> recipes</p>
        </section>

        <div class="recipes-grid">
            <?php foreach ($recipes as $recipe): ?>
                <div class="recipe-card">
                    <div class="recipe-card-header">
                        <h3 class="recipe-title"><?php echo htmlspecialchars($recipe['name']); ?></h3>
                        <div class="recipe-actions">
                            <i class="far fa-heart icon-action"></i>
                            <i class="far fa-edit icon-action"></i>
                            <i class="far fa-trash-alt icon-action"></i>
                        </div>
                    </div>
                    <p class="recipe-description"><?php echo htmlspecialchars($recipe['description']); ?></p>

                    <div class="recipe-meta">
                        <span class="meta-item"><i class="far fa-clock"></i> <?php echo htmlspecialchars($recipe['time']); ?></span>
                        <span class="meta-item"><i class="fas fa-utensils"></i> <?php echo htmlspecialchars($recipe['servings']); ?></span>
                    </div>

                    <div class="recipe-tags">
                        <?php foreach ($recipe['tags'] as $tag): ?>
                            <span class="tag tag-recipe-item"><?php echo htmlspecialchars($tag); ?></span>
                        <?php endforeach; ?>
                        <?php if (isset($recipe['more_tags'])): ?>
                            <span class="tag tag-recipe-item tag-more"><?php echo htmlspecialchars($recipe['more_tags']); ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="recipe-ingredients">
                        <?php echo htmlspecialchars($recipe['ingredients']); ?>
                    </div>

                    <button class="btn btn-dark">
                        <i class="fas fa-eye"></i> View Recipe
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>