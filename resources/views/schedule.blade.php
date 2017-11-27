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
</body>
</html>