<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "groceries", 'title' => "Boodschappen lijstje | Boodschappen"])
<body>
    <div id="content">
        @include('layouts.message', ['goal' => 'Reset?', 'message' => "Weet je zeker dat je alle boodschappen wilt resetten? Dit", 'action' => "verwijdert", 'remaining' => "ze allemaal.", 'onClick' => "this." . "$" . "root.resetItems"])
        @include('layouts.navigation_drawer', ['header' => "Boodschappen lijst", 'history' => false, 'user' => false])
        @include('layouts.trash')

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