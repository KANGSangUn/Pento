import Vue from 'vue'
import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import SweetModal from 'sweet-modal-vue/src/plugin.js';
import Icon from 'vue-awesome/components/Icon.vue'
import 'vue-awesome/icons/flag';
import 'vue-awesome/icons';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';

Vue.use(SweetModal);
Vue.use(VueRouter);
Vue.use(Vuesax);
Vue.use(VueAxios, axios);
Vue.component('icon', Icon);

import main from './components/template/pentomain.vue';
import pentostorylist from './components/template/pentostorylist.vue';
import pentoRank from './components/template/pentoRank.vue';
import sub_header from './components/template/sub_header.vue';
import Mypento from './components/template/Mypento.vue';
import pento_col from './components/template/pento_col_main.vue';
import pento_col_my from './components/template/pento_col_my.vue';


Vue.prototype.$eventBus = new Vue();
const routes = [
	{	name: 'main',
		path: '/',
		components:
			{
				default : main,

			}
	},

	{	name: 'pentostorylist',
		path: '/pentostorylist',
		components:
			{	header : sub_header,
				default : pentostorylist,
			}
	},

	{	name : 'pentoRank',
		path : '/pentoRank',
		components:
			{	header : sub_header,
				default : pentoRank,
			}
	},

	{	name : 'Mypento',
		path : '/Mypento',
		components:
			{	header : sub_header,
				default : Mypento,
			}
	},
	{
		name : 'pento_col',
        path : '/pentocollection',
        components:
            {
                header : sub_header,
            	default : pento_col
            }

    },
	{
        name : 'pento_col_my',
        path : '/pentomycollection',
        components:
            {
                header : sub_header,
                default : pento_col_my
            }
	}

];
const router = new VueRouter({routes});
new Vue(Vue.util.extend({router}, App)).$mount('#app');



