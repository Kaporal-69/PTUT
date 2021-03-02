<template>
    <div>
        <div class="search-wrapper">
            <label>Search title:</label>
            <input type="text" v-model="search" placeholder="Search ..."/>
        </div>
        <SearchBanner/>
        <SearchRestaurant/>
        <SearchProducteur/>
    </div>
</template>

<script>
import SearchRestaurant from './SearchRestaurant';
import SearchProducteur from './SearchProducteur';
import SearchBanner from './SearchBanner';
export default {
    name: "Search",
    components: {
     SearchRestaurant,
     SearchProducteur,
     SearchBanner
    },
    data: {
    search: '',
    }
    
}
</script>