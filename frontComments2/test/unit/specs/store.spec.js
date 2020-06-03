import { mutations } from '../../../src/store/store.js'
// npm install --save-dev babel-polyfill
describe('mutations', () => {
  it('ADD_COMMENTS', () => {
    const state = {comments: [1, 2]}
    mutations.ADD_COMMENTS(state, [2, 3, 4])
    expect(state.comments.length).to.equal(5)
  })
  it('ADD_COMMENT with reply', () => {
    const state = {comments: [{id: 1}]}
    mutations.ADD_COMMENT(state, {reply: 1, content: 'Salut'})
    expect(state.comments[0].replies.length).to.equal(1)
  })
  it('ADD_COMMENT', () => {
    const state = {comments: [1, 2]}
    mutations.ADD_COMMENT(state, {content: 'Salut'})
    expect(state.comments.length).to.equal(3)
  })
})
