document.addEventListener("DOMContentLoaded", function() {
    const locationsDropdown = document.getElementById('locations');
    const servicesDropdown = document.getElementById('services');  
    const fullName = getCookie("FullName");
    const emailAddress = getCookie("EmailAddress");    
    document.getElementById('email').value = emailAddress;       
    document.getElementById('name').value = fullName;
    const form = document.getElementById('query-form');

    
    fetchLocations();

    function getCookie(cname) {
        const name = cname + "=";
        const decodedCookie = decodeURIComponent(document.cookie);
        const ca = decodedCookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function fetchLocations() {    
        fetch('scripts/submit_query_locScan.php')
            .then(response => response.json())
            .then(data => {
                locationsDropdown.innerHTML = '';
                const initialOption = document.createElement('option');
                initialOption.value = ""; 
                initialOption.textContent = "Select a Location";
                locationsDropdown.appendChild(initialOption);
                data.forEach(location => {
                    const option = document.createElement('option');
                    option.value = location;
                    option.textContent = location;
                    locationsDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching locations:', error));
    }
    
    locationsDropdown.addEventListener('change', function() {
        const selectedLocation = this.value;         
        fetchServices(selectedLocation);
    });

    function fetchServices(location) {    
        fetch('scripts/submit_query_SerScan.php?loc=' + encodeURIComponent(location))
            .then(response => response.json())
            .then(data => {
                servicesDropdown.innerHTML = '';
                data.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service;
                    option.textContent = service;
                    servicesDropdown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching services:', error));
    }   

    form.addEventListener('submit', function(event) {       
        event.preventDefault(); 
        console.log('Submit button clicked'); 
        const formData = new FormData(form);
        fetch('scripts/Query_Submitter.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === '[true]') {                
                document.getElementById('message-text').textContent = "Query was submitted";
                document.getElementById('custom-dialog').style.display = 'block';
                
            } else {
                document.getElementById('message-text').textContent =('Failed to submit query:', data);
                document.getElementById('custom-dialog').style.display = 'block';
            }
        })
        .catch(error => console.error('Error submitting query:', error));     
        document.getElementById('message-text').textContent =('Error submitting query:', error);
        document.getElementById('custom-dialog').style.display = 'block';
    });   
    document.getElementById('ok-button').addEventListener('click', function() {
        window.location.href = 'index.html';
    });
     
     
    
      
});