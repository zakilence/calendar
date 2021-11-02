<template>
    <v-list dense>
        <v-list-item>
            <v-list-item-content>
                <v-subheader>My Calendar</v-subheader>
            </v-list-item-content>
            <v-list-item-action>
                <v-btn icon>
                    <v-icon size="16px">mdi-plus</v-icon>
                </v-btn>
            </v-list-item-action>
        </v-list-item>
        <v-list-item-group :value="selectedItem">
            <v-list-item v-for="calendar in calendars" :key="calendar.id">
                <v-list-item-content>
                    <v-checkbox
                        dense
                        v-model="calendar.visibility"
                        :color="calendar.color"
                        :label="calendar.name"
                        @click="toggleVisibility(calendar)"
                        hide-details="true"
                    ></v-checkbox>
                </v-list-item-content>
                <v-list-item-action class="ma-0">
                    <v-menu transition="scale-transition" offset-y min-width="100px">
                        <template v-slot:activator="{ on }">
                            <v-btn icon v-on="on">
                                <v-icon size="12px">mdi-dots-vertical</v-icon>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item @click="editCalendars(calendar)">編集</v-list-item>
                            <v-list-item @click="deleteCalendars(calendar)">削除</v-list-item>
                        </v-list>
                    </v-menu>
                </v-list-item-action>
            </v-list-item>
        </v-list-item-group>
    </v-list>
</template>

<script>
import axios from 'axios';

export default {
    props:["val"],
    name: 'CalendarList',
    data: () => ({
        selectedItem:null,
        calendars:[],
        newCalendar:{
            name:'',
            color:'',
            calendar_id:'',
            visibility:'',
        },
            
    }),
    methods: {
        getCalendars() {
            axios.get('/calendars')
                .then(response => {
                    this.calendars = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        updateCalendars(calendar) {
            axios.put(`/calendars/${calendar.id}`, calendar)
                .then(response => {
                    this.$emit('ReGetEvents',response.data);
                    console.log(response.data);
                })
        },
        deleteCalendars(calendar) {
            axios.delete(`/calendars/${calendar.id}`, calendar)
                .then(response => {
                    this.calendars = response.data;
                    console.log('delete');
                })
                .catch(error =>{
                    console.error(error);
                });
        },
        toggleVisibility(calendar) {
            this.updateCalendars(calendar)
        },
    },
    created() {
        this.getCalendars();
    },
};
</script>