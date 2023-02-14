<tr>
    <td style="width: 52px;text-align: center;" scope="row">{{$category->id}}</td>
    <th>
        <div style="padding-left: {{$level}}px">
            <input name="categories[]" class="lvl-{{$level}} form-check-input me-1" type="checkbox"
                   value="{{$category->id}}" aria-label="...">
            <a href="{{route('category.edit', $category)}}">{{$category->title}}</a>
        </div>
    </th>
</tr>
@php
    $level += 20;
@endphp
@foreach($categories->where('parent_id', $category->id) as $childrenCategories)
    @include('category.partials.category-list-table', ['category' => $childrenCategories, 'level' => $level])
@endforeach






