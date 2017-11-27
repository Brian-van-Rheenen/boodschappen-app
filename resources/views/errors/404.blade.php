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
                width: 100%;
                height: 80%;
                position: absolute;
                margin:auto 0 auto 0;
                top:0;
                bottom:0;
                left:0;
                right:0;
            }

            img {
                width: 100%;
                position: absolute;
                margin:auto 0 auto 0;
                top:0;
                bottom:0;
                left:0;
                right:0;
            }

            @media screen and (min-width: 1366px) {
                img {
                    width: unset;
                    max-width: 100%;
                    margin: auto;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <img alt="404 not found" src="/images/404.png">
        </div>
        <script type="text/javascript">
            $('html').click(function(event) {
                window.location = "/boodschappen";
            });
        </script>
    </body>
</html>
