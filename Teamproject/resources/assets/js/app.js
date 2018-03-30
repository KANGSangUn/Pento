import Vue from 'vue'
import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import SweetModal from 'sweet-modal-vue/src/plugin.js';
import Icon from 'vue-awesome/components/Icon.vue'
import 'vue-awesome/icons/flag';
import 'vue-awesome/icons';
import VueScrolla from 'vue-scrollactive';
import Vuesax from 'vuesax'
import 'vuesax/dist/vuesax.css'

Vue.use(VueScrolla);
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
import collection from './components/template/collection_main.vue';
import col_my from './components/template/collection_my.vue';
import col_all from './components/template/collection_users.vue';


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
	{	name : 'col_Main',
        path : '/collection',
        components:
            {	header : sub_header,
                default : collection,
            }

    },
    {	name : 'col_my',
        path : '/collection/mycollection',
        components:
            {	header : sub_header,
                default : col_my,
            }

    },
    {	name : 'col_all',
        path : '/collection/allcollection',
        components:
            {	header : sub_header,
                default : col_all,
            }

    },
];

const router = new VueRouter({routes});
new Vue(Vue.util.extend({router}, App)).$mount('#app');