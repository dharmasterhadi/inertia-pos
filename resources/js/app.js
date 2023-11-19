import './bootstrap';


import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
 
createInertiaApp({
  resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
  setup({ el, App, props, plugin }) {
    return createApp({ render: () => h(App, props) })
      .mixin({
        methods: {
          //method "hasAnyPermission"
          hasAnyPermission : function (permissions){

            //get permissions from props
            let allPermissions = this.$page.props.auth.permissions;

            let hasPermission = false;
            permissions.forEach(function(item){
              if(allPermissions[item]) hasPermission = true;
            });

            return hasPermission;
          }
        }
      })
      .use(plugin)
      .mount(el)
  },
});