import { defineStore } from 'pinia';

export const useUIStore = defineStore('ui', {
    state: () => ({
        sidebarCollapsed:
            JSON.parse(localStorage.getItem('sidebar-collapsed')) ?? true,
        notifInfo: {
            showing: false,
            title: '',
            type: '',
            message: '',
        },
    }),
    actions: {
        toggleSidebar() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
            localStorage.setItem(
                'sidebar-collapsed',
                JSON.stringify(this.sidebarCollapsed),
            );
        },

        setNotification(notif) {
            this.notifInfo = notif;
        },

        hideNotif(data) {
            this.notifInfo.showing = data;
        },
    },
});
