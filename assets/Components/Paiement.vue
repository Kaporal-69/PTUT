<template>
  <div>
    <stripe-checkout
      ref="checkoutRef"
      mode="payment"
      :pk="publishableKey"
      :line-items="lineItems"
      :success-url="successURL"
      :cancel-url="cancelURL"
      @loading="v => loading = v"
    />
    <button @click="submit">Pay now!</button>
  </div>
</template>

<script>
import { StripeCheckout } from '@vue-stripe/vue-stripe';
export default {
  components: {
    StripeCheckout,
  },
  data () {
    this.publishableKey = 'pk_test_51IpHB0JUnbBmvsVf7dFBz2gyNEf8Aya14bR2F5RCM2ZN4OwjigddasbwJriuUC9r6mxwFFvoI0oNTbDlFvydmXfo00HLcclQXg';
    return {
      loading: false,
      lineItems: [
        {
          price: 'price_1IpJC9JUnbBmvsVfgTZ0rBAv', // The id of the one-time price you created in your Stripe dashboard
          quantity: 1,
        },
      ],
      successURL: 'http://' + window.location.hostname + '/accueil',
      cancelURL: 'http://' + window.location.hostname + '/commande',
    };
  },
  mounted() {
        if(localStorage.panier) {
            this.panier = JSON.parse(localStorage.panier);
            var prixTotal = 0;
            this.panier.map(i => prixTotal += i.prix);
            this.lineItems[0].quantity=parseInt(prixTotal);
        }
    },
  methods: {
    submit () {
      // You will be redirected to Stripe's secure checkout page
      this.$refs.checkoutRef.redirectToCheckout();
    },
  },
};
</script>
