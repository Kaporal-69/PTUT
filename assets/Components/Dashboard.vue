<template>
    <div class="dashboard">
        <DashboardRestaurant/>
    </div>
</template>

<script>
import DashboardRestaurant from './DashboardRestaurant';
import DashboardProducteur from './DashboardProducteur';
export default {
    name: "Dashboard",
    components: {
        DashboardRestaurant,
        DashboardProducteur
    }
}
</script>