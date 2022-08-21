@php
/** @var \App\Models\User $user */
@endphp

@component('mail::message')
# {{__('Email Verification')}}

{{__('Hi')}} {{ $user->name }},
{{__('Please verify your account by clicking on the link below.')}}
@component('mail::button', ['url' => route('verification.verify', ['id' => $user->getId(), 'hash' => $user->getVerificationToken()])])
	{{__('Click Here')}}
@endcomponent

{{__('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
