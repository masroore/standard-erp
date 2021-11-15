@php
    $value = null;
    for ($i=0; $i < $child_category->level; $i++){
        $value .= ' - ';
    }
@endphp
<option value="{{ $child_category->id }}" {{($item->account_id == $child_category->id ) ? 'selected' : ''}}>{{ $lang == 'ar' ? $value." ".$child_category->title_ar :  $value." ".$child_category->title_en}}</option>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @include('backend.finance.settings.child_account', ['child_category' => $childCategory])
    @endforeach
@endif




