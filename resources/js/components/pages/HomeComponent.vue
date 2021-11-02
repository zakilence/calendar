<template>
    <v-app id="app">
        <v-tabs class="mx-auto">
            <v-tab href="#tab-1">My Page</v-tab>
            <v-tab href="#tab-2">Group Page</v-tab>
            <v-tab-item value="tab-1">
                <Calendar />
            </v-tab-item>
            <v-tab-item value="tab-2">
                <Group />
            </v-tab-item>
        </v-tabs>
    </v-app>
</template>

<script>
import Calendar from '../pageParts/Calendar';
import Group from '../pageParts/Grouppage';

export default {
    components: {
        Calendar,
        Group,
    },
    mounted() {
        console.log('HomeComponent mounted.');
    },
};
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}
</style>