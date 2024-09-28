<x-mail::message>
# Introduction

The Blood Bank messages.

<x-mail::button :url="'http://127.0.0.1:8000/client/change-password'">
Reset Password
</x-mail::button>

Thanks,<br>
<p>Your Reset Code is : {{$pin_code}} </p>
{{ config('Blood.Bank') }}
</x-mail::message>
