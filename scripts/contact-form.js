(function() {
    new Vue({
        el: '#contact-form',
        data: {
            contactInfo: {
                name: '',
                email: '',
                phone: '',
                message: ''
            }
        },
        methods: {
            submitForm() {
                // Add logic to handle the submitted contact information
                console.log('Contact form submitted:', this.contactInfo);
                // You can send the data to a server, perform validation, etc.
                // Reset the form or perform any other actions after submission
                this.contactInfo = {
                    name: '',
                    email: '',
                    phone: '',
                    message: ''
                };
            }
        }
    });
})