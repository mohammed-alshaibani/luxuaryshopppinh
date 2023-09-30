@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('images/رفاهية التسوق.svg') }}" class="logo" alt="لاكسري شوبنج" width="30%" height="50%">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
