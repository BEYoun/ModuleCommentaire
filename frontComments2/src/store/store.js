import Vue from 'vue'
import Vuex from 'vuex'
import {commentaire} from './module/commentStore'
Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    commentaire: commentaire
  }
})
