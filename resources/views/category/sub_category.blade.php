<li>{{$sub_categories->title}}</li>
@if($sub_categories->categories)
    <ul>
    @foreach ($sub_categories->categories as $child)
        @include('category.sub_category', ['sub_categories' => $child])   
    @endforeach    
    </ul>    
@endif