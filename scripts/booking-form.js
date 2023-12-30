(function() {
    new Vue({
        el: '#booking-form',
        components: {
            Datepicker: vuejsDatepicker,
        },
        data: {
            reservation: {
                checkin: null,
                checkout: null,
                guests: '1'
            }
        },
        methods: {
            submitReservation() {
                // Add logic to send the reservation data to your server
                console.log('Reservation submitted:', this.reservation);
                // Reset the form or perform any other actions after submission
                this.reservation = {
                    checkin: null,
                    checkout: null,
                    guests: '1'
                };
            }
        }
    });    
})
