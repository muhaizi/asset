<ul>
@foreach ($categories as $category)
<li>{{$category->title}}</li>
    <ul>
    @foreach ($category->childCategories as $child)
        @include('category.sub_category', ['sub_categories' => $child])   
    @endforeach    
    </ul>    
@endforeach
</ul>