<div class="bar-popup bar-top" id="topPopup{{ $popup->id }}">
    <div class="popup-header">
        {{ $popup->show_name ? $popup->translation->name : '' }}
    </div>
    <div class="popup-content">
        {!! $popup->translation->content !!}
    </div>
    <div class="popup-closed">
        <button type="button" class="btn-close" onclick="popupClose()" aria-label="Close"></button>
    </div>
</div>
<style>
    .bar-popup {
        position: absolute;
        width: 100%;
        height: auto;
        -webkit-box-shadow: 0px 5px 15px 5px rgba(0, 0, 0, 0.45);
        box-shadow: 0px 5px 15px 5px rgba(0, 0, 0, 0.45);
        display: none;
        flex-direction: row;
        align-items: center;
        padding: 20px;
        z-index: 900;
    }

    .popup-show {
        display: flex !important;
    }

    .popup-content {
        width: 100%;
        margin-left: 25px;
        display: block;
        word-break: break-all;
    }

    .popup-content:before {
        content: " ";
        width: 2px;
        background: black;
        height: 65%;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        margin-left: -8px;
    }

    .bar-top {
        top: 0;
        left: 0;
    }

    .popup-header {
        font-size: 1.5em;
        font-weight: 600;
        white-space: nowrap;
    }

</style>
<script>
    function popupClose() {
        var popup = document.getElementById("topPopup{{ $popup->id }}");
        popup.classList.remove('popup-show');
    }

    function popupOpen() {
        var popup = document.getElementById("topPopup{{ $popup->id }}");
        popup.classList.add('popup-show');
    }

    @if($popup->trigger == 1)
        setTimeout(function () {
            popupOpen();
        }, 1000);
    @elseif($popup->trigger == 2)
        setTimeout(function () {
            popupOpen();
        }, {{$popup->trigger_count*1000}});
    @elseif($popup->trigger == 3)
        $(window).scroll(function () {
            if ($(document).scrollTop() > {{ $popup->trigger_count }}) {
                popupOpen();
            }
        });
    @endif
    @if($popup->display_second)
    @php($second = $popup->trigger == 2 ? $popup->trigger_count : 1)
    setTimeout(function () {
        popupClose()
    }, {{ ($popup->display_second + $second) * 1000}});
    @endif

</script>
