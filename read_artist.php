<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our tb_artist table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM tb_artist ORDER BY art_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$tb_artist = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of tb_artist, this is so we can determine whether there should be a next and previous button
$num_tb_artist = $pdo->query('SELECT COUNT(*) FROM tb_artist')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Read Artist</h2>
	<a href="create_artist.php" class="create-contact">Create Artist</a>
	<table>
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tb_artist as $tb_artist): ?>
            <tr>
                <td><?=$tb_artist['art_id']?></td>
                <td><?=$tb_artist['art_name']?></td>
             
                <td class="actions">
                    <a href="update_artist.php?art_id=<?=$tb_artist['art_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_artist.php?art_id=<?=$tb_artist['art_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_tb_artist): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>