<?php

// 1. Initialize Variables
$message = '';
$pantry_items = []; 
$item_count = 0;    

// 2. Handle Form Submission (Conceptual)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_pantry'])) {
    
    // Basic conceptual handling:
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
    $unit = isset($_POST['unit']) ? htmlspecialchars(trim($_POST['unit'])) : '';
    
    if (empty($name) || $quantity <= 0 || empty($unit)) {
        // In a real app, you would redisplay the form with user input preserved
        $message = '<div class="alert error" style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 10px;">Error: Please fill out all required fields.</div>';
    } else {
        // Conceptual database insertion here...
        // If successful:
        $message = '<div class="alert success" style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 10px;">Ingredient **' . $name . '** added successfully (Conceptual)!</div>';
        
        // After successful insertion, you would usually update $pantry_items and $item_count
        // For demonstration, let's pretend one item was added:
        // $item_count = 1; 
    }
}

// 3. Fetch Pantry Items (Conceptual - set $item_count here in a real app)
// For this example, $item_count remains 0 unless updated in the POST block.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantry Manager - FlavourTrack</title>
    <style>
        /* CSS from style.css (Section 2 of the previous response) is included below */
        
        :root {
            --primary-color: #5C6BC0;
            --secondary-color: #E0E0E0;
            --background-light: #F7F7F7;
            --text-color: #333;
            --text-light: #888;
            --border-color: #EEE;
            --card-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: sans-serif; /* Fallback for 'Inter' */
            background-color: var(--background-light);
            color: var(--text-color);
            line-height: 1.6;
        }

        .container { max-width: 1200px; margin: 20px auto; padding: 0 20px; }

        .card {
            background: #fff;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: var(--card-shadow);
        }

        /* --- Navigation Bar --- */
        .navbar {
            background-color: #fff;
            border-bottom: 1px solid var(--border-color);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo { font-weight: 700; font-size: 1.5em; color: var(--primary-color); }
        .logo span { font-size: 0.7em; color: var(--text-light); margin-left: 5px; }
        .nav-links { display: flex; align-items: center; }

        .nav-btn {
            text-decoration: none; color: var(--text-color); padding: 8px 15px;
            border-radius: 4px; transition: background-color 0.2s; margin-left: 5px;
            font-size: 0.9em; display: inline-flex; align-items: center;
        }

        .nav-btn:hover { background-color: var(--background-light); }
        
        .primary-action { background-color: var(--primary-color); color: #fff; margin: 0 10px; font-weight: 600; }
        .primary-action:hover { background-color: #4B5CA0; }

        .active-page { background-color: var(--secondary-color); color: var(--primary-color); font-weight: 600; }
        .logout { color: #E57373; font-weight: 600; }
        .nav-icon { font-size: 1.2em; padding: 5px 10px; color: var(--text-light); }

        /* --- Page Header --- */
        .page-header { display: flex; align-items: center; margin-bottom: 15px; padding: 10px 0; }
        .page-header h1 { font-size: 1.8em; font-weight: 600; margin-right: 15px; }

        .item-count {
            background-color: var(--secondary-color); color: var(--text-color);
            padding: 5px 10px; border-radius: 4px; font-size: 0.9em; font-weight: 600;
        }

        /* --- Add Ingredient Form --- */
        .add-ingredient-form h2 { font-size: 1.2em; font-weight: 600; margin-bottom: 20px; color: var(--text-color); }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 0.8em; color: var(--text-light); margin-bottom: 5px; }
        
        .form-group input {
            padding: 10px; border: 1px solid var(--border-color); border-radius: 4px;
            font-size: 1em; background-color: var(--background-light); 
        }

        /* --- Buttons --- */
        .btn-primary-small {
            background-color: var(--primary-color); color: #fff; border: none;
            padding: 8px 15px; border-radius: 4px; cursor: pointer; font-size: 0.9em;
            font-weight: 600; transition: background-color 0.2s; display: inline-flex;
            align-items: center;
        }
        .btn-primary-small:hover { background-color: #4B5CA0; }

        /* --- Empty State --- */
        .empty-state { text-align: center; padding: 60px 20px; border: 1px dashed var(--border-color); }

        .empty-icon-box {
            margin: 0 auto 20px; padding: 15px; background-color: #F0F0F0;
            border-radius: 8px; width: fit-content;
        }

        .empty-state h3 { font-size: 1.5em; font-weight: 600; margin-bottom: 5px; }
        .empty-state p { color: var(--text-light); }
        .icon { margin-right: 5px; }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="logo">FlavourTrack <span>Recipe Manager</span></div>
        <nav class="nav-links">
            <a href="Userhome.php" class="nav-btn">< Back</a>
            <a href="Userhome.php" class="nav-btn">Home</a>
            <a href="#" class="nav-btn primary-action"><i class="icon">+</i> Add Recipe</a>
            <a href="#" class="nav-btn">Multi Calculator</a>
            <a href="#" class="nav-btn active-page">Pantry</a>
            <a href="#" class="nav-btn">Wishlist</a>
            <a href="#" class="nav-btn logout">Logout</a>
            <a href="#" class="nav-icon">👤</a>
        </nav>
    </header>

    <main class="container">
        
        <?php echo $message; // Display form submission messages ?>

        <section class="page-header">
            <h1>Pantry Manager</h1>
            <span class="item-count"><?php echo $item_count; ?> Items</span>
        </section>

        <section class="card add-ingredient-form">
            <h2><i class="icon">+</i> Add New Ingredient</h2>
            
            <form action="pantry.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="ingredientName">Ingredient Name *</label>
                        <input type="text" id="ingredientName" name="name" placeholder="e.g., Tomatoes" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity *</label>
                        <input type="number" id="quantity" name="quantity" placeholder="e.g., 5" required>
                    </div>
                    <div class="form-group">
                        <label for="unit">Unit *</label>
                        <input type="text" id="unit" name="unit" placeholder="e.g., kg, pieces, cups" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" id="category" name="category" placeholder="e.g., Vegetables, Dairy">
                    </div>
                    <div class="form-group">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="text" id="expiryDate" name="expiry" placeholder="mm/dd/yyyy">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <input type="text" id="notes" name="notes" placeholder="Optional notes">
                    </div>
                </div>
                
                <button type="submit" name="add_to_pantry" class="btn-primary-small"><i class="icon-plus"></i> Add to Pantry</button>
            </form>
        </section>

        <?php if ($item_count === 0): ?>
            <section class="card empty-state">
                <div class="empty-icon-box">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 8H5C3.89543 8 3 8.89543 3 10V18C3 19.1046 3.89543 20 5 20H19C20.1046 20 21 19.1046 21 18V10C21 8.89543 20.1046 8 19 8Z" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 4H7C5.89543 4 5 4.89543 5 6V8H19V6C19 4.89543 18.1046 4 17 4Z" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10 12V16M14 12V16" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <h3>Your pantry is empty</h3>
                <p>Add ingredients above to start tracking your inventory</p>
            </section>
        <?php else: ?>
            <section class="card pantry-list">
                <h3>Pantry Items (<?php echo $item_count; ?> items)</h3>
                <p>A list or table of your tracked ingredients would be displayed here.</p>
            </section>
        <?php endif; ?>

    </main>
</body>
</html>