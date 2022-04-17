export default [
    {
        path: '/profile',
        component: require('./components/Profile.vue').default
    },
    {
        path: '/developer',
        component: require('./components/Developer.vue').default
    },
    {
        path: '/users',
        component: require('./components/Users.vue').default
    },
    {
        path: '/ticket',
        component: require('./components/Ticket.vue').default
    },
    {
        path: '/transaction',
        component: require('./components/Transaction.vue').default
    },
    {
        path: '*',
        component: require('./components/Transaction.vue').default
    }
];
