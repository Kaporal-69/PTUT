<template>
    <div>
        <DetailRestaurant v-show="detail == 'restaurant'" :id=id></DetailRestaurant>
        <DetailProducteur v-show="detail == 'producteur'" :id=id></DetailProducteur>
    </div>
</template>

<script>
import DetailRestaurant from './DetailRestaurant';
import DetailProducteur from './DetailProducteur';

export default {
    name: "Detail",
    components: {
        DetailRestaurant,
        DetailProducteur
    },
    data() {
        return {
            id: this.$route.params.id,
            detail: this.$route.params.detail
        }
    }
}
</script>
