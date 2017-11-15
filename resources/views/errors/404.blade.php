<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <title>Pagina niet gevonden</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                height: 100vh;
                margin: 0;
                cursor: pointer;
            }

            .container {
                width: 80%;
                height: 80%;
                position: absolute;
                margin:auto;
                top:0;
                bottom:0;
                left:0;
                right:0;
            }

            img {
                max-width: 100%;
                max-height: 100%;
                position: absolute;
                margin:auto;
                top:0;
                bottom:0;
                left:0;
                right:0;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <img alt="404 not found" src="images/404.png">
        </div>
        <script type="text/javascript">
            $('html').click(function(event) {
                window.location = "/boodschappen";
            });
        </script>
    </body>
</html>
