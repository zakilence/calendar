<template>
    <div>
        <v-card>first</v-card>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Group',
    data: () => ({
        groups: [],
        newgroup:{
            name:'',
            color:'',
        },

    }),
    methods: {
        getGroups() {
            axios.get('/groups')
                .then(response => {
                    this.groups = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        createGroups() {
            axios.post('/groups', this.newGroup)
                .then(response => {
                    console.log('success');
                    this.groups = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },

    }
};
</script>
