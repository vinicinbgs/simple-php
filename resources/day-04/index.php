<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $styles; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" />
    <title></title>
</head>

<body>
    <div class="container">
        <button class="button css">
            <i class="fab fa-css3-alt fa-5x icon-css"></i>
        </button>
        <button class="button html">
            <i class="fab fa-html5 fa-5x icon-html"></i>
        </button>
        <button class="button php">
            <i class="fab fa-php fa-5x icon-php"></i>
        </button>
        <button class="button js">
            <i class="fab fa-js fa-5x icon-js"></i>
        </button>

        <button class="button laravel">
            <i class="fab fa-laravel fa-5x icon-laravel"></i>
        </button>
        <button class="button nodejs">
            <i class="fab fa-node-js fa-5x icon-nodejs"></i>
        </button>
        <button class="button docker">
            <i class="fab fa-docker fa-5x icon-docker"></i>
        </button>
        <button class="button github">
            <i class="fab fa-github fa-5x icon-github"></i>
        </button>
        <button class="button react">
            <i class="fab fa-react fa-5x icon-react"></i>
        </button>
    </div>
</body>
<script>
    let btn = document.querySelector('.button');
    btn.addEventListener('click', () => {
        alert('CSS3');
    });
</script>

</html>