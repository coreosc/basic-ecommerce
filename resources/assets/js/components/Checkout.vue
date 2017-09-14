<script>
    export default {

        props: ['deliveriesJson', 'myAddressesJson'],
        data() {
            return {
                deliveries: {},
                myAddresses: {},
                delivery: 0,
                deliveryWithAddress: false
            }
        },

        methods: {
            selectDelivery(id){
                this.delivery = id
            },

            upsertDeliveryAddress(){
                $.post('/vue/adres', {'_token': Laravel.csrfToken}, function (response) {
                    console.log(response);
                }.bind(this));
            }
        },

        mounted() {
            this.deliveries = JSON.parse(this.deliveriesJson);
            this.myAddresses = JSON.parse(this.myAddressesJson);
        }
    }
</script>
