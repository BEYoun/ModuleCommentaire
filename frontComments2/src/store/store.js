import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
export const state = {
  comments: []
}

export const mutations = {
  ADD_COMMENT (state, comment) {
    state.comments.push(comment)
  }
}
export default new Vuex.Store({
  state,
  mutations
})
