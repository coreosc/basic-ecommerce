<ul>
    <li v-for="product in products">@{{ product.name }}, @{{ product.price }} X @{{ product.quantity }} <button v-on:click="removeFromCart(product.id)">X</button></li>
</ul>