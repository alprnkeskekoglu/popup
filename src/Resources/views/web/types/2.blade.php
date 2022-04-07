<div class="modal fade" id="popupModal{{ $popup->id }}" tabindex="-1" aria-labelledby="modal{{ $popup->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                @if($popup->show_name)
                    <h5 class="modal-title" id="modal{{ $popup->id }}Label">{{ $popup->translation->name }}</h5>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! $popup->translation->detail !!}
            </div>
        </div>
    </div>
</div>

<script>
    var modal{{ $popup->id }} = new bootstrap.Modal(document.getElementById("popupModal{{ $popup->id }}"))
    @if($popup->trigger == 1)
    setTimeout(function () {
        modal{{ $popup->id }}.show();
    }, 1000);
    @elseif($popup->trigger == 2)
    setTimeout(function () {
        modal{{ $popup->id }}.show();
    }, {{$popup->trigger_count*1000}});
    @elseif($popup->trigger == 3)
    $(window).scroll(function () {
        if ($(document).scrollTop() > {{ $popup->trigger_count }}) {
            modal{{ $popup->id }}.show();
        }
    });
    @endif

    @if($popup->display_second)
    @php($second = $popup->trigger == 2 ? $popup->trigger_count : 1)
    setTimeout(function () {
        modal{{ $popup->id }}.hide();
    }, {{ ($popup->display_second + $second) * 1000}});
    @endif
</script>
