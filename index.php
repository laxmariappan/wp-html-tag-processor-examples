<?php
// Create a HTML header and left sidebar with tailwind css and link all the PHP files in this folder.

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>WordPress Parser</title>
</head>
<body class="bg-gray-100">
	<div class="container mx-auto">
		<div class="flex">
			<div class="w-1/4">
				<div class="bg-white p-4 rounded-lg shadow">
					<h2 class="text-lg font-bold mb-4">Parsers</h2>
					<ul>
						<li><a href="get-images.php">Get Images</a></li>
						<li><a href="benchmarks.php">Benchmarks</a></li>
						<li><a href="benchmarks-2.php">Benchmarks 2</a></li>
                        <li><a href="accessibility.php">Accessibility</a></li>
					</ul>
				</div>
			</div>
			<div class="w-3/4">
				<div class="bg-white p-4 rounded-lg shadow">
					<h2 class="text-lg font-bold mb-4">Parser Output</h2>
					<p>Select a parser from the left sidebar to see the output.</p>
                    <iframe id="content-frame" src="get-images.php" class="w-full h-128 mt-4" height="800"></iframe>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
    document.querySelectorAll('ul li a').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('content-frame').src = this.href;
        });
    });
</script>
</html>
