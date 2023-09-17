<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UBONWLM</title>
</head>
<style>
	.imageSlides {
		display: none
	}

	img {
		margin: auto;
		display: block;
		width: 100%;
	}

	/* Our main images-slideshow container */
	.images-slideshow {
		max-width: 612px;
		position: relative;
		margin: auto;
	}

	/*Style for ">" next and "<" previous buttons */
	.slider-btn {
		cursor: pointer;
		position: absolute;
		top: 50%;
		width: auto;
		padding: 8px 16px;
		margin-top: -22px;
		color: rgb(0, 0, 0);
		font-weight: bold;
		font-size: 18px;
		transition: 0.6s ease;
		border-radius: 0 3px 3px 0;
		user-select: none;
		background-color: rgba(255, 255, 255, 0.5);
		border-radius: 50%;
	}

	/* setting the position of the previous button towards left */
	.previous {
		left: 2%;
	}

	/* setting the position of the next button towards right */
	.next {
		right: 2%;
	}

	/* On hover, adding a background color */
	.previous:hover,
	.next:hover {
		color: rgb(255, 253, 253);
		background-color: rgba(0, 0, 0, 0.8);
	}
</style>

<body>
	<div class="images-slideshow">
		<div class="imageSlides fade">
			<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Stirling_Castle_Main_Gate.jpg/800px-Stirling_Castle_Main_Gate.jpg">
		</div>
		<div class="imageSlides fade">
			<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Stirling_Castle_Main_Gate.jpg/800px-Stirling_Castle_Main_Gate.jpg">
		</div>
		<div class="imageSlides fade">
			<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/56/Shakuzoji_Kuginuki_Jizo-3586.jpg/800px-Shakuzoji_Kuginuki_Jizo-3586.jpg">
		</div>
		<a class="slider-btn previous" onclick="setSlides(-1)">❮</a>
		<a class="slider-btn next" onclick="setSlides(1)">❯</a>
	</div>
</body>
<script>
	var currentIndex = 1;
	displaySlides(currentIndex);

	function setSlides(num) {
		displaySlides(currentIndex += num);
	}

	function displaySlides(num) {
		var x;
		var slides = document.getElementsByClassName("imageSlides");
		if (num > slides.length) {
			currentIndex = 1
		}
		if (num < 1) {
			currentIndex = slides.length
		}
		for (x = 0; x < slides.length; x++) {
			slides[x].style.display = "none";
		}
		slides[currentIndex - 1].style.display = "block";
	}
</script>
<!-- ! Body -->