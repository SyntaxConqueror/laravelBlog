@extends('tableWidget')
@section('post__create__form')
    <form method="POST" enctype="multipart/form-data" action="{{route('post.create')}}"  class="create-form">
        @csrf
        <div class="form__block">
            <span>Title</span>
            <input placeholder="Type here..." name="postTitle" aria-label="title"/>
        </div>
        <div class="form__block">
            <span>Content</span>
            <input placeholder="Type here..." name="postContent" aria-label="content"/>
        </div>
        <div class="form__block">
            <span>Category</span>
            <label>
                <select id="postCategorySelect" name="postCategorySelect">
                    @foreach($categories as $category)
                        <option class="category__option" value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <label for="users">Choose tags: </label>
        <div class="form__block checkbox__block">

            @foreach($tags as $tag)
                <label>
                    <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                    {{$tag->name}}
                </label>
            @endforeach
        </div>
        <div class="publish__container">
            <input class="publish__checkbox" name="is_post_published" type="checkbox" aria-label="is_published">
            <span>Published</span>
        </div>
        <div class="form__block">
            <span>Preview</span>
            <input type="file" placeholder="Type here..." name="postPreview" aria-label="preview"/>
        </div>
        <div class="form__submit__button" >
            <button type="submit">Create post</button>
        </div>
    </form>
@endsection

@section('post__update__form')

    <form method="POST" action="{{route('post.update')}}" enctype="multipart/form-data" class="create-form">
        @csrf
        @method('PATCH')
        <div class="form__block">
            <label>
                <span>Choose id: </span>
                <select id="postSelect" name="selectedPostId">
                    @foreach($posts as $post)
                        <option value="{{$post->id}}">{{$post->id}}</option>
                    @endforeach
                </select>
            </label>

        </div>
        <div class="form__block">
            <span>Title</span>
            <input placeholder="Type here..." name="title" aria-label="title"/>
        </div>
        <div class="form__block">
            <span>Content</span>
            <input placeholder="Type here..." name="content" aria-label="content"/>
        </div>
        <div class="form__block">
            <span>Category</span>
            <label>
                <select id="postCategorySelect" name="postCategorySelect__updateForm">
                    @foreach($categories as $category)
                        <option class="category__option" value="{{$category->id}}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <label for="users">Choose tags: </label>
        <div class="form__block checkbox__block">

            @foreach($tags as $tag)
                <label>
                    <input type="checkbox" name="tags[]" value="{{$tag->id}}">
                    {{$tag->name}}
                </label>
            @endforeach
        </div>
        <div class="publish__container">
            <input class="publish__checkbox" name="is_published" type="checkbox" aria-label="is_published">
            <span>Published</span>
        </div>
        <div class="form__block">
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
    <form method="POST" action="{{route('post.delete')}}" enctype="multipart/form-data" class="create-form">
        @csrf
        @method('DELETE')
        <div class="form__block">

            <label>
                <span>Choose id: </span>
                <select id="postSelect" name="selectedPostId__deleteForm">
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


@section('categories_tags_create_form')
    <form method="POST" action="{{ request()->has('categories') ? route('category.create') : route('tag.create') }}" enctype="multipart/form-data" class="create-form">
        @csrf
        <div class="form__block">
            <span>Write the name: </span>
            <input name="name" aria-label="name" placeholder="Type here...">
        </div>
        <div class="form__submit__button">
            <button type="submit">Create</button>
        </div>
    </form>
@endsection

@section('categories_tags_update_form')
    <form method="POST" action="{{ request()->has('categories') ? route('category.update') : route('tag.update') }}" enctype="multipart/form-data" class="create-form">
        @csrf
        @method('PATCH')
        <div class="form__block">
            @if(request()->has('tags'))

                <label for="tagSelect">Choose tag id: </label>

                <select id="tagSelect" name="selectedTagId__updateForm">
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->id}}</option>
                    @endforeach
                </select>

                <script>
                    const tagRoute = "{{ route('tag.by.id', 'tagId') }}";
                </script>
                <script src="{{ asset('js/tagUpdate.js') }}"></script>

            @elseif(request()->has('categories'))

                <label for="categorySelect">Choose category id: </label>

                <select id="categorySelect" name="selectedCategoryId__updateForm">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->id}}</option>
                    @endforeach
                </select>

                <script>
                    const categoryRoute = "{{ route('category.by.id', 'categoryId') }}";
                </script>
                <script src="{{ asset('js/categoryUpdate.js') }}"></script>

            @endif

        </div>
        <div class="form__block">
            <span>Write the name: </span>
            <input name="name" aria-label="name" placeholder="Type here...">
        </div>
        <div class="form__submit__button">
            <button type="submit">Update</button>
        </div>
    </form>

@endsection


@section('categories_tags_delete_form')
    <form method="POST" action="{{ request()->has('categories') ? route('category.delete') : route('tag.delete') }}" enctype="multipart/form-data" class="create-form">
        @csrf
        @method('DELETE')
        <div class="form__block">
            @if(request()->has('tags'))
                <label for="tag">Choose tag id: </label>
                <select id="tag" name="selectedTagId__deleteForm">
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->id}}</option>
                    @endforeach
                </select>
            @elseif(request()->has('categories'))
                <label for="category">Choose category id: </label>
                <select id="category" name="selectedCategoryId__deleteForm">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->id}}</option>
                    @endforeach
                </select>
            @endif

        </div>
        <div class="form__submit__button">
            <button type="submit">Delete</button>
        </div>
    </form>
@endsection

@section('users_create_form')
    <form method="POST" action="{{route('user.create')}}" enctype="multipart/form-data" class="create-form">
        @csrf

        <div class="form__block">
            <span>Name: </span>
            <input name="name" aria-label="name" placeholder="Type here...">
        </div>
        <div class="form__block">
            <span>Email: </span>
            <input name="email" aria-label="name" placeholder="Type here...">
        </div>
        <div class="form__block">
            <span>Password: </span>
            <input name="password" type="password" aria-label="name" placeholder="Type here...">
        </div>
        <div class="form__block">
            <label for="roleC">Role: </label>
            <select id="roleC" name="selectedRole__createForm">
                <option value="USER">USER</option>
                <option value="ADMIN">ADMIN</option>
            </select>
        </div>
        <div class="form__submit__button">
            <button type="submit">Create user</button>
        </div>
    </form>
@endsection


@section('users_update_form')
    <form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data" class="create-form">
        @csrf
        @method('PATCH')
        <div class="form__block">
            <label for="userSelect">Choose user id: </label>
            <select id="userSelect" name="selectedUserId__updateForm">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->id}}</option>
                @endforeach
            </select>
        </div>
        <div class="form__block">
            <span>Name: </span>
            <input name="nameU" aria-label="name" placeholder="Type here...">
        </div>
        <div class="form__block">
            <span>Email: </span>
            <input name="emailU" aria-label="name" placeholder="Type here...">
        </div>
        <div class="form__block">
            <span>Password: </span>
            <input name="passwordU" type="password" aria-label="name" placeholder="Type here...">
        </div>
        <div class="form__block">
            <label for="role">Role: </label>
            <select id="role" name="selectedRole__updateForm">
                <option value="USER">USER</option>
                <option value="ADMIN">ADMIN</option>
            </select>
        </div>
        <div class="form__submit__button">
            <button type="submit">Update user</button>
        </div>
    </form>
    <script>
        const userRoute = "{{ route('user.by.id', 'userId') }}";
    </script>
    <script src="{{ asset('js/userUpdate.js') }}"></script>
@endsection

@section('users_delete_form')
    <form method="POST" action="{{route('user.delete')}}" enctype="multipart/form-data" class="create-form">
        @csrf
        @method('DELETE')
        <div class="form__block">
            <label for="userSelect">Choose user id: </label>
            <select id="userSelect" name="selectedUserId__deleteForm">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->id}}</option>
                @endforeach
            </select>
        </div>

        <div class="form__submit__button" >
            <button type="submit">Delete user</button>
        </div>
    </form>
@endsection

