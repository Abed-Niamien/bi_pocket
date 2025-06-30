@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === config('app.name'))
<img src="{{ asset('images/bi-pocket-logo.jpeg') }}" class="logo" alt="Logo de BI POCKET">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
