<?php 
	require_once'db.php';

	$message = new Message;

	$viewMsg = $message->readAll();
	// print_r(json_encode($viewMsg)); die;

	foreach ($viewMsg as $msg) :
?>
	
		<li class="list-group-item">
			<span class="text-primary font-weight-bold"><?php echo $msg->name ?> :</span>
			<span class="text-secondary"><?php echo $msg->msg ?></span>
			<small class="text-muted float-right"><?php echo $message->timeAgo($msg->date) ?></small>
		</li>

<?php endforeach; ?>
