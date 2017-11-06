<section class="body">
    <ul class="list-group">
        @foreach ($groceries as $grocery)
            <li class="list-group-item @if($grocery->completed == 'true')done @endif">
                <span class="hoeveelheid @if($grocery->completed == 'true')checked @endif">{{ $grocery->quantity }}x</span>
                <span class="items @if($grocery->completed == 'true')checked @endif">{{ $grocery->description }}</span>
                <i class="fa fa-check complete @if($grocery->completed == 'true')completed @endif"></i>
            </li>
        @endforeach
    </ul>
</section>