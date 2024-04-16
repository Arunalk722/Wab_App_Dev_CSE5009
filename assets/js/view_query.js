document.addEventListener("DOMContentLoaded", function() {
    // Fetch query data
    fetchQueryData();

    function fetchQueryData() {
        fetch('scripts/get_queries.php')
            .then(response => response.json())
            .then(data => {
                populateQueryTable(data);
            })
            .catch(error => console.error('Error fetching query data:', error));
    }

    function populateQueryTable(data) {
        const queryTableBody = document.querySelector('#query-table tbody');
        queryTableBody.innerHTML = '';        
        data.forEach(query => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${query.full_name}</td>
                <td>${query.email_address}</td>
                <td>${query.phone_no}</td>
                <td>${query.farmer_address}</td>
                <td>${query.location}</td>
                <td>${query.services}</td>
                <td>${query.farmer_query}</td>
                <td>${query.log_time}</td>
            `;
            queryTableBody.appendChild(row);
        });
    }
});
