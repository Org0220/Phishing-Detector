



//parse emails from data/mixed_email.json file

fetch('../FrontEnd/data/mixed_emails.json')
    .then(response => response.json())
    .then(data => {
        let emails = data.map(email => {
            let emailBody = email['body']
            let emailSubject = email['subject']
            let emailSender = email['sender']
            let emailRecipients = email['recipients']
            let emailDate = email['date']
            let emailId = email['id']
            let emailElement = {
                emailBody,
                emailSubject,
                emailSender,
                emailRecipients,
                emailDate,
                emailId
            }
            return emailElement
        })

        // create an email component for each email
        emails.forEach(email => {
            let emailComponent = document.createElement('div')
            emailComponent.className = 'email'
            emailComponent.innerHTML = `
                    <div class="email-sender">${email.emailSender}</div>
                    <div class="email-subject">${email.emailSubject}</div>
                    <div class="email-body
                    ">${email.emailBody}</div>
                    <div class="email-recipients">${email.emailRecipients}</div>
                    <div class="email-date
                    ">${email.emailDate}</div>
                    <div class="email-id">${email.emailId}</div>
                `
            document.body.appendChild(emailComponent)
        })
    })
    .catch(error => console.error(error))



