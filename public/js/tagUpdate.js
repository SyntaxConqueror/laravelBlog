document.addEventListener("DOMContentLoaded", function () {
    const tagSelect = document.getElementById('tagSelect');

    tagSelect.addEventListener('change', function () {
        const selectedTagId = tagSelect.value;
        const route = tagRoute.replace('tagId', selectedTagId);

        axios.get(route)
            .then(function (response) {
                const tagData = response.data;

                const name = document.getElementsByName('name')[1];

                name.value = tagData.name;
            })
            .catch(function (error) {
                console.error('Error fetching post data:', error);
            });
    });
});
