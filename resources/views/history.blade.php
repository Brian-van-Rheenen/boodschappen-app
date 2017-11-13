<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/groceries.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <title>Boodschappen lijstje | Geschiedenis</title>
</head>
<body>
    <div id="content">
        @include('layouts.header', ['header' => "Geschiedenis", 'history' => true, 'user' => false])

        @include('layouts.historyItems')
    </div>

    <script>
        var historyArray = {!! json_encode($history) !!};
    </script>
    <script src="{{ mix('js/history.js') }}"></script>
</body>
</html>