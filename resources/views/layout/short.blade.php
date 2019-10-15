<div class="shorting-menu">
    <div class="container shorting-items d-flex flex-row-reverse">

        <form action="{{route('filter.posts')}}">
            <select name="category" id="" onchange="this.form.submit()">

                @php
                    if(isset($_GET['category']) && !empty($_GET['category'])){
                        if($_GET['category'] == 'tur-advertencia'){
                                $categoryName = 'Tur Advertencia';
                                $categorySlug = 'tur-advertencia';
                        }else{
                            $category = \App\Category::where('slug',$_GET['category'])->first();
                            $categoryName = $category->name;
                            $categorySlug = $category->slug;
                        }
                    }else{
                    $categoryName = 'Categoria';
                    $categorySlug = '';
                    }
                @endphp

                <option value="{{$categorySlug}}">{{  $categoryName }}</option>
                @if(isset($categories))
                    @foreach($categories as $category)--}}
                    <option value="{{$category->slug}}">{{$category->name}}</option>
                    @endforeach
                    <option value="tur-advertencia">Tur advertencia</option>
                @endif
            </select>

            @php
                if(isset($_GET['subcategory']) && !empty($_GET['subcategory'])){
                        $subCategory = \App\SubCategory::where('slug',$_GET['subcategory'])->first();
                        $subCategoryName = $subCategory->name;
                        $subCategorySlug = $subCategory->slug;
                }else{
                $subCategoryName = 'Sub Categoria';
                $subCategorySlug = '';
                }
            @endphp
            <select name="subcategory" id="" onchange="this.form.submit()">
                <option value="{{$subCategorySlug}}">{{$subCategoryName}}</option>
                @if(isset($filterSubCategory))
                    @foreach($filterSubCategory as $subCategory)--}}
                    <option value="{{$subCategory->slug}}">{{$subCategory->name}}</option>
                    @endforeach
                @endif
            </select>

            @php
                if(isset($_GET['short']) && !empty($_GET['short'])){
                    $short = $_GET['short'];
                    $short = str_replace('-',' ',$short);
                    $short = ucwords($short);
                }else{
                    $short = 'Sorteer';
                }
            @endphp


            <select name="short" class="mr-0" id="" onchange="this.form.submit()">
                <option value="">{{$short}}</option>
                <option value="newest">Newest</option>
                <option value="oldest">Oldest</option>
                <option value="most-viewed">Most Viewed</option>
                <option value="price-high-to-low">Price High to Low</option>
                <option value="price-low-to-high">Price Low to High</option>
            </select>
        </form>
    </div>
</div>