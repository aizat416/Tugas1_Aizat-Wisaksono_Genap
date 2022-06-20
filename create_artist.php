<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $art_id = isset($_POST['art_id']) && !empty($_POST['art_id']) && $_POST['art_id'] != 'auto' ? $_POST['art_id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $art_name = isset($_POST['art_name']) ? $_POST['art_name'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_artist VALUES (?, ?)');
    $stmt->execute([$art_id, $art_name]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Artist</h2>
    <form action="create_artist.php" method="post">
        <label for="art_id">ID</label>
        <label for="art_name">Nama</label>
        <input type="text" name="art_id" value="auto" id="art_id">
        <input type="text" name="art_name" id="art_name">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>