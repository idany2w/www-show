<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

	<title>Local</title>
</head>

<body style="overflow-y: scroll;">
	<?php
		$dirs = scandir('../');
		unset($dirs[0], $dirs[1], $dirs[2]);
	?>
	<div class="container my-5">
		<div class="row g-2 js-simple-search">
			<div class="col">
				<div class="input-group mb-3">
					<input class="form-control js-foucs js-simple-search__input" type="text" placeholder="Search...">
					<span class="input-group-text" id="basic-addon2">Search</span>
				</div>
			</div>
			<?php foreach ($dirs as $dir) : ?>
				<div class="col-12 js-simple-search__result-item" data-search="<?= $dir ?>">
					<div class="card">
						<a
							class="d-none bd-placeholder-img card-img-top d-flex justify-content-center align-items-center"
							style="height:180px; background: #868e96; color: #dee2e6"
							href="https://<?= $dir; ?>"
						>
							<p><?= $dir; ?></p>
						</a>
						<div class="card-body">
							<div class="d-flex align-items-center">
								<a
									class="h4 mb-0 text-decoration-none"
									href="https://<?= $dir; ?>"
								>
									<?= $dir; ?>
								</a>

								<div class="ms-auto">
									<span><?= "/var/www/$dir"; ?></span>
									<a href="http://<?= $dir; ?>" class="btn btn-sm btn-primary">link http</a>
									<a href="https://<?= $dir; ?>" class="btn btn-sm btn-primary">link https</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
	<script>
		let focusable = document.querySelector('.js-foucs');
		if(focusable){
			focusable.focus()
		}


		function convertToEnglishSymbol(str) {
			const mapping = {
				"й": "q",
				"ц": "w",
				"у": "e",
				"к": "r",
				"е": "t",
				"н": "y",
				"г": "u",
				"ш": "i",
				"щ": "o",
				"з": "p",
				"х": "[",
				"ъ": "]",
				"ф": "a",
				"ы": "s",
				"в": "d",
				"а": "f",
				"п": "g",
				"р": "h",
				"о": "j",
				"л": "k",
				"д": "l",
				"ж": ";",
				"э": "'",
				"я": "z",
				"ч": "x",
				"с": "c",
				"м": "v",
				"и": "b",
				"т": "n",
				"ь": "m",
				"б": ",",
				"ю": "."
			};

			// Get the current value of the input
			const currentValue = event.target.value;

			// Convert any Russian symbols in the input value to English symbols
			let convertedValue = "";
			for (let i = 0; i < currentValue.length; i++) {
				const symbol = currentValue.charAt(i);
				const englishSymbol = mapping[symbol.toLowerCase()] || symbol;
				convertedValue += englishSymbol;
			}

			// Set the input value to the converted value
			return convertedValue;
		}
		document.addEventListener('input', function(e){
			let input = e.target;
			let block = input.closest('.js-simple-search');

			if(block === null) return;

			input.value = convertToEnglishSymbol(input.value);

			let searchText = input.value.trim();
			
			let items = block.querySelectorAll('.js-simple-search__result-item')

			for (const item of items) {
				
				let itemSearchWords = (item.dataset.search || "").split(/\s/);

				item.style.display = 'none';

				itemSearchWords.forEach(itemSearchWord => {
					if(itemSearchWord.includes(searchText)){
						item.style.display = '';
						return;
					}
				});
			}
		})
	</script>
</body>

</html>