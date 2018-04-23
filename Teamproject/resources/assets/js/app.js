import Vue from 'vue'
import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import SweetModal from 'sweet-modal-vue/src/plugin.js';
import Vuesax from 'vuesax';
import 'vuesax/dist/vuesax.css';
import vuescrollor from 'vue-scrollactive';

Vue.use(vuescrollor);
Vue.use(SweetModal);
Vue.use(VueRouter);
Vue.use(Vuesax);
Vue.use(VueAxios, axios);

import main from './components/template/pentomain.vue';
import pentostorylist from './components/template/pentostorylist.vue';
import pentoRank from './components/template/pentoRank.vue';
import pentoheader from './components/template/new_header.vue';
import Mypento from './components/template/Mypento.vue';
import pento_col from './components/template/pento_col_main.vue';
import pento_col_my from './components/template/pento_col_my.vue';
import pento_col_all from './components/template/pento_col_shares.vue';

Vue.prototype.$eventBus = new Vue();
const routes = [
	{
		name: 'main',
		path: '/',
		components:
			{
				header: pentoheader,
				default: main,
			}
	},

	{
		name: 'pentostorylist',
		path: '/pentostorylist',
		components:
			{
				header: pentoheader,
				default: pentostorylist,
			}
	},

	{
		name: 'pentoRank',
		path: '/pentoRank',
		components:
			{
				header: pentoheader,
				default: pentoRank,
			}
	},

	{
		name: 'Mypento',
		path: '/Mypento',
		components:
			{
				header: pentoheader,
				default: Mypento,
			}
	},
	{
		name: 'pento_col',
		path: '/pentocollection',
		components:
			{
				header: pentoheader,
				default: pento_col
			}

	},
	{
		name: 'pento_col_my',
		path: '/pentomycollection',
		components:
			{
				header: pentoheader,
				default: pento_col_my
			}
	},

	{
		name: 'pento_col_all',
		path: '/pentoallcollection',
		components:
			{
				header: pentoheader,
				default: pento_col_all
			}
	},


];
const router = new VueRouter({ routes });
new Vue(Vue.util.extend({ router }, App)).$mount('#app');



