<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://www.skipprichard.com/wp-content/uploads/2013/12/bigstock-Happy-group-of-friends-family-43459618.jpg" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
