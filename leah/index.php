
<?php
session_start();
require 'functions.php'; // Include functions for database connection and utility

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Login Action
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $user_id = authenticate_user($username, $password);

        if ($user_id) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password!";
        }
    }

    // Register Action
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        if ($password !== $confirm_password) {
            $error = "Passwords do not match!";
        } else {
            $result = register_user($username, $password);
            if ($result === true) {
                $success = "Registration successful! You can now <a href='index.php#login'>log in</a>.";
            } else {
                $error = $result;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Blog</title>
      <link rel="stylesheet" href="styles.css">

  </head>
  <body>
    <?php include('header.php')?>
    <!-- About Section -->
    <section id="about" class="content-section">
        <h1>
        <p>Discover a variety of delicious recipes, helpful cooking tips, and all the inspiration you need to make your meals extraordinary.</p>
        <div class="about-image"></div>
        <a href="#posts" class="btn-about">Explore Latest Recipes</a>
    </section>

    <!-- Blog Posts Section -->
    <section id="posts" class="content-section" style="display: block;">
      <h2>Latest Posts</h2>

      <article class="post">
        <div class="post-content">
          <img src="Photos/buttered seafood.jpeg" alt="Buttered Seafood" class="post-image">
          <div class="post-text">
            <h3 class="post-title">Buttered Seafood</h3>
            <p> Garlic butter shrimp are a quick and delicious option, sautéed in a savory garlic butter sauce and garnished with fresh parsley and a squeeze of lemon. This dish pairs perfectly with pasta or rice, making it a versatile choice for any meal. The rich flavors and tender shrimp create a satisfying seafood experience that’s both comforting and elegant.
            </p>
            <h4>Ingredients:</h4>
            <ul>
              <li>1 lb shrimp (peeled and deveined)</li>
              <li>4 tbsp butter</li>
              <li>4 cloves garlic (minced)</li>
              <li>1 tbsp lemon juice</li>
              <li>Salt and pepper to taste</li>
              <li>Fresh parsley (chopped, for garnish)</li>
            </ul>
            
            <h4>Instructions:</h4>
            <ul>
              <li>In a large skillet, melt the butter over medium heat.</li>
              <li>Add minced garlic and sauté until fragrant (about 1 minute).</li>
              <li>Add the shrimp, salt, and pepper; cook until shrimp turn pink (about 3-4 minutes).</li>
              <li>Stir in lemon juice and cook for an additional minute.</li>
              <li>Garnish with chopped parsley and serve hot.</li>
            </ul>

            <button class="like-btn">Like</button> <span class="like-count">0 Likes</span>
            <div class="comments-section">
              <textarea id="commentInput1" placeholder="Add a comment..."></textarea>
              <button onclick="addComment('commentInput1', 'comments-list1')">Post Comment</button>
              <ul id="comments-list1"></ul>
            </div>
          </div>
        </div>
      </article>

      <article class="post">
        <div class="post-content">
          <img src="Photos/ampalaya.jpeg" alt="Ampalaya with Egg" class="post-image">
          <div class="post-text">
            <h3 class="post-title">Ampalaya with Egg</h3>
            <p>A classic Filipino dish featuring bitter melon (ampalaya) stir-fried with eggs. This simple, nutritious meal combines bitterness with savory flavors, making it both healthy and satisfying. Perfect as a side dish or a light meal.</p>
            <h4>Ingredients:</h4>
            <ul>
              <li>2 medium ampalaya (bitter melon), sliced</li>
              <li>2 eggs, beaten</li>
              <li>1 onion, sliced</li>
              <li>3 garlic cloves, minced</li>
              <li>1 tomato, chopped</li>
              <li>2 tbsp cooking oil</li>
              <li>1 tsp salt (or to taste)</li>
              <li>1/4 tsp pepper</li>
            </ul>
            <h4>Instructions:</h4>
            <ul>
              <li>Slice ampalaya in half, remove seeds, and cut into thin half-moons. Soak in salted water for 10-15 minutes, then rinse and drain.</li>
              <li>Heat oil in a pan and sauté garlic and onions until soft.</li>
              <li>Add tomato and cook until soft, then stir-fry ampalaya for 3-5 minutes.</li>
              <li>Season with salt and pepper to taste.</li>
              <li>Pour in beaten eggs, let set briefly, then stir until cooked.</li>
              <li>Serve hot with steamed rice!</li>
            </ul>

            <button class="like-btn">Like</button> <span class="like-count">0 Likes</span>
            <div class="comments-section">
              <textarea id="commentInput2" placeholder="Add a comment..."></textarea>
              <button onclick="addComment('commentInput2', 'comments-list2')">Post Comment</button>
              <ul id="comments-list2"></ul>
            </div>
          </div>
        </div>
      </article>

      <article class="post">
        <div class="post-content">
          <img src="Photos/20241012_113200.jpg" alt="Pork Barbeque" class="post-image">
          <div class="post-text">
            <h3 class="post-title">Pork Barbeque</h3>
            <p>Enjoy the rich and smoky flavors of pork barbecue, marinated to perfection and grilled until tender. This dish is perfect for gatherings and adds a delightful twist to your meal.</p>

            <h4>Ingredients:</h4>
            <ul>
              <li>2 lbs pork shoulder or ribs</li>
              <li>1/2 cup soy sauce</li>
              <li>1/4 cup vinegar</li>
              <li>1/4 cup brown sugar</li>
              <li>3 cloves garlic, minced</li>
              <li>1 tsp black pepper</li>
              <li>1 tsp paprika</li>
              <li>Barbecue sauce (for basting)</li>
            </ul>

            <h4>Instructions:</h4>
            <ul>
              <li>In a bowl, mix soy sauce, vinegar, brown sugar, garlic, black pepper, and paprika to create a marinade.</li>
              <li>Marinate the pork in the mixture for at least 2 hours, or overnight for best results.</li>
              <li>Preheat the grill to medium heat. Remove the pork from the marinade and discard the marinade.</li>
              <li>Grill the pork for about 20-30 minutes, turning occasionally and basting with barbecue sauce.</li>
              <li>Cook until the pork is tender and reaches an internal temperature of 145°F (63°C).</li>
              <li>Let rest for a few minutes before slicing and serving with additional barbecue sauce.</li>
            </ul>

            <button class="like-btn">Like</button> <span class="like-count">0 Likes</span>
            <div class="comments-section">
              <textarea id="commentInput3" placeholder="Add a comment..."></textarea>
              <button onclick="addComment('commentInput3', 'comments-list3')">Post Comment</button>
              <ul id="comments-list3"></ul>
            </div>
          </div>
        </div>
      </article>
    </section>

    <!-- Categories Section -->
    <aside id="categories" class="content-section">
        <h3>Categories</h3>
        <ul class="categories">
            <li><a href="#">Recipes</a></li>
            <li><a href="#">Dessert</a></li>
            <li><a href="#">Budget-Friendly Meals</a></li>
            <li><a href="#">Vegetarian</a></li>
        </ul>
    </aside>

    <footer>
        <p>&copy; 2024 My Blog</p>
    </footer>

  </body>
</html>
