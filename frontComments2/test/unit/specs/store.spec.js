import { mutations } from '../../../src/store/store.js'
describe('mutations', () => {
  it('ADD_COMMENT', () => {
    const state = {comments: [1, 2]}
    mutations.ADD_COMMENT(state, {content: 'Salut'})
    expect(state.comments.length).to.equal(3)
  })
})
