@component('mail::message')
# Password Reset Link

{{__('Hi')}} {{ $user->getFirstName() }},<br>
{{__('Please use the link below to reset your password.')}}.

@component('mail::button', ['url' => env('APP_FRONT_END_URL') . 'reset-password/' . $token])
	{{__('Click Here')}}
@endcomponent

{{__('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
