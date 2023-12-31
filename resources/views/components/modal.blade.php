@props(['title','name'])
<div
 x-data = "{show : false, name : '{{$name}}'}"
 x-show = "show"
 x-on:open-modal.window="show = ($event.detail.name === name)"
 x-on:close-modal.window="show = false"
 x-on:keydown.escape.window="show = false"
 x-transition.duraction.500ms
 style="display: none"
 class="fixed z-50 inset-0">
    <div  x-on:click="show = false" class="fixed inset-0 bg-gray-300 opacity-400"></div>
    <div class="bg-white rounded m-auto fixed inset-0 max-w-2xl " style="max-height: 500px">
        @if($title)
        <div class="py-3 flex items-center justify-center">
            {{$title}} 
             <button x-on:click="$dispatch('close-modal')" class="btn text-red"> X </button>
        </div>
        @endif
        <div>
            {{$body}}
        </div>
    </div>
</div>