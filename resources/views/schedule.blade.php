<!DOCTYPE html>
<html lang="nl">
@include('layouts.head', ['css' => "schedule", 'title' => "Boodschappen lijstje | Planning"])
<body>
    <div id="content">
        @include('layouts.navigation_drawer', ['header' => "Automatisch Plannen", 'home' => false])
        @include('layouts.schedule')
    </div>

    <script>
        var schedule = {!! json_encode($schedule) !!};
    </script>
    <script src="{{ mix('js/schedule.js') }}"></script>
    <script>
        $('html').click(function(event) {
        if(!($(event.target).closest('.addNewItem').length)){
            app.$children[0].$children[0].ahGroupItem = false;
        }
    });
    </script>
</body>
</html>