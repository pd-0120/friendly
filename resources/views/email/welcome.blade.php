<x-mail::message>
Hi {{ $user->name }},
Your account has been created with {{ config('app.name') }}.
Your login email is {{ $user->email }}, and password is {{ $password }}
<x-mail::button :url="{{ config('app.url') }}">
Login Here
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
