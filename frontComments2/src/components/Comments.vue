<template>
  <div class="ui comments">
    <comment :comment="comment" :ip="ip"  v-for="comment in comments" :key="comment.id"></comment>
    <comment-form :id="id" :model="model "></comment-form>
  </div>
</template>
<script type="text/babel">
import axios from 'axios'
import Comment from './comments/comment.vue'
import CommentForm from './comments/Form.vue'
import store from '../store/store'
global.store = store
export default {
  data () {
    return {
      comments: []
    }
  },
  components: { Comment, CommentForm },
  props: {
    id: Number,
    model: String,
    csrf: String,
    ip: String
  },
  created: function () {
    axios
      .get('/comments', { params: { id: this.id, type: this.model } })
      .then(response => {
        this.comments = response.data
      })
  }
}
</script>
