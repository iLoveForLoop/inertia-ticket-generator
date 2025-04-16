import { defineStore } from 'pinia';

export const useUIStore = defineStore('ui', {
    state: () => ({
        sidebarCollapsed:
            JSON.parse(localStorage.getItem('sidebar-collapsed')) ?? true,
    }),
    actions: {
        toggleSidebar() {
            this.sidebarCollapsed = !this.sidebarCollapsed;
            localStorage.setItem(
                'sidebar-collapsed',
                JSON.stringify(this.sidebarCollapsed),
            );
        },
    },
});
