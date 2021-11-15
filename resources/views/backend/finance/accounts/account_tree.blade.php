

<li class="file-tree-folder">{{ $lang == 'ar' ? $child_category->title_ar  : $child_category->title_en}}

    @if ($child_category->categories)
    <ul>
    @foreach ($child_category->categories as $childCategory)
        @include('backend.finance.accounts.account_tree', ['child_category' => $childCategory])
    @endforeach
    </ul>
    @endif

</li>

