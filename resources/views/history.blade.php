<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="images/favicon.ico" />
    <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/groceries.css">
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