<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "groceries", 'title' => "Boodschappen lijstje | Boodschappen"])
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