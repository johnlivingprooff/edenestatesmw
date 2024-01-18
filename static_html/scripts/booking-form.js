const vm = Vue.createApp({
    data() {
        return{
            reservation: {
            checkin: '',
            checkout: '',
            guests: '1'
            }
        };
    },
    methods: {
        submitReservation() {
            this.sendDataToServer();

            this.reservation = {
                checkin: '',
                checkout: '',
                guests: '1'
            };
        },
        sendDataToServer() {
            const baseUri = process.env.VUE_APP_BASE_URL;
            console.log('Sending reservation data to server:', this.reservation);
            // implementing API call here
            fetch(`${baseUri}/b/reservations/`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(this.reservation)
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    },
    template: `
    <h2>Book Your Stay</h2>
    <p>Required fields are followed by *</p>

    <form @submit.prevent="submitReservation">

        <label for="checkin">Check-in Date: *</label>
        <input v-model="reservation.checkin" type="date" id="checkin" required>

        <label for="checkout">Check-out Date: *</label>
        <input v-model="reservation.checkout" type="date" id="checkout" required>

        <label for="guests">Adults</label>
        <select v-model="reservation.guests" id="guests" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit">see options</button>
    </form>
    `
}).mount('#booking-form')