<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>

<body>
    <div class="box">
        <div class="box__ghost">
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>
            <div class="symbol"></div>

            <div class="box__ghost-container">
                <div class="box__ghost-eyes">
                    <div class="box__eye-left"></div>
                    <div class="box__eye-right"></div>
                </div>
                <div class="box__ghost-bottom">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="box__ghost-shadow"></div>
        </div>

        <div class="box__description">
            <div class="box__description-container">
                <div class="box__description-title">Whoops!</div>
                <div class="box__description-text">404 Not Found</div>
            </div>

            <a href="/home" target="_blank" class="box__button">Go back</a>

        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        //based on https://dribbble.com/shots/3913847-404-page

        var pageX = $(document).width();
        var pageY = $(document).height();
        var mouseY = 0;
        var mouseX = 0;

        $(document).mousemove(function(event) {
            //verticalAxis
            mouseY = event.pageY;
            yAxis = (pageY / 2 - mouseY) / pageY * 300;
            //horizontalAxis
            mouseX = event.pageX / -pageX;
            xAxis = -mouseX * 100 - 100;

            $('.box__ghost-eyes').css({
                'transform': 'translate(' + xAxis + '%,-' + yAxis + '%)'
            });

            //console.log('X: ' + xAxis);

        });
    </script>
</body>

</html>
