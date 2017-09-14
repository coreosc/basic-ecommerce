require('./bootstrap');

import Checkout from './components/Checkout.vue';

const app = new Vue({
    el: '#app',

    components: {
        'checkout': Checkout
    },

    data: {
        products: [],
        summaryProducts: 0
    },
    mounted() {
        $.getJSON('/cart-state', {}, function (response) {
            this.products = response.products,
                this.summaryProducts = response.summaryProducts
        }.bind(this));
    },
    methods: {
        removeFromCart(id) {

            this.products = this.products.filter(function (item) {
                return id != item.id;
            });

            this.updateSession(id, 0);
        },

        getProductsQuantity() {
            return parseInt(this.products.reduce(function(carry, item) { return carry + item.quantity }, 0));
        },

        round(price) {
            return Math.round(100 * price) / 100;
        },

        calculatePrice(product){
            return this.round(product.quantity * product.price)
        },

        checkStockQuantity(product) {
            if (product.quantity > product.inStockQuantity) {
                product.quantity = product.inStockQuantity;
            }

            if (product.quantity < 1) {
                product.quantity = 1;
            }
        },

        incrementProductQuantity(productIndex) {
            if(this.products[productIndex].quantity > this.products[productIndex].inStockQuantity) {
                this.products[productIndex].quantity = this.products[productIndex].inStockQuantity;

                $('#modalMessage').text(window.Messages.outOfStock);
                $('#myModal').modal();
            }

            return this.products[productIndex].quantity;
        },

        updateSession(productId, quantity){
            $.post('/update-cart', {id: productId, quantity: quantity, '_token': Laravel.csrfToken});
        },

        addToCart(product){
            let currentIndex;

            this.products.filter(function(p, index) {
                currentIndex = index;
                return p.id === product.id;
            }).length === 0 ? currentIndex = this.products.push(product) - 1 : this.products[currentIndex].quantity++;

            this.updateSession(product.id, this.incrementProductQuantity(currentIndex));


        }

    },

    watch: {
        'products': {
            handler(){
                this.summaryProducts = this.round(this.products.reduce(function (carry, item) {
                    return carry + this.calculatePrice(item);
                }.bind(this), 0));
            }, deep: true
        }
    }
});
