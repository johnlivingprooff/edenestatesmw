(function() {
    new Vue({
        el: '#booking-form',
        data: {
            reservation: {
                checkin: '',
                checkout: '',
                guests: ''
            }
        },
        methods: {
            submitReservation() {
                // Simulate sending the reservation data to your server
                this.sendDataToServer();
 
                // Reset the form or perform any other actions after submission
                this.reservation = {
                   checkin: '',
                   checkout: '',
                   guests: ''
                };
            },
            sendDataToServer() {
                // This is a placeholder function. Replace this with actual AJAX call or Fetch API call to your server.
                console.log('Sending reservation data to server:', this.reservation);
            }
        }
    });   
 })
 