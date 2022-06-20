<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $ply_id = isset($_POST['ply_id']) && !empty($_POST['ply_id']) && $_POST['ply_id'] != 'auto' ? $_POST['ply_id'] : NULL;
    $ply_id_track = isset($_POST['ply_id_track']) && !empty($_POST['ply_id_track']) && $_POST['ply_id_track'] != 'auto' ? $_POST['ply_id_track'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $ply_played = isset($_POST['ply_played']) ? $_POST['ply_played']:'';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO tb_played VALUES (?, ?, ?)');
    $stmt->execute([$ply_id, $ply_id_track, $ply_played]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create played</h2>
    <form action="create_played.php" method="post">
        <label for="ply_id">ID</label>
        <label for="ply_id_track">No Play Track</label>
        <input type="text" name="ply_id" value="auto" id="ply_id">
        <input type="text" name="ply_id_track" value="auto" id="ply_id_track">
        <label for="ply_played">Played</label>
        <input type="text" name="ply_played" value="auto" id="ply_played">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>