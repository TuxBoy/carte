window.Vue = require('vue');

import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
	load: {
      key: 'AIzaSyCEbHjXyYvxFHP11e7fw1n-_AVzchbC9-M',
      libraries: 'geometry'
	}
})

const app = new Vue({
	el: '#app',
	components: {

	}
});
