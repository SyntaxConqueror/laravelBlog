document.addEventListener("DOMContentLoaded", function () {
    const userSelect = document.getElementById('userSelect');

    userSelect.addEventListener('change', function () {
        const selectedUserId = userSelect.value;
        const route = userRoute.replace('userId', selectedUserId);

        axios.get(route)
            .then(function (response) {
                const userData = response.data;

                console.log(userData);
                const name = document.getElementsByName('nameU')[0];
                const email = document.getElementsByName('emailU')[0];

                const role = document.getElementsByName('selectedRole__updateForm')[0];

                name.value = userData.name;
                email.value = userData.email;

                for (let i = 0; i < role.options.length; i++) {
                    if (role.options[i].value.toLowerCase() === userData.role.toLowerCase()) {
                        role.options[i].selected = true;
                        break;
                    }
                }
            })
            .catch(function (error) {
                console.error('Error fetching post data:', error);
            });
    });
});
