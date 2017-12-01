<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <title>Account Activeren</title>
    <style>
        html, body {
            height: 100%;
            width: 100%;
            font-family: 'Roboto', sans-serif;
        }

        * {
            outline: none !important;
        }

        p {
            text-align: center !important;
            margin: 20px 0px 0px 0px;
        }

        a {
            color: #fff !important;
            text-decoration: none !important;
        }

        #content {
            height: 200px;
            width: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100%;
        }

        .body {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .layout-header {
            display: flex;
            justify-content: center;
            align-items: center;
            background: #92b558;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
            box-sizing: border-box;
            color: #FFFFFF;
            overflow: hidden;
            left: 0;
            top: 0;
            height: 50px;
            width: 100%;
            z-index: 1;
        }

        .header-title {
            font-size: 20px;
            font-weight: 500;
            line-height: 64px;
        }

        .button {
            margin-top: 15px;
            font-family: 'Roboto', sans-serif;
            display: inline-block;
            text-align: center;
            padding: 10px;
            width: auto;
            color: white !important;
            transition: 300ms ease-in-out;
            font-size: 22px;
            background-color: #d07e20;
            border: none;
            border-bottom: 3px solid #a56418;
        }

        .button:focus, .button:hover {
            color: #fff !important;
            text-decoration: none !important;
            box-shadow: 0px 2px 20px #777;
        }

        .button:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <header class="layout-header">
        <span class="header-title default">Verifieer je account</span>
    </header>

    <div id="content">
        <section class="body">
            <p>Verifieer je account door op de link te klikken.<br>Als je dit gedaan hebt, kan je inloggen.</p>

            <a class="button" href="{{ URL::to('verifieer/' . $confirmation_code) }}">Account activeren</a>
        </section>
    </div>

</body>
</html>