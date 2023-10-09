@extends('tableWidget')
@section('post__create__form')
    <form method="POST" enctype="multipart/form-data" action="{{route('post.create')}}"  class="create-form">
        @csrf
        <div class="create-block">
            <span>Title</span>
            <input placeholder="Type here..." name="postTitle" aria-label="title"/>
        </div>
        <div class="create-block">
            <span>Content</span>
            <input placeholder="Type here..." name="postContent" aria-label="content"/>
        </div>
        <div class="create-block">
            <span>Category</span>
            <label>
                <select id="postCategorySelect" name="postCategorySelect">
                    @foreach($categories as $category)
                        <option class="category__option" value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="publish__container">
            <input class="publish__checkbox" name="is_post_published" type="checkbox" aria-label="is_published">
            <span>Published</span>
        </div>
        <div class="create-block">
            <span>Preview</span>
            <input type="file" placeholder="Type here..." name="postPreview" aria-label="preview"/>
        </div>
        <div class="form__submit__button" >
            <button type="submit">Create post</button>
        </div>
    </form>
@endsection

@section('post__update__form')

    <form method="POST" action="" class="create-form">
        @csrf
        <div class="create-block">

            <label>
                <span>Choose id: </span>
                <select id="postSelect" name="selectedPostId">
                    @foreach($posts as $post)
                        <option value="{{$post->id}}">{{$post->id}}</option>
                    @endforeach
                </select>
            </label>

        </div>
        <div class="create-block">
            <span>Title</span>
            <input placeholder="Type here..." name="title" aria-label="title"/>
        </div>
        <div class="create-block">
            <span>Content</span>
            <input placeholder="Type here..." name="content" aria-label="content"/>
        </div>
        <div class="create-block">
            <span>Category</span>
            <label>
                <select id="postCategorySelect" name="postCategorySelect">
                    @foreach($categories as $category)
                        <option class="category__option" value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <div class="publish__container">
            <input class="publish__checkbox" name="is_published" type="checkbox" aria-label="is_published">
            <span>Published</span>
        </div>
        <div class="create-block">
            <span>Preview</span>
            <input type="file" placeholder="Type here..." name="preview" aria-label="preview"/>
        </div>
        <div class="form__submit__button" >
            <button type="submit">Update post</button>
        </div>
    </form>


    <script>
        const categories = @json($categories);
        const postRoute = "{{ route('getPostById', 'postId') }}";
    </script>
    <script src="{{ asset('js/postUpdate.js') }}"></script>

@endsection


@section('post__delete__form')
    <form action="" class="create-form">
        <div class="create-block">

            <label>
                <span>Choose id: </span>
                <select id="postSelect" name="selectedPostId">
                    @foreach($posts as $post)
                        <option value="{{$post->id}}">{{$post->id}}</option>
                    @endforeach
                </select>
            </label>

        </div>

        <div class="form__submit__button" >
            <button type="submit">Delete post</button>
        </div>
    </form>
@endsection
