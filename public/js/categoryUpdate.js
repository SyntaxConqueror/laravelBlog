document.addEventListener("DOMContentLoaded", function () {
    const categorySelect = document.getElementById('categorySelect');

    categorySelect.addEventListener('change', function () {
        const selectedCategoryId = categorySelect.value;
        const route = categoryRoute.replace('categoryId', selectedCategoryId);

        axios.get(route)
            .then(function (response) {
                const categoryData = response.data;

                const name = document.getElementsByName('name')[1];

                name.value = categoryData.name;
            })
            .catch(function (error) {
                console.error('Error fetching post data:', error);
            });
    });
});
