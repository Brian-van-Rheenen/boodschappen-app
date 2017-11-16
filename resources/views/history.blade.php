<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "groceries", 'title' => "Boodschappen lijstje | Geschiedenis"])
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