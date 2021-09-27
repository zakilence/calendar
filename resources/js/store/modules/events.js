import axios from 'axios';
import { assistEvent } from '../../functions/assist';

const state = {
    events: [],
    event: null,
    isEditMode: false,
};

const getters = {
    events: state => state.events.map(event => assistEvent(event)),
    event: state => assistEvent(state.event),
    isEditMode: state => state.isEditMode,
};

const mutations = {
    setEvents: (state, events) => (state.events = events),
    appendEvent: (state,event) => (state.events = [...state.events, event]),
    setEvent: (state, event) => (state.event = event),
    setEditMode: (state, bool) => (state.isEditMode = bool),
};

const actions = {
    async fetchEvents({ commit }) {
        const response = await axios.get('/api/events');
        
        commit('setEvents', response.data);
    },
    async createEvent({ commit }) {
        const response = await axios.post('/api/events',event);
        commit('appendEvent', response.data);
    },
    setEvent({ commit }, event) {
        commit('setEvent', event);
    },
    setEditMode({ commit }, bool) {
        commit('setEditMode', bool);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};