import {loadStripe} from '@stripe/stripe-js';

export default class StripeClass {
    constructor() {
        this.stripe = null;
        this.elements = null;
        this.cardElement = null;
        this.isErrorCard = null;
        this.style = {
            base: {
              color: "#32325d",
              fontFamily: 'Arial, sans-serif',
              fontSmoothing: "antialiased",
              fontSize: "16px",
              "::placeholder": {
                color: "#32325d"
              },
            },
            invalid: {
              fontFamily: 'Arial, sans-serif',
              color: "#fa755a",
              iconColor: "#fa755a"
            }
          };
    }

    async loadStripe(cardEl) {
        this.stripe = await loadStripe(process.env.VUE_APP_STRIPE_PUBLIC_KEY || '');
        this.createCard();
        this.mountCard(cardEl);
        this.addEventChange();
    }

    createCard() {
        this.elements = this.stripe.elements();
        this.cardElement = this.elements.create('card',{style:this.style});
    }

    mountCard(cardEl) {
        this.cardElement.mount(`#${cardEl}`);
        this.addEventChange();
    }

    addEventChange() {
        this.cardElement.on('change', function(event) {
            let displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
                this.isErrorCard = true;
            } else {
                displayError.textContent = '';
                this.isErrorCard = false;
                document.getElementById("stripebtnpayment").setAttribute("disabled", "");
            }
        });
    }

    async paymentSubmit(data) {
        if(this.isErrorCard) return false;
        let {paymentMethod, error} = await this.stripe
                .createPaymentMethod({
                    type: 'card',
                        card: this.cardElement,
                        billing_details: {
                        name: data.name,
                        email: data.email
                    },
                });

            if(error) {
                let displayError = document.getElementById('card-errors');
                displayError.textContent = error.message;
                return false;
            } else {
                // get paymentmethod id 
                // var paymentMethodinput = document.getElementById('paymentMethod');
                // paymentMethodinput.value = paymentMethod.id
                sessionStorage.setItem('paymentMethod', paymentMethod.id);
                // document.getElementById('paystripeform').submit();
                return true;
            }
    }

    auth_3d(clientSecret) {
        return new Promise((res, rej) => {
            this.stripe.handleCardAction(clientSecret).then((response) => {
                if(response.error) {
                    return rej({response: false, error: response});
                } else {
                    return res({response: true, error: response});
                }
            });
        });
        // this.stripe.handleCardAction(clientSecret).then((response) => {
        //     if(response.error) {	
        //         return {response: false, error: response}
        //     } else {
        //         return {response: true, error: response}
        //     }
        // });
    }

}