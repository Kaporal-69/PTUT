<template>
    <div class="dashboard">
        <title>Tableau de bord</title>
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