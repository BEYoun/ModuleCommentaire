<template>
  <div class="ui comments">
    <comment :comment="comment" :ip="ip"  v-for="comment in comments" :key="comment.id"></comment>
  </div>
</template>
<script type="text/babel">
import axios from 'axios'
import Comment from './comments/comment.vue'
export default {
  data () {
    return {
      comments: []
    }
  },
  components: { Comment },
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
