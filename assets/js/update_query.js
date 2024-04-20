document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('update-query-form');

    // Function to fetch data based on query ID from the URL
    function fetchData() {
        const urlParams = new URLSearchParams(window.location.search);
        const queryId = urlParams.get('id');
        if (queryId) {
            fetch(`scripts/update_query.php?query-id=${queryId}`)
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Failed to fetch query data');
                    }
                })
                .then(data => {
                    document.getElementById('farmer-name').value = data.farmer_name;
                    document.getElementById('query-id').value = queryId;
                    document.getElementById('quest').value = data.farmer_query;
                    document.getElementById('solution').value = data.officer_solution;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }
    fetchData();
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        postData();
    });
    function postData() {
        const formData = new FormData(form);
        fetch('scripts/update_query.php', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Failed to update query');
            }
        }).then(data => {
            if (data.success) {                
                document.getElementById('message-text').textContent = "update successfully";
                document.getElementById('custom-dialog').style.display = 'block';         
            } else {
                alert("Error: " + data.message);
            }
        }).catch(error => {
            console.error('Error:', error);
        });
        document.getElementById('ok-button').addEventListener('click', function() {
            window.location.href = 'list_of_querys.html';
        });
    }
});
