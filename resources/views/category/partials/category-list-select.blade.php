@php
$selected = ($itemCategory->id == old('parent_id', $category->parent->id ?? null)) ? 'selected' : '';
$disabled = ($itemCategory->id == $category->id) ? 'disabled' : '';
@endphp

<option value="{{$itemCategory->id}}" {{$selected}} {{$disabled}}>{{ $level . $itemCategory->title }}</option>

@php
$level .= '-- ';
@endphp

@foreach($categories->where('parent_id', $itemCategory->id) as $childrenCategories)
    @include('category.partials.category-list-select', ['itemCategory' => $childrenCategories, 'level' => $level])
@endforeach






