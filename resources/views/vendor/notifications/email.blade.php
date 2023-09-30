<x-mail::message>
{{-- التحية --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# نعتذر عن وجود خطأ بسبب ضعف الإنترنت، يرجى المحاولة مرة أخرى
@else
#   شكرا لإختيارك متجرنا ،معانا رفاهية تسوق أكبر 
@endif
@endif


{{-- زر العملية --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
اضغط هنا لتغيير كلمة السر
</x-mail::button>
@endisset

{{-- الفقرات الختامية --}}

{{-- التوقيع --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<br>
{{ config('لاكسري شوبنج') }}
@endif

{{-- نص الاستنساخ --}}
@isset($actionText)
<x-slot:subcopy>
@if ($actionText === 'اضغط هنا')
إذا واجهتك مشكلة في النقر على الزر "اضغط هنا"، يمكنك نسخ ولصق الرابط أدناه
في متصفح الويب الخاص بك:
@else
إذا واجهتك مشكلة في النقر على الزر "{{ $actionText }}"، يمكنك نسخ ولصق الرابط أدناه
في متصفح الويب الخاص بك:
@endif
<span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot:subcopy>
@endisset
</x-mail::message>