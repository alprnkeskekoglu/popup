<div class="modal fade" id="popupModal{{ $popup->id }}" tabindex="-1" aria-labelledby="modal{{ $popup->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-sm position-absolute bottom-0" style="margin: 0.5rem; width: 300px">
        <div class="modal-content">
            <div class="modal-header" style="padding: .5rem 1rem">
                @if($popup->show_name)
                    <h5 class="modal-title" id="modal{{ $popup->id }}Label" style="font-size: 15px">{{ $popup->translation->name }}</h5>
                @endif
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 12px"></button>
            </div>
            <div class="modal-body">
                {!! $popup->translation->detail !!}
            </div>
        </div>
    </div>
</div>

<script>
    var modal = new bootstrap.Modal(document.getElementById("popupModal{{ $popup->id }}"))
    @if($popup->trigger == 1)
    setTimeout(function () {
        modal.show();
    }, 1000);
    @elseif($popup->trigger == 2)
    setTimeout(function () {
        modal.show();
    }, {{$popup->trigger_count*1000}});
    @elseif($popup->trigger == 3)
    $(window).scroll(function () {
        if ($(document).scrollTop() > {{ $popup->trigger_count }}) {
            modal.show();
        }
    });
    @endif

    @if($popup->display_second)
    @php($second = $popup->trigger == 2 ? $popup->trigger_count : 1)
    setTimeout(function () {
        modal.hide();
    }, {{ ($popup->display_second + $second) * 1000}});
    @endif
</script>
