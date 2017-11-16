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
    <title>Boodschappen lijstje | Boodschappen</title>
</head>
<body>
    <div id="content">
        @include('layouts.message')
        @include('layouts.trash')
        @include('layouts.header', ['header' => "Boodschappen lijst", 'history' => false, 'user' => false])

        @include('layouts.items')

        @include('layouts.footer')
    </div>

    <script>
        var groceries = {!! json_encode($groceries) !!};
    </script>
    <script src="{{ mix('js/groceries.js') }}"></script>
    <script type="text/javascript" src="js/app.js"></script>
</body>
</html>