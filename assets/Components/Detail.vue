<template>
    <!-- <div>{{id}}</div> -->
    <DetailRestaurant :id=id></DetailRestaurant>
</template>

<script>
import DetailRestaurant from './DetailRestaurant';

export default {
    name: "Detail",
    components: {
        DetailRestaurant,
    },
    data() {
        return {
            id: this.$route.params.id
        }
    }
}
</script>
