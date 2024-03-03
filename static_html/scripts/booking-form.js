const bookingForm = Vue.createApp({
  el: '#booking-form',
  data () {
    return {
      reservation: {
        checkin: '',
        checkout: '',
        guests: 1
      }
    };
  },
  methods: {
    calcDatePrice () {
        
    }
  }
}).mount();
