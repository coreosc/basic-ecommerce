/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
// Vue.component('minicart', require('./components/Minicart.vue'));
// import Minicart from './components/Minicart.vue';
const app = new Vue({
    el: '#app',

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

        updateSession(productId, quantity){
            $.post('/update-cart', {id: productId, quantity: quantity, '_token': Laravel.csrfToken});
        },

        addToCart(product){
            this.products.push(product);
            this.updateSession(product.id, product.quantity);
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
