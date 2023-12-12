<x-mail::message>
    ## New url created !

    {{-- <x-mail::button :url="''">
Button Text
</x-mail::button> --}}

    > original url : {{ $url->original_url }}

    > short url : {{ $url->short_url }}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
