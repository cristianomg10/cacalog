@props([
    'name',
    'show' => false,
])

<div
    x-data="{ show: @js($show) }"
    x-init="$watch('show', value => {
        document.body.classList.toggle('overflow-hidden', value);
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="modal fade show d-block"
    tabindex="-1"
    style="display: {{ $show ? 'block' : 'none' }}; background-color: rgba(0,0,0,.5);"
>
    <div class="modal-dialog">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>
