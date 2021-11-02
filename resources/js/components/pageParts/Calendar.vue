<template>
    <div>
        <v-sheet>
            <v-toolbar flat>
                <v-btn outlined color="gray" @click="setToday">Today</v-btn>
                <v-btn icon @click="$refs.calendar.prev()">
                    <v-icon>mdi-chevron-left</v-icon>
                </v-btn>
                <v-btn icon @click="$refs.calendar.next()">
                    <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
                <v-toolbar-title v-if="$refs.calendar">
                    {{ $refs.calendar.title }}
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-menu bottom right>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn outlined v-bind="attrs" v-on="on">
                            <span>{{ typeToLabel[type] }}</span>
                            <v-icon right>
                                mdi-menu-down
                            </v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item @click="type = 'day'">
                            <v-list-item-title>Day</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="type = 'week'">
                            <v-list-item-title>Week</v-list-item-title>
                        </v-list-item>
                        <v-list-item @click="type = 'month'">
                            <v-list-item-title>Month</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </v-toolbar>
        </v-sheet>
        <v-sheet height="100vh" class="d-flex">
            <v-sheet class="flex">
                <CalendarList @ReGetEvents="reGetEvents" ref="child1"/>                
            </v-sheet>
            <v-sheet height="100vh" class="flex align-center">
                <v-calendar
                    is-expanded
                    ref="calendar"
                    v-model="value"
                    :events="events"
                    @change="getEvents"
                    :type="type"
                    @click:event="showEvent"
                ></v-calendar>
                <v-menu
                  v-model="selectedOpen"
                  :close-on-content-click="false"
                  :activator="selectedElement"
                  offset-x
                  :events="events"
                >
                  <v-card
                    color="grey lighten-4"
                    min-width="350px"
                    flat
                  >
                    <v-toolbar
                      :color="selectedEvent.color"
                      dark
                    >
                      <v-btn icon>
                        <v-icon>mdi-pencil</v-icon>
                      </v-btn>
                      <v-btn icon @click="deleteEvents(selectedEvent)">
                          <v-icon>mdi-trash-can</v-icon>
                      </v-btn>
                      <v-toolbar-title v-html="selectedEvent.name"></v-toolbar-title>
                      <v-spacer></v-spacer>
                      <v-btn icon>
                        <v-icon>mdi-heart</v-icon>
                      </v-btn>
                      <v-btn icon>
                        <v-icon>mdi-dots-vertical</v-icon>
                      </v-btn>
                    </v-toolbar>
                    <v-card-text>
                      <span v-html="selectedEvent.description"></span>
                    </v-card-text>
                    <v-card-actions>
                      <v-btn
                        text
                        color="secondary"
                        @click="selectedOpen = false"
                      >
                        Cancel
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-menu>
            </v-sheet>
            <v-sheet width="30%">
                <form @submit.prevent="createEvents">
                    <label>name</label><input v-model="newEvent.name" type="text">
                    <label>start</label><input v-model="newEvent.start" type="datetime-local">
                    <label>end</label><input v-model="newEvent.end" type="datetime-local">
                    <label>detail</label><input v-model="newEvent.description" type="text">
                    <label>color</label><input v-model="newEvent.color" type="color">
                    <select v-model="newEvent.calendar_id">
                        <option v-for="calendar in calendars" v-bind:value="calendar.id">
                            {{ calendar.name }}
                        </option>
                    </select>
                    <input type="submit" value="イベント作成">
                </form>
                <form @submit.prevent="createCalendars">
                    <label>calendarname</label><input v-model="newCalendar.name" type="text">
                    <label>color</label><input v-model="newCalendar.color" type="color">
                    <input type="submit" value="カレンダー作成">
                </form>
            </v-sheet>
        </v-sheet>
    </div>
</template>

<script>
import axios from 'axios';
import CalendarList from '../calendars/CalendarList';
import { format } from 'date-fns';
export default {
    name: 'Calendar',
    data: () => ({
        value: format(new Date(), "yyyy/MM/dd"),  // 表示する月を指定 ※予めイベントデータを作成しておいて下さい。
        events: [],
        calendars:[],
        selectedEvent: {},
        selectedElement: null,
        selectedOpen: false,
        newEvent:{
            name:'',
            start:'',
            end:'',
            description:'',
            calendar_id:'',
            color:'',
        },
        newCalendar:{
            name:'',
            color:'',
        },
        type: 'month',
        typeToLabel: {
            month: 'Month',
            week: 'Week',
            day: 'Day',
        }
    }),
    components: {
        CalendarList,
    },
    methods: {
        getEvents() {
            axios.get('/events')
                .then(response => {
                    this.events = response.data;
                    console.log(response.data);
                })
                .catch(error => {
                    console.error(error);
                });
        },
        createEvents() {
            axios.post('/events', this.newEvent)
                .then(response => {
                    console.log(response.data);
                    this.events = response.data;
                })
                .catch(error => {
                    console.error(error);
                })
        },
        deleteEvents(event) {
            axios.delete(`/events/${event.id}`,event)
                .then(response => {
                    this.events = response.data;
                    console.log('delete');
                });
        },
        showEvent ({ nativeEvent, event }) {
            const open = () => {
              this.selectedEvent = event
              this.selectedElement = nativeEvent.target
              requestAnimationFrame(() => requestAnimationFrame(() => this.selectedOpen = true))
            }
    
            if (this.selectedOpen) {
              this.selectedOpen = false
              requestAnimationFrame(() => requestAnimationFrame(() => open()))
            } else {
              open()
            }
    
            nativeEvent.stopPropagation()
        },
        reGetEvents(events) {
            this.events = events;
        },
        createCalendars() {
            axios.post('/calendars', this.newCalendar)
                .then(response => {
                    console.log('success');
                    this.calendars = response.data;
                    this.$refs.child1.getCalendars();
                })
                .catch(error => {
                    console.error(error);
                });
        },
        setToday() {
            this.value = format(new Date(), "yyyy/MM/dd");
        },
    },
}
</script>