document.addEventListener("DOMContentLoaded", function() {
    // Fetch query data
    fetchQueryData();

    function fetchQueryData() {
        fetch('scripts/get_queries.php')
            .then(response => response.json())
            .then(data => {
                populateQueryContainer(data);
            })
            .catch(error => console.error('Error fetching query data:', error));
    }

    function populateQueryContainer(data) {
        const queryContainer = document.getElementById('query-container');
        queryContainer.innerHTML = '';        
        data.forEach(query => {
            const row = document.createElement('div');
            row.classList.add('query-row');
            row.innerHTML = `
                <h1 class='h1-center'><strong>${query.full_name}</strong></h1>
                <div class="min-cont">          
                <div><strong>Address:</strong> ${query.farmer_address}</div>
                <div><strong>Location:</strong> ${query.location}</div>
                <div><strong>Related Service:</strong> ${query.services}</div>      
                <div><strong>Contact:</strong> ${query.email_address} ${query.phone_no}</div>      
                <div class='right-text'>${query.log_time}</div>
                </div>
                <div class="query-style"><strong>Query:</strong> ${query.farmer_query}</div>           
                <div class="button-container">
                <button class="edit-btn" data-id="${query.idtbl_farmar_query}">Edit</button>
                <button class="delete-btn" data-id="${query.idtbl_farmar_query}">Delete</button>
                <button class="view-btn" data-id="${query.idtbl_farmar_query}">View</button>
                </div>
            `;
            queryContainer.appendChild(row);
        });
        queryContainer.addEventListener('click', function(event) {
            const target = event.target;
            console.log('Button Clicked:', target); // Debugging statement
            const id = parseInt(target.getAttribute('data-id'));
            console.log('Clicked ID:', id); // Debugging statement
            if (!isNaN(id)) {
                if (target.classList.contains('edit-btn')) {
                    editQuery(id);
                } else if (target.classList.contains('delete-btn')) {
                    deleteQuery(id);
                } else if (target.classList.contains('view-btn')) {
                    viewQuery(id);
                }
            }
        });
    }

    function editQuery(id) {       
        window.alert('Edit query with ID: ' + id);
    }

    function deleteQuery(id) {        
        window.alert('Delete query with ID: ' + id);
    }

    function viewQuery(id) {
        window.alert('View query with ID: ' + id);
    }
});
