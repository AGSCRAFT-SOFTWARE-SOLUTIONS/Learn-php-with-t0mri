<?php
include("db.php");

if (!empty($_POST['todo'])) {
	$todo = $_POST['todo'];

	// Inserting new todo into database (same way for all three methods). 
	$db->query("insert into todos (todo) values ('{$todo}')");

	// Query to retrieve all todos
	$query = "select * from todos";

	// Querying data with mysqli (for both oo and procedual way)
	// $todos = $db->query($query)->fetch_all(MYSQLI_ASSOC);

	// Querying data with PDO
	$todos = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php if (!empty($_POST['todo'])) : ?>
	<form id="notCompletedForm" action="/toggleTodo.php" method="post" hx-boost="true" hx-push-url="false" hx-target="#completedForm" hx-trigger="change">
		<?php foreach ($todos as $todo) : ?>
			<!-- Return only if the status is 0 (Uncompleted) -->
			<?php if ($todo["status"] == 0) : ?>
				<input type="checkbox" name="<?php echo $todo["id"] ?>" id="">
				<label for="<?php echo $todo["id"] ?>"><?php echo $todo["todo"] ?></label>
				<br>
			<?php endif; ?>
		<?php endforeach; ?>
	</form>
<?php endif; ?>

<!-- To reset the input -->
<input type="text" name="todo" class="rd-md p-2 bg-gray-200" id="newTodoInput" hx-swap-oob="true">
