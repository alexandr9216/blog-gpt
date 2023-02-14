@php
//$selected = ($itemCategory->id == old('parent_id', $category->parent->id ?? null)) ? 'selected' : '';
//$disabled = ($itemCategory->id == $category->id) ? 'disabled' : '';
$disabled = ($childCategories->contains($itemCategory)) ? 'disabled' : '';
@endphp

<option value="{{$itemCategory->id}}" {{$disabled}}>{{ $level . $itemCategory->title }}</option>

@php
$level .= '-- ';
@endphp

@foreach($categories->where('parent_id', $itemCategory->id) as $childrenCategories)
    @include('category.partials.category-list-select-set-parent', ['itemCategory' => $childrenCategories, 'level' => $level])
@endforeach






