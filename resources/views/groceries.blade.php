<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "groceries", 'title' => "Boodschappen lijstje | Boodschappen"])
<body>
    <div id="content">
        <messageDelete title="Reset?" message="Weet je zeker dat je alle boodschappen wilt resetten?" action="verwijdert" remaining="alle boodschappen." on-click="reset" button-span="Resetten"></messageDelete>
        @include('layouts.navigation_drawer', ['header' => "Boodschappen lijst", 'home' => true])
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