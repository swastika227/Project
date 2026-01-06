<?php
// PHP Script for Recipe Manager - userhome.php

// 1. Mock Recipe Data (This data matches the recipes shown in the screenshot)
$all_recipes = [
    [
        'id' => 1,
        'name' => 'Classic Pasta Carbonara',
        'description' => 'A traditional Italian pasta dish with eggs, cheese, and pancetta.',
        'time' => '25m',
        'servings' => 4,
        'ingredients' => 5,
        'tags' => ['Italian', 'Quick', 'Pasta'],
    ],
    [
        'id' => 2,
        'name' => 'Chocolate Chip Cookies',
        'description' => 'Soft and chewy homemade chocolate chip cookies.',
        'time' => '27m',
        'servings' => 24,
        'ingredients' => 9,
        'tags' => ['Dessert', 'Cookies', 'Sweet'],
    ],
    [
        'id' => 3,
        'name' => 'Vegetable Stir Fry',
        'description' => 'Quick and healthy vegetable stir fry with ginger and soy sauce',
        'time' => '23m',
        'servings' => 2,
        'ingredients' => 5,
        'tags' => ['Vegetarian', 'Quick', 'Healthy', 'Asian'],
    ],
    [
        'id' => 4,
        'name' => 'Classic Caesar Salad',
        'description' => 'Fresh romaine lettuce with homemade Caesar dressing and croutons',
        'time' => '20m',
        'servings' => 4,
        'ingredients' => 7,
        'tags' => ['Salad', 'Vegetarian', 'Classic'],
    ],
    [
        'id' => 5,
        'name' => 'Garlic Bread',
        'description' => 'Crispy garlic bread perfect as a side dish',
        'time' => '29m',
        'servings' => 6,
        'ingredients' => 5,
        'tags' => ['Side Dish', 'Quick', 'Garlic'],
    ],
    [
        'id' => 6,
        'name' => 'Scrambled Eggs with Herbs',
        'description' => 'Fluffy scrambled eggs with fresh herbs',
        'time' => '10m',
        'servings' => 2,
        'ingredients' => 5,
        'tags' => ['Breakfast', 'Quick', 'Protein'],
    ],
];

// 2. Available Tags for Display (Matches the tags in the navigation bar)
$available_tags = ['Asian', 'Breakfast', 'Classic', 'Cookies', 'Dessert', 'Garlic', 'Healthy', 'Italian', 'Pasta', 'Protein', 'Quick', 'Salad', 'Side Dish', 'Sweet', 'Vegetarian'];

// 3. Filtering Logic
$filtered_recipes = $all_recipes;

// Check for selected tag in the URL (e.g., userhome.php?tag=Quick)
$selected_tag = isset($_GET['tag']) ? htmlspecialchars($_GET['tag']) : '';

if ($selected_tag) {
    // Filter recipes where the selected tag is present in the recipe's tags array
    $filtered_recipes = array_filter($all_recipes, function($recipe) use ($selected_tag) {
        return in_array($selected_tag, $recipe['tags']);
    });
}

// Check for search term (conceptual - not fully implemented)
$search_term = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

$total_recipes = count($all_recipes);
$recipe_count = count($filtered_recipes);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Manager - FlavourTrack</title>
    <style>
        /* General Setup */
        :root {
            --primary-color: #000;
            --secondary-color: #5C6BC0;
            --background-light: #F7F7F7;
            --card-bg: #fff;
            --text-color: #333;
            --text-light: #888;
            --border-color: #EEE;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            --icon-color: #B0B0B0;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: sans-serif;
            background-color: var(--background-light);
            color: var(--text-color);
            line-height: 1.5;
        }

        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }
        a { text-decoration: none; color: inherit; }

        /* --- Navbar --- */
        .navbar {
            background-color: var(--card-bg); border-bottom: 1px solid var(--border-color);
            padding: 10px 20px; display: flex; justify-content: space-between; align-items: center;
        }
        .logo { font-weight: 700; font-size: 1.5em; }
        .logo span { font-size: 0.7em; color: var(--text-light); margin-left: 5px; }
        .nav-links { display: flex; align-items: center; }
        .nav-btn { padding: 8px 15px; border-radius: 4px; margin-left: 5px; font-size: 0.9em; }
        .primary-action { background-color: var(--primary-color); color: #fff; margin: 0 10px; font-weight: 600; }
        .primary-action:hover { background-color: #333; }
        .nav-btn:hover { background-color: var(--background-light); }
        .logout { color: #E57373; font-weight: 600; }
        .nav-icon { color: var(--icon-color); font-size: 1.2em; padding-left: 10px; }

        /* --- Filter Section --- */
        .filter-section { margin-bottom: 30px; padding: 10px 0; }

        .search-bar input {
            width: 100%; padding: 12px 15px; border: 1px solid var(--border-color);
            border-radius: 6px; font-size: 1em; background-color: var(--card-bg);
            box-shadow: var(--card-shadow); margin-bottom: 15px;
        }

        .tag-filter { margin-bottom: 20px; }
        .tag-filter label { font-size: 0.9em; font-weight: 600; margin-right: 10px; }

        .tag-list {
            margin-top: 8px; display: flex; flex-wrap: wrap; gap: 8px;
        }

        .tag-pill {
            display: inline-block; padding: 6px 12px; border-radius: 15px;
            font-size: 0.8em; font-weight: 600; cursor: pointer;
            background-color: var(--border-color); color: var(--text-color);
            transition: background-color 0.2s;
        }

        .tag-pill:hover { background-color: #D5D5D5; }

        .tag-pill.active {
            background-color: var(--secondary-color);
            color: #fff;
        }

        .recipe-count-text {
            font-size: 0.9em; color: var(--text-light);
        }
        .recipe-count-text strong { color: var(--text-color); font-weight: 700; }


        /* --- Recipe Grid and Cards --- */
        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .recipe-card {
            background-color: var(--card-bg); border-radius: 8px;
            padding: 20px; box-shadow: var(--card-shadow);
            border: 1px solid var(--border-color);
            display: flex; flex-direction: column;
        }

        .card-header {
            display: flex; justify-content: space-between;
            align-items: flex-start; margin-bottom: 10px;
        }

        .recipe-title { font-size: 1.2em; font-weight: 600; line-height: 1.3; }

        .card-actions {
            display: flex; gap: 8px; font-size: 1.1em; margin-left: 15px;
            color: var(--icon-color);
        }
        .card-actions a:hover { color: var(--text-color); }
        /* Style for the heart icon (like button) */
        .card-actions .heart-icon { color: #E57373; } 

        .recipe-description {
            font-size: 0.9em; color: var(--text-light); margin-bottom: 15px;
            min-height: 40px; 
        }

        .recipe-meta {
            display: flex; gap: 15px; font-size: 0.9em; color: var(--text-color);
            margin-bottom: 15px;
        }
        .meta-item i { margin-right: 5px; color: var(--icon-color); }

        .recipe-tags {
            display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 15px;
            min-height: 30px; /* Ensure space for tags */
        }

        .recipe-tag {
            background-color: var(--background-light); color: var(--text-color);
            padding: 4px 8px; border-radius: 4px; font-size: 0.75em; font-weight: 600;
        }

        .ingredient-count {
            font-size: 0.9em; color: var(--text-light); margin-bottom: 15px;
            flex-grow: 1; 
        }

        .btn-view-recipe {
            display: block; width: 100%; padding: 10px; text-align: center;
            background-color: var(--primary-color); color: #fff;
            border-radius: 4px; font-weight: 600; transition: background-color 0.2s;
        }
        .btn-view-recipe:hover { background-color: #333; }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="logo">FlavourTrack <span>Recipe Manager</span></div>
        <nav class="nav-links">
            <a href="Userhome.php" class="nav-btn">Home</a>
            <a href="#" class="nav-btn primary-action">+ Add Recipe</a>
            <a href="#" class="nav-btn">Multi Calculator</a>
            <a href="pantry.php" class="nav-btn">Pantry</a>
            <a href="#" class="nav-btn">Wishlist</a>
            <a href="#" class="nav-btn logout">Logout</a>
            <a href="#" class="nav-icon">👤</a>
        </nav>
    </header>

    <main class="container">
        
        <section class="filter-section">
            <form action="userhome.php" method="GET" class="search-bar">
                <input type="text" name="search" placeholder="Search recipes, ingredients, or descriptions..." value="<?php echo $search_term; ?>">
            </form>

            <div class="tag-filter">
                <label>Filter by tags:</label>
                <div class="tag-list">
                    <?php foreach ($available_tags as $tag): 
                        $is_active = ($tag === $selected_tag) ? 'active' : '';
                        // Link toggles the filter off if active, otherwise sets the filter
                        $tag_url = ($is_active) ? 'userhome.php' : 'userhome.php?tag=' . urlencode($tag);
                    ?>
                        <a href="<?php echo $tag_url; ?>" class="tag-pill <?php echo $is_active; ?>">
                            <?php echo $tag; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <p class="recipe-count-text">
                **<?php echo $recipe_count; ?>** of **<?php echo $total_recipes; ?>** recipes
            </p>
        </section>
        
        <section class="recipe-grid">
            
            <?php if ($recipe_count > 0): ?>
                <?php foreach ($filtered_recipes as $recipe): ?>
                <div class="recipe-card">
                    <div class="card-header">
                        <h2 class="recipe-title"><?php echo $recipe['name']; ?></h2>
                        <div class="card-actions">
                            <a href="#" title="Favorite"><span class="heart-icon">♡</span></a>
                            <a href="#" title="Edit">📝</a>
                            <a href="#" title="Delete">🗑️</a>
                        </div>
                    </div>
                    
                    <p class="recipe-description"><?php echo $recipe['description']; ?></p>
                    
                    <div class="recipe-meta">
                        <span class="meta-item">🕒 <?php echo $recipe['time']; ?></span>
                        <span class="meta-item">🍽️ <?php echo $recipe['servings']; ?> servings</span>
                    </div>
                    
                    <div class="recipe-tags">
                        <?php 
                        // Display up to 3 tags, then show "+X more" if necessary
                        $display_tags = array_slice($recipe['tags'], 0, 3);
                        $remaining_tags = count($recipe['tags']) - count($display_tags);
                        
                        foreach ($display_tags as $tag): 
                        ?>
                            <span class="recipe-tag"><?php echo $tag; ?></span>
                        <?php endforeach; ?>

                        <?php if ($remaining_tags > 0): ?>
                            <span class="recipe-tag hidden-tags">+<?php echo $remaining_tags; ?> more</span>
                        <?php endif; ?>
                    </div>
                    
                    <p class="ingredient-count"><?php echo $recipe['ingredients']; ?> ingredients</p>

                    <a href="recipe_details.php?id=<?php echo $recipe['id']; ?>" class="btn-view-recipe">View Recipe</a>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-results">
                    <p>No recipes found matching your search or filters.</p>
                </div>
            <?php endif; ?>

        </section>

    </main>
</body>
</html>