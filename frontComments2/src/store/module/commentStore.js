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
    add_comments ({ commit }, comments) {
      commit('ADD_COMMENTS', comments)
    }
  }
}
