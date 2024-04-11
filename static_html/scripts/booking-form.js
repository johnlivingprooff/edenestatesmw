const app = Vue.createApp({
    data() {
        return {
            reservation: {
                checkin: null,
                checkout: null,
                guests: 1
            }
        };
    },
    methods: {
        calcDatePrice() {
            // This method can be used to calculate prices or perform other actions when the form is submitted
        },
        validateDates() {
            const today = new Date().toISOString().split('T')[0];
            // Ensure that check-out date is not before check-in date
            if (this.reservation.checkin && this.reservation.checkout && this.reservation.checkout < this.reservation.checkin) {
                // If check-out date is before check-in date, set check-out date to the same as check-in date
                this.reservation.checkout = this.reservation.checkin;
            }

            // Ensure that check-in date is not before today
            if (this.reservation.checkin && this.reservation.checkin < today) {
                // If check-in date is before today, set it to today's date
                this.reservation.checkin = today;
            }
        }
    },
    watch: {
        // Watch for changes in check-in and check-out dates and validate them
        'reservation.checkin': 'validateDates',
        'reservation.checkout': 'validateDates'
    }
});

app.mount('#booking-form');

