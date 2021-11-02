<template>
    <v-card class="pb-12">
        <v-card-actions class="d-flex justify-end pa-2">
            <v-btn icon @click="updateEvents">
                <v-icon size="20px">mdi-pencil-outline</v-icon>
            </v-btn>
            <v-btn icon @click="deleteEvents">
                <v-icon size="20px">mdi-trash-can-outline</v-icon>
            </v-btn>
            <v-btn icon @click="closeDialog">
                <v-icon size="20px">mdi-close</v-icon>
            </v-btn>
        </v-card-actions>
        <v-card-title>
            <DialogSection icon="mdi-square" :color="event.color">
                {{ event.name }}
            </DialogSection>
        </v-card-title>
        <v-card-text>
            <DialogSection icon="mdi-clock-time-three-outline">
                {{ event.startDate }} {{ event.timed ? event.startTime : '' }} ~ {{ event.endDate }} {{ event.timed ? event.endTime : '' }}
            </DialogSection>
        </v-card-text>
        <v-card-text>
            <DialogSection icon="mdi-card-text-outline">
                {{ event.description || 'no description' }}
            </DialogSection>
        </v-card-text>

    </v-card>
</template>

<script>
import axios from 'axios';
import DialogSection from '../pageParts/DialogSection';

export default {
    name: 'EventDetailDialog',
    components: {
        DialogSection
    },
    methods: {
        closeDialog() {
            this.setEvent(null);
        },
        deleteEvents() {
            axios.delete('/events/{id}')
                .then(response => {
                    this.events = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
        updateEvents() {
            axios.put('/events/{id}', this.newEvent)
                .then(response => {
                    console.log('success');
                    this.events = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    }
};
</script>