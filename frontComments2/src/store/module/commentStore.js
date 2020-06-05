import axios from 'axios'
export const commentaire = {
  state: () => ({ comments: [] }),
  getters: {
    comments: (state, getters) => {
      return state.comments
    }
  },
  mutations: {
    ADD_COMMENTS (state, comments) {
      state.comments.push(...comments)
    },
    ADD_COMMENT (state, comment) {
      if (comment.reply) {
        let c = state.comments.find((c) => c.id === comment.reply)
        if (c.replies === undefined) {
          c.replies = []
        }
        c.replies.push(comment)
      } else {
        state.comments.push(comment)
      }
    }
  },
  actions: {
    get_comments ({ commit }, params) {
      return axios
        .get('/comments', { params: { id: params.id, type: params.model } })
        .then(response => {
          commit('ADD_COMMENTS', response.data)
        })
    },
    add_comment ({ commit }, comment) {
      // comment._token = 'PBR0sN5bKihxb662XUtXSOMZEdpZnnHLOtkyHdXN'
      // console.log(comment)
      return axios
        .post('/comments', comment)
        .then((response) => {
          console.log(response)
          commit('ADD_COMMENT', response.data)
        })
    }
  }
}
