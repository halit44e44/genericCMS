@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600" style="background-color: #6c757d; color: white; padding:10px; text-align:center;">
            {{ __('auth.warning') }}
        </div>  
    </div>
@endif
