const vm = Vue.createApp({
    template: `
    
    `,
    methods: {
        submitReservation() {
            console.log('Reservation submitted:', this.reservation)
        }
    },
}).mount('#booking-form')