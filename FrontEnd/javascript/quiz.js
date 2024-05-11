


//parse emails from data/mixed_email.json file

fetch('data/mixed_email.json')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(jsonArray => {
        // Now you have jsonArray as a JavaScript array
        console.log(jsonArray);
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });

