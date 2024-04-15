document.addEventListener("DOMContentLoaded", function() {    
    fetchLocations();   
});

function fetchLocations() {    
    fetch('scripts/submit_query.php')
        .then(response => response.json())
        .then(data => {
            const selectElement = document.getElementById('locations');
            data.forEach(location => {
                const option = document.createElement('option');
                option.value = location.location_name;
                option.textContent = location.location_name;
                selectElement.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching locations:', error));
}
