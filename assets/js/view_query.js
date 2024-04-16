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
                <div><strong>Contact:</strong> ${query.email_address} ${query.phone_no}</div>               
                <div><strong>Address:</strong> ${query.farmer_address}</div>
                <div><strong>Location:</strong> ${query.location}</div>
                <div><strong>Related Service:</strong> ${query.services}</div>
                <div class='right-text'>${query.log_time}</div>
                </div>
                <div class="query-style"><strong>Query:</strong> ${query.farmer_query}</div>           
                <div class="button-container">
                <button class="edit-btn" onclick="editQuery(${query.id})">Edit</button>
                <button class="delete-btn" onclick="deleteQuery(${query.id})">Delete</button>
                <button class="view-btn" onclick="viewQuery(${query.id})">View</button>
                </div>
            `;
            queryContainer.appendChild(row);
        });
    }

    function editQuery(id) {
        // Implement edit functionality
        console.log('Edit query with ID:', id);
    }

    function deleteQuery(id) {
        // Implement delete functionality
        console.log('Delete query with ID:', id);
    }

    function viewQuery(id) {
        // Implement view functionality
        console.log('View query with ID:', id);
    }
});
