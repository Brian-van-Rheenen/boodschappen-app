<div class="nav-container">
    <nav class="side-nav">
        <img alt="Moodles internetbureau Rotterdam" src="images/logo.png">

        <div class="menu-items">
            <ul>
                <ol>
                    <span class="icon">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </span>
                    <span class="tekst">Log uit</span>
                </ol>
            </ul>
        </div>

        <div id="nav-icon">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>
</div>
<script
    src="https://code.jquery.com/jquery-3.2.1.min.js"
    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
    crossorigin="anonymous">
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('html').click(function() {
            if($('.side-nav').has('slide-in').length === 0){
                $('.side-nav').removeClass('slide-in');
                $('#content').removeClass('grey-out');
                $('#nav-icon').removeClass('open');
            }
        });

        $('.side-nav').click(function(event){
            event.stopPropagation();
        });

        $('#nav-icon').click(function(){
            $(this).toggleClass('open');
            $('.side-nav').toggleClass('slide-in');
            $('#content').not('.side-nav').toggleClass('grey-out');
        });
    });
</script>