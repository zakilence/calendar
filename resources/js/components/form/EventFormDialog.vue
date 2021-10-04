<template>
    <v-card class="pb-12">
        <v-card-actions class="d-flex justify-end pa-2">
            <v-btn icon @click="closeDialog">
                <v-icon size="20px">mdi-close</v-icon>
            </v-btn>
        </v-card-actions>
        <v-card-text>
            <DialogSection icon="mdi-square" :color="color">
                <v-text-field v-model="name" label="タイトル"></v-text-field>
            </DialogSection>
            <DialogSection icon="mdi-clock-outline">
                <DateForm v-model="startDate" />
                <div v-show="!allDay">
                    <TimeForm v-model="startTime" />
                </div>
                <DateForm v-model="endDate" />
                <div v-show="!allDay">
                    <TimeForm v-model="endTime" />
                </div>
                <CheckBox v-model="allDay" label="終日" />
            </DialogSection>
            <DialogSection icon="mdi-card-text-outline">
                <TextForm v-model="description" />
            </DialogSection>
            <DialogSection icon="mdi-palette">
                <ColorForm v-model="color" />
            </DialogSection>
        </v-card-text>
        <v-card-actions class="d-flex justify-end">
            <v-btn @click="cancel">キャンセル</v-btn> <!--追加-->
            <v-btn @click="submit">保存</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
import DialogSection from '../pageParts/DialogSection';
import DateForm from './DateForm';
import TimeForm from './TimeForm';
import TextForm from './TextForm';
import ColorForm from './ColorForm';
import CheckBox from './CheckBox';

export default {
    name: 'EventFormDialog',
    components: {
        DialogSection,
        DateForm,
        TimeForm,
        TextForm,
        ColorForm,
        CheckBox, 
    },
    data: () => ({
        name: '',
        startDate: null,
        startTime: null,
        endDate: null,
        endTime: null,
        description: '',
        color: '',
        allDay: false,
    }),
    computed: {
        ...mapGetters('events', ['event']),
    },
    created() {
        this.name = this.event.name; // 追加
        this.startDate = this.event.startDate;
        this.startTime = this.event.startTime;
        this.endDate = this.event.endDate;
        this.endTime = this.event.endTime;
        this.description = this.event.description; // 追加
        this.color = this.event.color;
        this.allDay = !this.event.timed;
    },
    methods: {
        ...mapActions('events', ['setEvent', 'setEditMode', 'createEvent', 'updateEvent']), // 追加
        closeDialog() {
            this.setEditMode(false);
            this.setEvent(null);
        },
        submit() {
            const params = {
                ...this.event, // 追加
                name: this.name,
                start: `${this.startDate} ${this.startTime || ''}`,
                end: `${this.endDate} ${this.endTime || ''}`,
                description: this.description,
                color: this.color,
                timed: !this.allDay,
            };
            // 追加
            if (params.id) {
                this.updateEvent(params);
            } else {
                this.createEvent(params);
            }
            // ここまで
            this.closeDialog();
        },
        // 追加
        cancel() {
            this.setEditMode(false);
            if (!this.event.id) {
                this.setEvent(null);
            }
        },
        // ここまで
    },
};
</script>