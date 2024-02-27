<?php
include("db.php");

// Query to retrieve all todos
$query = "select * from todos";

// Querying data with mysqli (for both oo and procedual way)
// $todos = $db->query($query)->fetch_all(MYSQLI_ASSOC);

// Querying data with PDO
$todos = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Todo app</title>

	<!-- Adding UnoCSS -->
	<script src="https://cdn.jsdelivr.net/npm/@unocss/runtime"></script>

	<!-- Default style reset -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@unocss/reset/tailwind.min.css">

	<!-- Addding htmx -->
	<script src="https://unpkg.com/htmx.org@1.9.9" integrity="sha384-QFjmbokDn2DjBjq+fM+8LUIVrAgqcNW2s0PjAxHETgRn9l4fvX31ZxDxvwQnyMOX" crossorigin="anonymous"></script>
</head>

<body class="min-h-100vh grid place-content-center justify-center">
	<h1 class="font-bold text-2rem">Todo</h1>

	<!-- Form to create a new todo -->
	<form action="/createTodo.php" method="post" hx-boost="true" hx-target="#notCompleted" hx-push-url="false">
		<input type="text" name="todo" class="rd-md p-2 bg-gray-200" id="newTodoInput">
		<button class="p-2 rd-md bg-green-200 hover:bg-green-300 active:bg-green-400">+</button>
	</form>

	<!-- Uncompleted todos section -->
	<h4 class="text-gray-300 font-bold font-1rem">Not completed</h4>
	<div id="notCompleted">
		<form id="notCompletedForm" action="/toggleTodo.php" method="post" hx-boost="true" hx-push-url="false" hx-target="#completedForm" hx-trigger="change">
			<?php foreach ($todos as $todo) : ?>
				<?php if ($todo["status"] == 0) : ?>
					<input type="checkbox" name="<?php echo $todo["id"] ?>" id="">
					<label for="<?php echo $todo["id"] ?>"><?php echo $todo["todo"] ?></label>
					<br>
				<?php endif; ?>
			<?php endforeach; ?>
		</form>
	</div>

	<!-- Completed todos section -->
	<h4 class="text-gray-300 font-bold font-1rem">Completed</h4>
	<div id="completed">
		<form id="completedForm" action="/toggleTodo.php" method="post" hx-boost="true" hx-push-url="false" hx-target="#notCompletedForm" hx-trigger="change" hx-swap-oob="true">
			<?php foreach ($todos as $todo) : ?>
				<?php if ($todo["status"] == 1) : ?>
					<input type="hidden" name="<?php echo $todo["id"] ?>">
					<input type="checkbox" name="<?php echo $todo["id"] ?>" checked class="op-50">
					<label for="<?php echo $todo["id"] ?>" class="op-50"><s><?php echo $todo["todo"] ?></s></label>
					<br>
				<?php endif; ?>
			<?php endforeach; ?>
		</form>
	</div>
</body>

</html>
