<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 5;


// Prepare the SQL statement and get records from our tb_track table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM tb_track ORDER BY trc_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$tb_track = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of tb_track, this is so we can determine whether there should be a next and previous button
$num_tb_track = $pdo->query('SELECT COUNT(*) FROM tb_track')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>Read Track</h2>
	<a href="create_track.php" class="create-contact">Create Track</a>
	<table>
        <thead>
            <tr>
                <td>No</td>
                <td>Nama</td>
                <td>No Album</td>
                <td>Time</td>

                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tb_track as $tb_track): ?>
            <tr>
                <td><?=$tb_track['trc_id']?></td>
                 <td><?=$tb_track['trc_name']?></td>
                <td><?=$tb_track['trc_id_album']?></td>
                <td><?=$tb_track['time']?></td>
             
                <td class="actions">
                    <a href="update_track.php?trc_id=<?=$tb_track['trc_id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete_track.php?trc_id=<?=$tb_track['trc_id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_tb_track): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>