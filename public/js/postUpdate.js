document.addEventListener("DOMContentLoaded", function () {
    const postSelect = document.getElementById('postSelect');

    postSelect.addEventListener('change', function () {
        const selectedPostId = postSelect.value;
        const route = postRoute.replace('postId', selectedPostId);

        axios.get(route)
            .then(function (response) {
                const postData = response.data;

                const postTitle = document.getElementsByName('title')[0];
                const postContent = document.getElementsByName('content')[0];
                const postCategory = document.getElementsByName('postCategorySelect')[1];
                const postPublished = document.getElementsByName('is_published')[0];
                const postPreview = document.getElementsByName('preview')[0];

                const categoryId = postData.category_id;

                // Set the values of the input fields
                postTitle.value = postData.title;
                postContent.value = postData.content;
                for (let i = 0; i < postCategory.options.length; i++) {
                    if (parseInt(postCategory.options[i].value) === categoryId) {
                        postCategory.options[i].selected = true;
                        break;
                    }
                }
                postPublished.checked = postData.is_published;
            })
            .catch(function (error) {
                console.error('Error fetching post data:', error);
            });
    });
});
