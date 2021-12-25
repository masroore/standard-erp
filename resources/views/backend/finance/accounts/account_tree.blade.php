

<li class="file-tree-folder">{{ $lang == 'ar' ? $child_category->title_ar  : $child_category->title_en}}
    <a href="{{route('dashboard.finance.accounts.edit', $child_category->id)}}"><i class="fa fa-edit"></i></a>
    <form action="{{route('dashboard.finance.accounts.destroy', $child_category->id)}}" method="POST" style="display:inline-block">
        @csrf
        @method('delete')

    <a type="submit" class="ml-2  text-danger show_confirm" title="@lang('site.delete')"><i class="fa fa-trash" aria-hidden="true"></i></a>
    </form>

    @if ($child_category->categories)
    <ul>
    @foreach ($child_category->categories as $childCategory)
        @include('backend.finance.accounts.account_tree', ['child_category' => $childCategory])
    @endforeach
    </ul>
    @endif

</li>

