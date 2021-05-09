import { createStore } from 'vuex'

import {auth} from './states/auth.js'

export const store = createStore({
  modules: {
    auth,
  }
});
