@php
$selected = ($itemCategory->id == old('parent_id')) ? 'selected' : '';
@endphp

<option value="{{$itemCategory->id}}" {{$selected}}>{{ $level . $itemCategory->title }}</option>

@php
$level .= '-- ';
@endphp

@foreach($categories->where('parent_id', $itemCategory->id) as $childrenCategories)
    @include('category.partials.category-list-select-create', ['itemCategory' => $childrenCategories, 'level' => $level])
@endforeach






