<?php include '../app/assets/layout/header.php'; ?>

<div class="container">
    <h1>Search Users</h1>
    <form action="index.php" method="GET">
        <input type="hidden" name="controller" value="UserController">
        <input type="hidden" name="action" value="search">
        <input type="text" name="query" placeholder="Enter your search query">
        <button type="submit">Search</button>
    </form>

    <!-- Search Results -->
    <h2>Search Results</h2>
    <?php if (!empty($data['users'])): ?>
        <ul>
            <?php foreach ($data['users'] as $user): ?>
                <li>
                    <a href="index.php?controller=ProfileController&action=showByUsername&username=<?php echo $user['Username']; ?>">
                        <?php echo $user['Username']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<?php include '../app/assets/layout/footer.php'; ?>
